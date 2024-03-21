<?php

namespace App\Http\Livewire\Apps;

use App\Models\Supply;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;


class LoadSupply extends Component
{
    use WithFileUploads;

    public $file;

    public function render()
    {
        return view('livewire.apps.load-supply');
    }

    public function save()
    {

        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv'
        ],[
            'file.required' => 'fichier obligatoire',
            'file.mimes' => 'chargez un fichier excel',
        ]);

        // Charger le fichier Excel
        $spreadsheet = IOFactory::load($this->file->getRealPath());


        // Sélectionner l'onglet 'appro'
        $worksheet = $spreadsheet->getSheetByName('appro');

        DB::transaction(function () use ($worksheet) {
            $rowNumber = 1;
            foreach ($worksheet->getRowIterator() as $row) {
                // Si c'est la première ligne (ligne d'en-tête), ignorez-la
                if ($rowNumber == 1) {
                    $rowNumber++;
                    continue;
                }

                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false); // Permet d'inclure les cellules vides

                $row_data = [];
                foreach ($cellIterator as $cell) {
                    $row_data[] = $cell->getValue();
                }

                // Assurez-vous que la ligne contient les données nécessaires
                if (count($row_data) >= 3) {
                    $product_name = $row_data[0];
                    $quantity_purchased = $row_data[1];
                    $unit_purchase_price = $row_data[2];
                    //conversion date excel
                    $expiration_date = Carbon::createFromDate(1900, 1, 1)->addDays($row_data[3] - 2);
                    $supply_date = Carbon::now();

                    // Rechercher le produit par son nom
                    $product = \App\Models\Product::where('product_name', $product_name)->first();

                    if (!$product) {
                        // Gérer le cas où le produit n'est pas trouvé
                        // Par exemple, vous pouvez enregistrer un message d'erreur dans un fichier journal
                        Log::error("Product {$product_name} not found.");
                    } else {
                        // Créer un nouvel approvisionnement
                        $supply = new Supply();
                        $supply->product_id = $product->id;
                        $supply->quantity_purchased = $quantity_purchased;
                        $supply->quantity_in_stock = $this->updateQuantityInStock($product->id, $quantity_purchased);
                        $supply->unit_purchase_price = $unit_purchase_price;
                        $supply->supply_date = $supply_date;
                        $supply->expiration_date = $expiration_date;
                        $supply->save();

                    }
                }

                $rowNumber++;
            }
        });


        $this->reset('file');
        // Stocker le message dans une session flash
        session()->flash('toastr', [
            'message' => 'Les lignes d\'approvisionnement ont été chargé avec succés !',
            'type' => 'success'
        ]);

        // Rediriger vers la nouvelle page
        return redirect()->route('app.supply.products');

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

}

