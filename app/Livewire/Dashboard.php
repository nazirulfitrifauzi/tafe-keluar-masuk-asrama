<?php

namespace App\Livewire;

use App\Models\MovementHistory;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard')->extends('layouts.app');
    }
}
