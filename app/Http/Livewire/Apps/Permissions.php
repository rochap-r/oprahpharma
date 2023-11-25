<?php

namespace App\Http\Livewire\Apps;

use App\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;

class Permissions extends Component
{
    use WithPagination;
    public $name;
    public $description;
    public $selected_id;

    public $perPage = 8;

    public function mount()
    {
        $this->resetPage();
    }


    protected $listeners=[
        'resetForm',
    ];



    public function resetForm()
    {
        $this->resetErrorBag();
        $this->name=$this->description=null;

    }



    public function editPermission(int $id)
    {
        $permission=Permission::findOrFail( $id);

        $this->selected_id=$permission->id;
        $this->name=$permission->name;
        $this->description=$permission->description;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showEditPermissionsModal');
    }

    public function updateRole()
    {
        if ($this->selected_id) {
            $this->validate([
                'description'=>'required|unique:permissions,description,'.$this->selected_id,
            ], [
                'description.required'=>'le nom d\'url est obligatoire',
                'description.unique'=>'Ce nom d\'url existe déjà veuillez réessayez un autre nom!'
            ]);

            $role = Permission::findOrFail($this->selected_id);

            $role->name=$this->name;
            $role->description=$this->description;
            $result=$role->save();
            if ($result) {
                $this->name=$this->description = null;
                $this->dispatchBrowserEvent('hidePermissionsModal');
                $this->showToastr('Une URL a  été mis à jour avec succès!', 'success');
            } else {
                $this->showToastr('Oups! Quelquechose n\'a pas bien fonctionné!', 'error');
            }
        }
    }


    public function showToastr($message,$type){
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }


    public function render()
    {

        //dd(Permission::all());

        return view('livewire.apps.permissions',[
            'permissions'=>Permission::orderBy('id','asc')->paginate($this->perPage),
        ]);
    }

}
