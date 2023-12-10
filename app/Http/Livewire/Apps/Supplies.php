<?php

namespace App\Http\Livewire\Apps;

use App\Models\Supply;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Supplies extends Component
{
    use WithPagination;

    public $product_id, $quantity_purchased, $unit_purchase_price, $supply_date, $expiration_date;
    public $quantity_in_stock = 0;
    public $selected_id;

    public $perPage = 8;
    public $updateSupplyMode = false;

    protected $listeners = [
        'resetForm',
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
    }

    public function updateQuantityInStock(int $product_id, int $quantity_purchased, int $selected_id = 0): int
    {
        //dd($this->quantity_purchased);
        if ($selected_id) {
            $supply = Supply::find($selected_id);
            $current_quantity = $supply->quantity_in_stock - $supply->quantity_purchased;
            $this->quantity_in_stock = $current_quantity + $quantity_purchased;
        } else {
            $supply = Supply::where('product_id', $product_id)->latest()->first();
            //dd($supply);
            if (!empty($supply)) {
                $this->quantity_in_stock = $supply->quantity_in_stock + $quantity_purchased;
            } else {
                $this->quantity_in_stock = (int)$quantity_purchased;
            }
        }

        return $this->quantity_in_stock;
    }

    public function editSupply(int $id)
    {
        $supply = Supply::findOrFail($id);
        $this->selected_id = $supply->id;
        $this->product_id = $supply->product_id;
        $this->quantity_purchased = $supply->quantity_purchased;
        $this->unit_purchase_price = $supply->unit_purchase_price;
        $this->supply_date = $supply->supply_date;
        $this->expiration_date = $supply->expiration_date;
        $this->updateSupplyMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showEditSupplyModal');
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


            $supply = Supply::findOrFail($this->selected_id);
            $supply->product_id = $this->product_id;
            $supply->quantity_purchased = $this->quantity_purchased;
            $supply->quantity_in_stock = $this->updateQuantityInStock($this->product_id, $this->quantity_purchased, $this->selected_id);
            $supply->unit_purchase_price = $this->unit_purchase_price;
            $supply->supply_date = $this->supply_date;
            $supply->expiration_date = $this->expiration_date;

            if ($supply->save()) {
                $this->dispatchBrowserEvent('hideSupplyModal');
                $this->updateSupplyMode = false;
                $this->resetForm();
                $this->showToastr('Une ligne d\'appro a bien été mis à jour!', 'success');
            } else {
                $this->showToastr('Oups! Quelque chose n\'a pas bien fonctionné!', 'error');
            }
        }
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
        $supply = Supply::find($id);
        if ($supply) {
            $supply->delete();
            $this->showToastr("La fourniture a été supprimée avec succès.", 'info');
        } else {
            $this->showToastr("Il est impossible de supprimer cette fourniture, qui est configurée par défaut.", 'error');
        }
    }


    public function deleteSupply(int $id)
    {
        $supply = Supply::find($id);
        $this->dispatchBrowserEvent('deleteSupply', [
            'title' => 'Etes-vous vraiment sûr de supprimer cette ligne d\'Approvisionnement?',
            'html' => "Suppression de la ligne d\'Appro du produit: " . $supply->product->product_name,
            'id' => $supply->id
        ]);
    }


    public function render()
    {
//        $supplies = DB::table('supplies')
//            ->select(DB::raw('any_value(supplies.id) as supply_id, product_id, any_value(quantity_purchased) as quantity_purchased, any_value(unit_purchase_price) as unit_purchase_price, any_value(quantity_in_stock) as quantity_in_stock, any_value(supplies.supply_date) as supply_date, any_value(expiration_date) as expiration_date, products.*'))
//            ->join('products', 'products.id', '=', 'supplies.product_id')
//            ->orderBy('supply_date', 'asc')
//            ->groupBy('product_id')
//            ->paginate($this->perPage);

        $latestSupplies = DB::table('supplies')
            ->select('product_id', DB::raw('MAX(id) as id'))
            ->groupBy('product_id');

        $supplies = DB::table('supplies')
            ->joinSub($latestSupplies, 'latest_supplies', function ($join) {
                $join->on('supplies.id', '=', 'latest_supplies.id');
            })
            ->join('products', 'products.id', '=', 'supplies.product_id')
            ->join('units', 'units.id', '=', 'products.unit_id')
            ->orderBy('supplies.supply_date', 'desc')
            ->select('supplies.*', 'products.*','units.*')
            ->paginate($this->perPage);




        //dd($supplies);

        //$supplies=Supply::latest()->orderBy('id', 'asc')->with('product')->paginate($this->perPage);

        return view('livewire.apps.supply.supplies', [
            'supplies' => $supplies,]);
    }

}
