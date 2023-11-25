<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

class ProfileTabs extends Component
{
    public $tab;
    protected $queryString = ['tab'];

    public function mount()
    {
        $this->tab = request()->get('tab', 'profile_infos');
    }

    public function render()
    {
        return view('livewire.users.profile-tabs');
    }
}
