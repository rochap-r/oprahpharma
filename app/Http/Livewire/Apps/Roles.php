<?php

namespace App\Http\Livewire\Apps;

use App\Models\Permission;
use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class Roles extends Component
{
    use WithPagination;
    public $name;
    public $permission =[];
    public $selected_id;

    public $perPage = 8;

    public function mount()
    {
        $this->resetPage();
    }

    public $rules=['name'=>'required | unique:roles,name'];
    public $messages= [
        'name.required'=>'le nom du role est obligatoire',
        'name.unique'=>'Ce role existe déjà veuillez réessayez un autre nom!'
    ];
    protected $listeners=[
        'resetForm',
        'deleteRoleAction'
    ];



    public function resetForm()
    {
        $this->resetErrorBag();
        $this->name=$this->permission=null;

    }

    public function addRole()
    {
        $validated=$this->validate($this->rules,$this->messages);

        //creation du role et attachement des permissions
        $role=Role::create($validated);
        $result=$role->permissions()->sync($this->permission);

        if ($result){
            $this->dispatchBrowserEvent('hideRolesModal');
            $this->name=$this->permission=null;

            $this->showToastr('Le nouveau Role a  été enregistrée avec succès!','success');
        }else{
            $this->showToastr('Oups! Quelquechose n\'a pas bien fonctionné!','error');
        }
    }

    public function editRole(int $id)
    {
        $role=Role::findOrFail( $id);

        foreach ($role->permissions as $rl){
            $this->permission[]=$rl->id;
        }

        /*$this->permission=$role->permissions->toArray();*/

        $this->selected_id=$role->id;
        $this->name=$role->name;
        //dd($this->updateCategoryMode);
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showEditRolesModal');
    }

    public function updateRole()
    {
        if ($this->selected_id) {
            $this->validate([
                'name'=>'required|unique:roles,name,'.$this->selected_id,
            ], [
                'name.required'=>'le nom du role est obligatoire',
                'name.unique'=>'Ce nom existe déjà veuillez réessayez un autre nom!'
            ]);

            $role = Role::findOrFail($this->selected_id);

            $role->name=$this->name;
            $role->save();

            $result = $role->permissions()->sync($this->permission);
            if ($result) {
                $this->name=$this->permission = null;
                $this->dispatchBrowserEvent('hideRolesModal');
                $this->showToastr('Le nouveau Role a  été mis à jour avec succès!', 'success');
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


    public function deleteRole(int $id)
    {
        $role=Role::findOrFail($id);
        //dd($role);
        $this->dispatchBrowserEvent('deleteRole',[
            'title'=>'Etes-vous vraiment sure de supprimer ce Role?',
            'html'=>"Suppression du Role: ".$role->name,
            'id'=>$role->id
        ]);
    }

    public function deleteRoleAction(int $id)
    {
        $role=Role::findOrFail($id);
        $admin_role_id=Role::where('name','admin')->first()->id;
        $user_role_id=Role::where('name','user')->first()->id;
        if (($admin_role_id!==$id) && ($user_role_id!==$id)){
            $role->users()->update(['role_id'=>$user_role_id]);
            $role->delete();
            $this->showToastr("le Role a été supprimé avec succès.", 'info');
        }else{
            $this->showToastr("Il est impossible de supprimer ce Role, qui est configuré par defaut.", 'error');
        }

    }

    public function render()
    {

        //dd(Permission::all());

        return view('livewire.apps.roles',[
            'roles'=>Role::latest()->orderBy('id','asc')->withCount('users')->paginate($this->perPage),
            'permissions'=>Permission::all(),
        ]);
    }

}
