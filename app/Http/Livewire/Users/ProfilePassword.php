<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ProfilePassword extends Component
{
    public $passwordA, $passwordC,$password;

    public function changePassword(){
        $this->validate([
            'passwordA'=>[
                'required',function($attribute,$value,$fail){
                    if(!Hash::check($value, User::find(auth()->id())->password)){
                        return $fail(__('Le mot de que vous avez saisi est incorrect'));
                    }
                },
            ],
            'password'=>[
                'required',function($attribute,$value,$fail){
                    if(Hash::check($value, User::find(auth()->id())->password)){
                        return $fail(__('Le mot de que vous avez saisi est déjà prit!'));
                    }
                },
                'min:8','max:25',
            ],
            'passwordC'=>'same:password'
        ],[
            'passwordA.required'=>'Veuillez saisir l\'ancien mot de passe',
            'password.required'=>'Saississez le nouveau mot de passe',
            'password.min'=>'Le mot de passe doit comporter au moins 8 caractères.',
            'password.max'=>'Le mot de passe doit comporter au plus 25 caractères.',
            'passwordC.same'=>'ce mot de passe doit correspondre au nouveau mot de passe',
        ]);

        //chgmt du mdp
        $query=User::find(auth()->id())->update([
            'password'=>Hash::make($this->password)
        ]);

        if($query){
            $this->showToastr('Votre mot de passe a été changé avec succès.','success');
            //vider les champs
            $this->passwordA=$this->password=$this->passwordC=null;
        }else{
            $this->showToastr('Quelque chose ne va pas bien.','error');
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
        return view('livewire.users.profile-password');
    }
}


