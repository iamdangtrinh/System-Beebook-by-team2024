<?php

namespace App\Livewire;

use Livewire\Component;

class UserAdmin extends Component
{
    public function Mount(){
        dd('hello');
    }
    public function render()
    {
        return view('livewire.user-admin');
    }
}
