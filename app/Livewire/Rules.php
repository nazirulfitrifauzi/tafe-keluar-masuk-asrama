<?php

namespace App\Livewire;

use Livewire\Component;

class Rules extends Component
{
    public function render()
    {
        return view('livewire.rules')->extends('layouts.app');
    }
}
