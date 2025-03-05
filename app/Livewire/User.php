<?php

namespace App\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Component;

class User extends Component
{
    public function render()
    {
        $users = ModelsUser::whereIsAdmin(0)->paginate(7);

        return view('livewire.user', [
            'users' => $users
        ])->extends('layouts.app');
    }
}
