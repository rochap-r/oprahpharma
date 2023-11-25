<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    protected $listeners=[
        'UpdateProfile'=>'$refresh'
    ];
    public $user;
    public function mount(){
        $this->user=User::find(auth()->id());
    }
    public function render()
    {
        return view('livewire.users.profile');
    }
}
