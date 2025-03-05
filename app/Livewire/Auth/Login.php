<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class Login extends Component
{
    use WireUiActions;

    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    /** @var string|null */
    public $status;

    protected $rules = [
        'email' => ['required'],
        'password' => ['required'],
    ];

    public function mount()
    {  
        if (session('success')) {
            $this->dialog()->show([
                'icon' => 'success',
                'title' => 'Success!',
                'description' => session('success'),
            ]);
        }

        if (session('error')) {
            $this->addError('email', session('error'));
        }
    }

    public function authenticate()
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));
            return;
        }

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
