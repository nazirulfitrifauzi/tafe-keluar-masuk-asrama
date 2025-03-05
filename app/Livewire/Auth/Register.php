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

    /** @var string */
    public $passwordConfirmation = '';

    public function register()
    {
        $this->validate([
            'name' => ['required'],
            'phoneNo' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'icNo' => ['required'],
            'password' => ['required', 'min:8', 'same:passwordConfirmation'],
        ]);

        $user = User::create([
            'email' => $this->email,
            'name' => $this->name,
            'phone_no' => $this->phoneNo,
            'ic_no' => $this->icNo,
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
