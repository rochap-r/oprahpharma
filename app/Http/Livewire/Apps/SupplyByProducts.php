<?php

namespace App\Http\Livewire\Apps;

use App\Models\Supply;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SupplyByProducts extends Component
{
    use WithPagination;

    public $product_id, $quantity_purchased, $unit_purchase_price, $supply_date, $expiration_date,$product_name;
    public $quantity_in_stock = 0;
    public $selected_id;
    public $search='';
    private int $heures=24;

    public $perPage = 8;
    public $updateSupplyMode = false;

    protected $listeners = [
        'resetForm',
        'time-error' => 'handleTimeError',
        'quantity-error' => 'handleQuantityError',
        'time-qte-error',
        'deleteSupplyAction',
        'productSelected' => 'updateProductId'
    ];



    public function updateProductId($productId)
    {
        $this->product_id = $productId; // Mettre à jour la propriété avec l'ID du produit
    }

    public function mount()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->updateSupplyMode = false;
        $this->product_id = $this->quantity_purchased = $this->unit_purchase_price = $this->supply_date = $this->expiration_date = null;
    }


    public function addSupply()
    {
        $this->validate([
            'product_id' => 'required|exists:products,id',
            'quantity_purchased' => 'required|numeric|min:1',
            'unit_purchase_price' => 'required|numeric|min:1',
            'supply_date' => 'required|date',
            'expiration_date' => 'required|date|after:supply_date',
        ], [
            'product_id.required' => 'Le produit est obligatoire',
            'product_id.exists' => 'Le produit sélectionné n\'existe pas',
            'quantity_purchased.required' => 'La quantité achetée est obligatoire',
            'quantity_purchased.numeric' => 'La quantité achetée doit être un nombre',
            'quantity_purchased.min' => 'La quantité achetée doit être supérieure à 0',
            'unit_purchase_price.required' => 'Le prix d\'achat unitaire est obligatoire',
            'unit_purchase_price.numeric' => 'Le prix d\'achat unitaire doit être un nombre',
            'unit_purchase_price.min' => 'Le prix d\'achat unitaire doit être supérieur à 0',
            'supply_date.required' => 'La date d\'achat est obligatoire',
            'supply_date.date' => 'La date d\'achat doit être une date valide',
            'expiration_date.required' => 'La date d\'expiration est obligatoire',
            'expiration_date.date' => 'La date d\'expiration doit être une date valide',
            'expiration_date.after' => 'La date d\'expiration doit être supérieure à la date d\'achat',
        ]);

        DB::transaction(function () {
            $supply = new Supply();
            $supply->product_id = $this->product_id;
            $supply->quantity_purchased = $this->quantity_purchased;
            $supply->quantity_in_stock = $this->updateQuantityInStock($this->product_id, $this->quantity_purchased);
            $supply->unit_purchase_price = $this->unit_purchase_price;
            $supply->supply_date = $this->supply_date;
            $supply->expiration_date = $this->expiration_date;
            $result = $supply->save();

            if ($result) {
                $this->dispatchBrowserEvent('hideSupplyModal');
                $this->showToastr('La nouvelle ligne d\'approvisionnement a été enregistrée avec succès !', 'success');
                $this->product_id = $this->quantity_purchased = $this->unit_purchase_price = $this->supply_date = $this->expiration_date = null;
                $this->resetForm();
                $this->emit('resetComponent');
            } else {
                $this->showToastr('Oups ! Quelque chose n\'a pas bien fonctionné !', 'error');
            }
        });
    }

    public function updateQuantityInStock(int $product_id, int $quantity_purchased, int $selected_id = 0): int
    {
        $quantity_in_stock = 0;

        // Utilisez une transaction pour éviter les conditions de course
        DB::transaction(function () use ($product_id, $quantity_purchased, $selected_id, &$quantity_in_stock) {
            if ($selected_id !== 0) {
                $selected_supply = Supply::find($selected_id);
                // Vérifiez si l'enregistrement existe
                if (!empty($selected_supply)) {
                    $current_quantity = $selected_supply->quantity_in_stock - $selected_supply->quantity_purchased;
                    $quantity_in_stock = $current_quantity + $quantity_purchased;

                    // Obtenez tous les approvisionnements plus récents que l'approvisionnement sélectionné
                    $supplies = Supply::where('product_id', $product_id)
                        ->where('created_at', '>', $selected_supply->created_at)
                        ->get();

                    // Mettez à jour chaque approvisionnement
                    foreach ($supplies as $supply) {
                        $current_quantity_in_stock=$supply->quantity_in_stock - $selected_supply->quantity_purchased;
                        $supply->quantity_in_stock = $current_quantity_in_stock+$quantity_purchased;
                        $supply->save();
                    }
                }
            } else {
                $supply = Supply::where('product_id', $product_id)->latest()->lockForUpdate()->first();
                // Vérifiez si l'enregistrement existe
                if (!$supply) {
                    $quantity_in_stock = (int)$quantity_purchased;
                } else {
                    $quantity_in_stock = $supply->quantity_in_stock + $quantity_purchased;
                }
            }
        });

        return $quantity_in_stock;
    }



    public function editSupply(int $id)
    {
        $supply = Supply::findOrFail($id);
        $this->selected_id = $supply->id;
        $this->product_id = $supply->product_id;
        $this->product_name = $supply?$supply->product->product_name:'';
        $this->quantity_purchased = $supply->quantity_purchased;
        $this->unit_purchase_price = $supply->unit_purchase_price;
        $this->supply_date = $supply->supply_date;
        $this->expiration_date = $supply->expiration_date;
        $this->updateSupplyMode = true;
        $this->resetErrorBag();
        $supplyDate = Carbon::parse($supply->supply_date);
        if ($supplyDate->diffInHours(Carbon::now()) < $this->heures) {
            $this->dispatchBrowserEvent('showEditSupplyModal');
        }else{
            $this->dispatchBrowserEvent('time-error', [
                'supply_date' =>Carbon::parse($supply->supply_date)->format('d-m-Y'),
                'hours' =>$this->heures,
            ]);
        }

    }



    public function updateSupply()
    {
        if ($this->selected_id) {
            $this->validate([
                'product_id' => 'required|exists:products,id',
                'quantity_purchased' => 'required|numeric|min:1',
                'unit_purchase_price' => 'required|numeric|min:0',
                'supply_date' => 'required|date',
                'expiration_date' => 'required|date|after_or_equal:supply_date',
            ], [
                'product_id.required' => 'Le choix du produit est obligatoire.',
                'product_id.exists' => 'Le produit sélectionné n\'existe pas.',
                'quantity_purchased.required' => 'La quantité achetée est obligatoire.',
                'quantity_purchased.numeric' => 'La quantité achetée doit être un nombre.',
                'quantity_purchased.min' => 'La quantité achetée doit être au moins 1.',
                'unit_purchase_price.required' => 'Le prix d\'achat unitaire est obligatoire.',
                'unit_purchase_price.numeric' => 'Le prix d\'achat unitaire doit être un nombre.',
                'unit_purchase_price.min' => 'Le prix d\'achat unitaire ne peut pas être négatif.',

                'supply_date.required' => 'La date d\'achat est obligatoire.',
                'supply_date.date' => 'La date d\'achat doit être une date valide.',
                'expiration_date.required' => 'La date d\'expiration est obligatoire.',
                'expiration_date.date' => 'La date d\'expiration doit être une date valide.',
                'expiration_date.after_or_equal' => 'La date d\'expiration doit être après ou égale à la date d\'achat.',
            ]);

            DB::transaction(function () {
                $supply = Supply::findOrFail($this->selected_id);
                $oldQuantity = $supply->quantity_purchased;

                /*
                 * si le stock n'est pas encore utilisé ou la nouvelle qté com soit egal ou sup à l'ancienne
                 */
                if ($supply->quantity_in_stock >= $oldQuantity || $this->quantity_purchased >= $supply->quantity_pushased) {
                    $supply->product_id = $this->product_id;
                    $supply->quantity_purchased = $this->quantity_purchased;
                    $supply->quantity_in_stock = $this->updateQuantityInStock($this->product_id, $this->quantity_purchased, $this->selected_id);
                    $supply->unit_purchase_price = $this->unit_purchase_price;
                    $supply->supply_date = $this->supply_date;
                    $supply->expiration_date = $this->expiration_date;

                    $journals = $supply->journals;
                    if (!$journals->isEmpty()){
                        foreach ($journals as $journal) {
                            if ($journal->unit_purchase_price != $this->unit_purchase_price) {
                                $journal->update(['unit_purchase_price' => $this->unit_purchase_price]);
                            }
                        }
                    }

                    if ($supply->save()) {
                        $this->dispatchBrowserEvent('hideSupplyModal');
                        $this->updateSupplyMode = false;
                        $this->resetForm();
                        $this->showToastr('Une ligne d\'appro a bien été mis à jour!', 'success');
                    } else {
                        $this->showToastr('Oups! Quelque chose n\'a pas bien fonctionné!', 'error');
                    }
                }else{
                    $this->dispatchBrowserEvent('qunatity-error');
                }



            });
        }
    }

    public function resetModal()
    {
        $this->reset(); // Cela réinitialisera toutes les propriétés publiques à leur valeur initiale.
    }


    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function deleteSupplyAction(int $id)
    {
        // Utilisez une transaction pour éviter les conditions de course
        DB::transaction(function () use ($id) {
            $selected_supply = Supply::find($id);
            if ($selected_supply) {
                $supplies = Supply::where('created_at', '>', $selected_supply->created_at)
                    ->get();
                if (!$supplies->isEmpty()){
                    // Mettez à jour chaque approvisionnement
                    foreach ($supplies as $supply) {
                        $current_quantity_in_stock=$supply->quantity_in_stock - $selected_supply->quantity_purchased;
                        $supply->quantity_in_stock = $current_quantity_in_stock;
                        $supply->save();
                    }
                }
                $selected_supply->delete();
                $this->showToastr("La fourniture a été supprimée avec succès.", 'info');
            } else {
                $this->showToastr("Il est impossible de supprimer cette fourniture, qui est configurée par défaut.", 'error');
            }
        });
    }



    public function deleteSupply(int $id)
    {
        $supply = Supply::find($id);
        $supplyDate = Carbon::parse($supply->supply_date);
        if ($supplyDate->diffInHours(Carbon::now()) <= $this->heures && $supply->quantity_in_stock >= $supply->quntity_purshased) {
            $this->dispatchBrowserEvent('deleteSupply', [
                'title' => 'Etes-vous vraiment sûr de supprimer cette ligne d\'Approvisionnement?',
                'html' => "Suppression de la ligne d\'Appro du produit: " . $supply->product->product_name,
                'id' => $supply->id
            ]);
        }else{
            $this->dispatchBrowserEvent('time-qte-error',['heures'=>$this->heures]);
        }


    }

    public function render()
    {
        $supplies = Supply::latest()
            ->orderBy('id', 'desc')
            ->whereHas('product', function ($query) {
                $query->where('product_name', 'like', '%' . $this->search . '%');
            })
            ->with('product')
            ->paginate($this->perPage);

        return view('livewire.apps.supply.supply-by-products',[
            'supplies'=>$supplies,
        ]);
    }
}
