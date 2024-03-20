<?php

namespace App\Http\Livewire\Apps;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Unit as Units;

class Unit extends Component
{
    use WithPagination;
    public $unit_name,$unit_sigle,$minimum_stock_level;
    public $selected_id;

    public $perPage = 8;

    public $search = '';
    public $updateUnitMode=false;

    public function mount()
    {
        $this->resetPage();
    }


    protected $listeners=[
        'resetForm',
        'deleteUnitAction'
    ];

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->updateUnitMode=false;
        $this->unit_name=null;

    }
    public function addUnit()
    {
        $this->validate([
            'unit_name' => 'required|unique:units,unit_name',
            'unit_sigle' => 'required|unique:units,unit_sigle|max:10',
            'minimum_stock_level' => 'required|integer',

        ], [
            'unit_name.required' => 'le nom dé l\'unité de mesure est obligatoire',
            'unit_name.unique' => 'ce nom de l\'unité de mesure existe déjà veuillez réessayez un autre!',

            'minimum_stock_level.required' => 'Le seuil de stock est obligatoire, mettez même 0 sauf un vide.',
            'minimum_stock_level.integer' => 'Le seuil de stock doit être un nombre entier.',

            'unit_sigle.required' => 'le nom dé l\'abréviation unité de mesure est obligatoire',
            'unit_sigle.unique' => 'ce nom de l\'abréviation unité de mesure existe déjà veuillez réessayez un autre!',
            'unit_sigle.max' => 'l\'abréviation de l\'unité de mesure ne doit pas dépasser 10 caractères',
        ]);
        DB::transaction(function () {
            $unit = new Units();
            $unit->unit_name = $this->unit_name;
            $unit->unit_sigle = $this->unit_sigle;
            $unit->minimum_stock_level = $this->minimum_stock_level;
            $result = $unit->save();
            if ($result) {
                $this->dispatchBrowserEvent('hideUnitModal');
                $this->unit_name = $this->unit_sigle = $this->minimum_stock_level = null;
                $this->showToastr('La nouvelle unité de mesure a  été enregistré avec succès!', 'success');
            } else {
                $this->showToastr('Oups! Quelque chose n\'a pas bien fonctionné!', 'error');
            }
        });

    }

    public function editUnit(int $id)
    {
        $unit=Units::findOrFail( $id);
        $this->selected_id=$unit->id;
        $this->unit_name=$unit->unit_name;
        $this->unit_sigle=$unit->unit_sigle;
        $this->minimum_stock_level=$unit->minimum_stock_level;
        $this->updateUnitMode=true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showEditUnitModal');
    }

    public function updateUnit()
    {
        if ($this->selected_id){
            $this->validate([
                'unit_name' => 'required|unique:units,unit_name,' . $this->selected_id,
                'unit_sigle' => 'required|unique:units,unit_sigle,' . $this->selected_id . '|max:10',
                'minimum_stock_level' => 'required|integer',
            ], [
                'minimum_stock_level.required' => 'Le seuil de stock est obligatoire, mettez même 0 sauf un vide.',
                'unit_name.unique' => 'Ce nom d\'unité est déjà utilisé.',
                'unit_sigle.unique' => 'Ce sigle d\'unité est déjà utilisé.',
                'minimum_stock_level.integer' => 'Le seuil de stock doit être un nombre entier.',
                'unit_name.required' => 'le nom dé l\'unité de mesure est obligatoire',
                'unit_sigle.required' => 'l\'abréviation de l\'unité de mesure est obligatoire',
                'unit_sigle.max' => 'l\'abréviation de l\'unité de mesure ne doit pas dépasser 10 caractères',
            ]);

            DB::transaction(function () {
                $unit=Units::findOrFail($this->selected_id);
                $unit->unit_name=$this->unit_name;
                $unit->unit_sigle=$this->unit_sigle;
                $unit->minimum_stock_level=$this->minimum_stock_level;
                $result=$unit->save();
                if ($result){
                    $this->dispatchBrowserEvent('hideUnitModal');
                    $this->updateUnitMode=false;
                    $this->unit_name=$this->unit_sigle=$this->minimum_stock_level=null;
                    $this->showToastr('L\'unité de mésure  a bien été mise à jour!','success');
                }else{
                    $this->showToastr('Oups! Quelque chose n\'a pas bien fonctionné!','error');
                }
            });


        }
    }


    public function showToastr($message,$type){
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }

    public function deleteUnitAction(int $id)
    {
        $unit=Units::find($id);
        if ($unit){
            $products=$unit->products;
            foreach ( $products as $product) {
                $product->update(['unit_id' => null]);
            }
            $unit->delete();

            $this->showToastr("l\'unité de mésure a été supprimée avec succès.", 'info');
        }else{
            $this->showToastr("Il est impossible de supprimer ce produit, qui est configurée par defaut.", 'error');
        }

    }

    public function deleteUnit(int $id)
    {
        $unit=Units::find($id);
        $this->dispatchBrowserEvent('deleteUnit',[
            'title'=>'Etes-vous vraiment sure de supprimer cette unité de mésure?',
            'html'=>"Suppression de l'unité de mésure: ".$unit->unit_name,
            'id'=>$unit->id

        ]);
    }
    public function render()
    {
        $unitsQuery = Units::latest()->orderBy('id', 'asc')->withCount('products');

        if ($this->search !== '') {
            $unitsQuery->where('unit_name', 'like', '%' . $this->search . '%');
        }

        return view('livewire.apps.unit', [
            'units' => $unitsQuery->paginate($this->perPage),
        ]);
    }

}
