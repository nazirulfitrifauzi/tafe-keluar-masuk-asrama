<?php

namespace App\Livewire;

use App\Mail\IncomingMovement;
use App\Models\MovementHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Incoming extends Component
{
    public $status;
    public $name;
    public $phoneNo;
    public $course;
    public $destination;
    public $icNo;
    public $outDateTime;
    public $inDateTime;
    public $roomNo;
    public $submit;
    public $outData;

    public function mount($status = null)
    {
        $this->status = $status ?? request()->query('status', 'default');

        $this->name = strtoupper(auth()->user()->name);
        $this->phoneNo = strtoupper(auth()->user()->phone_no);
        $this->course = strtoupper(auth()->user()->course);
        $this->icNo = auth()->user()->ic_no;
        $this->roomNo = strtoupper(auth()->user()->room_no);

        if($this->status == 'sent') {
            $this->outData = MovementHistory::whereUserId(auth()->id())->whereNotNull('out')->whereNotNull('in')->orderBy('created_at', 'desc')->first();
        } else {
            $this->outData = MovementHistory::whereUserId(auth()->id())->whereNotNull('out')->whereNull('in')->orderBy('created_at', 'desc')->first();
        }
        
        $this->destination = $this->outData->destination;
        $this->outDateTime = $this->outData->out->format('d/m/Y h:i:s A');
        $this->inDateTime = $this->outData->in?->format('d/m/Y h:i:s A');
    }

    public function recordInfo()
    {
        if ($this->outData) {
            $this->outData->update([
                'in' => now()->setTimezone('Asia/Kuala_Lumpur'),
            ]);

            $this->sendEmail($this->outData->id);

            // Redirect back to login with a session message
            return redirect()->route('incoming', ['status' => 'sent']);
        }
    }

    private function sendEmail($id)
    {
        $data = MovementHistory::whereId($id)->first();
        $user = auth()->user();
        $data = [
            'name' => $this->name,
            'destination' => $this->destination,
            'outDateTime' => $data->out->format('d/m/Y h:i:s A'),
            'inDateTime' => $data->in->format('d/m/Y h:i:s A'),
            'duration' => $data->out->diff($data->in)->format('%h hours %i minutes'),
        ];

        Mail::to($user->beneficiary_email)->send(new IncomingMovement($data));
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }

    public function render()
    {
        return view('livewire.incoming')->extends('layouts.student');
    }
}
