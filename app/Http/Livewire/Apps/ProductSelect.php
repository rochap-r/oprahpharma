<?php

namespace App\Http\Livewire\Apps;

use Livewire\Component;

class ProductSelect extends Component
{
    public $search = '';
    public $product_id;

    protected $listeners = [
        'resetComponent' => 'resetComponent',
    ];


    public function resetComponent()
    {
        $this->resetErrorBag();
        $this->product_id =$this->search= null;
    }

    public function updatedSearch()
    {
        $this->product_id = null; // Réinitialiser le product_id lors d'une nouvelle recherche
    }

    public function selectProduct($productId)
    {
        $this->product_id = $productId;
        $this->emit('productSelected', $productId); // Émettre l'événement avec l'ID du produit
        $this->search = ''; // Réinitialiser la recherche après la sélection
    }




    public function render()
    {
        $products = \App\Models\Product::where('product_name', 'like', '%' . $this->search . '%')
            ->orderBy('product_name', 'asc')
            ->get();

        return view('livewire.apps.product-select', compact('products'));
    }


}
