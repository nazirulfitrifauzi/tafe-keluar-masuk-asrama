<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class StudentDetail extends Component
{
    public function render()
    {
        $users = User::whereIsAdmin(0)->paginate(7);
        
        return view('livewire.student-detail', [
            'users' => $users
        ])->extends('layouts.app');
    }
}
