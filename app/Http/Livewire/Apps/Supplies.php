<?php

namespace App\Http\Livewire\Apps;

use App\Models\Supply;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Supplies extends Component
{
    use WithPagination;

    public $product_id, $quantity_purchased, $unit_purchase_price, $supply_date, $expiration_date;
    public $quantity_in_stock = 0;
    public $selected_id;
    public $search = '';

    public $perPage = 8;
    public $updateSupplyMode = false;

    protected $listeners = [
        'resetForm',
        'time-error' => 'handleTimeError',
        'productSelected' => 'updateProductId'
    ];


    public function updateProductId($productId)
    {
        $this->product_id = $productId; // Mettre à jour la propriété avec l'ID du produit
    }

    public function handleTimeError(): void
    {
        $this->errorMessage = 'La durée de modification est déjà au delà de 48h ';
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


    public function updateQuantityInStock(int $product_id, int $quantity_purchased): int
    {
        $quantity_in_stock = 0;
        // Utilisez une transaction pour éviter les conditions de course
        DB::transaction(function () use ($product_id, $quantity_purchased, &$quantity_in_stock) {
            if ($product_id !== 0) {
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


    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }



    public function render()
    {

        $latestSupplies = DB::table('supplies')
            ->select('product_id', DB::raw('MAX(id) as id'))
            ->groupBy('product_id');

        $supplies = DB::table('supplies')
            ->joinSub($latestSupplies, 'latest_supplies', function ($join) {
                $join->on('supplies.id', '=', 'latest_supplies.id');
            })
            ->join('products', 'products.id', '=', 'supplies.product_id')
            ->join('units', 'units.id', '=', 'products.unit_id')
            ->where('products.product_name', 'like', '%' . $this->search . '%') // Ajoutez cette ligne
            ->orderBy('supplies.supply_date', 'desc')
            ->select('supplies.*', 'products.*', 'units.*')
            ->paginate($this->perPage);





        //dd($supplies);

        //$supplies=Supply::latest()->orderBy('id', 'asc')->with('product')->paginate($this->perPage);

        return view('livewire.apps.supply.supplies', [
            'supplies' => $supplies,
        ]);
    }
}
