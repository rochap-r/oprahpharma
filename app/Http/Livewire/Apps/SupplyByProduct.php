<?php

namespace App\Http\Livewire\Apps;

use App\Models\Supply;
use Livewire\Component;
use Livewire\WithPagination;

class SupplyByProduct extends Component
{
    use WithPagination;

    public $product_id, $quantity_purchased, $unit_purchase_price, $supply_date, $expiration_date;
    public $quantity_in_stock = 0;
    public $selected_id;

    public $productId;
    public $perPage = 8;
    public $updateSupplyByProductMode = false;

    protected $listeners = [
        'resetForm',
        'deleteSupplyAction'
    ];

    public function mount()
    {
        $this->productId=(int)request('id');
        $this->resetPage();
    }


    public function render()
    {
        //dd($this->productId);
        $supplies=Supply::where('product_id',$this->productId)->latest()->orderBy('id', 'desc')->with('product')->paginate($this->perPage);
        return view('livewire.apps.supply.supply-by-product',[
            'supplies'=>$supplies,
        ]);
    }
}
