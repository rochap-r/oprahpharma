<?php

namespace App\Http\Livewire\Apps;


use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;


class StockReport extends Component
{
    use WithPagination;

    public $selectedStatus = null;
    public $perPage = 25;

    public $statuses = [
        'Critique' => 'critical',
        'Normal' => 'normal',
    ];

    protected $paginationTheme = 'bootstrap';

    /*Code de generation de rapport de stock*/
    public function getExportData()
    {
        $products = Product::with(['unit', 'supplies' => function ($query) {
            $query->latest()->first();
        }])->get();

        $products->each(function ($product) {
            $product->stock_status = $product->calculateStockStatus();
        });

        if ($this->selectedStatus) {
            $products = $products->filter(function ($product) {
                return $product->stock_status == $this->selectedStatus;
            });
        }

        return $products;
    }

    public function exportToPdf()
    {
        $products = $this->getExportData();
        $pdf = PDF::loadView('livewire.apps.stock-report-pdf', [
            'products' => $products
        ]);
        // Générer un nom de fichier avec la date et un identifiant unique
        $fileName = 'rapport-de-stock-' . date('Y-m-d-His') . '.pdf';
        return response()->streamDownload(
            fn() => print($pdf->output()),
            $fileName
        );
    }
    /*fin pdf*/

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


        return view('livewire.apps.stock-report', [
            'products' => $paginator,
            'statuses' => $this->statuses
        ]);
    }
}

