<?php

namespace App\Livewire\Record;

use App\Models\MovementHistory;
use Livewire\Component;

class Incoming extends Component
{
    public function render()
    {
        $datas = MovementHistory::with('user')->whereDate('created_at', now()->format('Y-m-d'))->whereNotNull('in')->get();

        return view('livewire.record.incoming', [
            'datas' => $datas
        ]);
    }
}
