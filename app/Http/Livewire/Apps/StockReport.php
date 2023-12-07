<?php

namespace App\Http\Livewire\Apps;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;


class StockReport extends Component
{
    use WithPagination;

    public $selectedStatus = null;
    public $perPage = 2;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // Récupérez tous les produits
        $products = Product::with(['unit', 'supplies' => function ($query) {
            $query->latest()->first();
        }])->get();

        // Déterminez le statut du stock pour chaque produit
        $products->each(function ($product) {
            $product->stock_status = $product->calculateStockStatus();
        });

        // Filtrez les produits si un statut est sélectionné
        if ($this->selectedStatus) {
            $products = $products->filter(function ($product) {
                return $product->stock_status == $this->selectedStatus;
            });
        }

        // Calculez les produits à afficher pour la page actuelle
        $items = $products->forPage($this->page, $this->perPage);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $products->count(),
            $this->perPage,
            $this->page,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()] // Utilisez la méthode statique resolveCurrentPath()
        );

        // Récupérez tous les statuts de stock distincts pour le menu déroulant
        $statuses = [
            'Critique' => 'critical',
            'Normal' => 'normal',
        ];

        return view('livewire.apps.stock-report', [
            'products' => $paginator,
            'statuses' => $statuses
        ]);
    }
}

