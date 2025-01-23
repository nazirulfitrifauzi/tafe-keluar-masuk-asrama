<?php

namespace App\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;

class Register extends Component
{
    /** @var string */
    public $name = '';

    /** @var string */
    public $phoneNo = '';

    /** @var string */
    public $course = '';

    /** @var string */
    public $email = '';

    /** @var string */
    public $icNo = '';

    /** @var string */
    public $username = '';

    /** @var string */
    public $roomNo = '';

    /** @var string */
    public $password = '';

    public function register()
    {
        $this->validate([
            'name' => ['required'],
            'phoneNo' => ['required'],
            'course' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'icNo' => ['required'],
            'username' => ['required'],
            'roomNo' => ['required'],
            'password' => ['required', 'min:8'],
        ]);

        $user = User::create([
            'email' => $this->email,
            'name' => $this->name,
            'phone_no' => $this->phoneNo,
            'course' => $this->course,
            'ic_no' => $this->icNo,
            'username' => $this->username,
            'room_no' => $this->roomNo,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        session()->flash('success', 'User successfully registered.');

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
