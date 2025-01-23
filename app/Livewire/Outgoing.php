<?php

namespace App\Livewire;

use App\Mail\OutgoingMovement;
use App\Models\MovementHistory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Outgoing extends Component
{
    public $status;
    public $name;
    public $phoneNo;
    public $course;
    public $destination;
    public $icNo;
    public $outTime;
    public $outDate;
    public $roomNo;
    public $submit;

    public function mount($status = null)
    {
        $this->status = $status ?? request()->query('status', 'default');

        $this->name = strtoupper(auth()->user()->name);
        $this->phoneNo = strtoupper(auth()->user()->phone_no);
        $this->course = strtoupper(auth()->user()->course);
        $this->icNo = auth()->user()->ic_no;
        $this->roomNo = strtoupper(auth()->user()->room_no);

        if ($this->status == 'sent') {
            $data = MovementHistory::whereUserId(auth()->id())->orderBy('created_at', 'desc')->first();
            $this->destination = $data->destination;
            $this->outTime = $data->out->format('h:i:s A');
            $this->outDate = $data->out->format('d/m/Y');
        }
    }

    public function recordInfo()
    {
        // $prevRecord = MovementHistory::whereNull('in')->orderBy('created_at', 'desc')->first();

        $id = MovementHistory::create([
            'user_id' => auth()->id(),
            'destination' => $this->destination,
            'out' => now()->setTimezone('Asia/Kuala_Lumpur'),
        ])->id;

        $this->sendEmail($id);

        // Redirect back to login with a session message
        return redirect()->route('outgoing', ['status' => 'sent']);
    }

    private function sendEmail($id)
    {
        $data = MovementHistory::whereId($id)->first();
        $user = auth()->user();
        $data = [
            'name' => $this->name,
            'destination' => $this->destination,
            'outTime' => $data->out->format('H:i:s A'),
            'outDate' => $data->out->format('d/m/Y'),
        ];

        Mail::to($user->beneficiary_email)->send(new OutgoingMovement($data));
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }

    public function render()
    {
        return view('livewire.outgoing')->extends('layouts.student');
    }
}
