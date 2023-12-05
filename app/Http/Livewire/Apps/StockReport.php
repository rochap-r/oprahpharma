<?php

namespace App\Http\Livewire\Apps;

use Livewire\Component;

class StockReport extends Component
{

    public $selectedUnit = null;

    public function render()
    {
        $query = \App\Models\Product::query()
            ->with(['unit', 'supplies' => function ($query) {
                $query->latest()->first();
            }]);

        if ($this->selectedUnit) {
            $query->whereHas('unit', function ($query) {
                $query->where('id', $this->selectedUnit);
            });
        }

        $products = $query->get()->each(function ($product) {
            // Assurez-vous d'obtenir le dernier approvisionnement pour le produit
            $latestSupply = $product->supplies()->latest()->first();

            // Vérifiez si la quantité en stock du dernier approvisionnement est critique
            $product->stock_status = !$latestSupply || $latestSupply->quantity_in_stock <= $product->unit->minimum_stock_level
                ? 'critical' : 'normal';
        });
        //dd($products);


        $units = \App\Models\Unit::all();

        return view('livewire.apps.stock-report', [
            'products' => $products,
            'units' => $units
        ]);
    }

}
