<?php

namespace App\Livewire;

use App\Models\MovementHistory;
use Livewire\Component;

class History extends Component
{
    public $date;

    public function render()
    {
        $datas = MovementHistory::with('user')
            ->when($this->date, function ($query) {
                return $query->whereDate('created_at', $this->date);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.history', [
            'datas' => $datas
        ])->extends('layouts.app');
    }
}
