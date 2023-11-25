<?php

namespace App\Http\Livewire\Layouts;

use App\Models\User;
use Livewire\Component;

class Header extends Component
{
    public $user;

    protected $listeners=[
        'UpdateHeader'=>'$refresh'
    ];

    public function mount(){
        $this->user=User::find(auth()->id());
    }
    public function render()
    {
        //dd($this->user->image);
        return view('livewire.layouts.header');
    }
}
