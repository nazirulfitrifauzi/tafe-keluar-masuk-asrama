<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class Login extends Component
{
    use WireUiActions;

    /** @var string */
    public $username = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    /** @var string|null */
    public $status;

    protected $rules = [
        'username' => ['required'],
        'password' => ['required'],
    ];

    public function mount($status = null)
    {
        $this->status = $status;

        if (session('success')) {
            $this->dialog()->show([
                'icon' => 'success',
                'title' => 'Success!',
                'description' => session('success'),
            ]);
        }

        if (session('error')) {
            $this->addError('username', session('error'));
        }
    }

    public function authenticate()
    {
        $this->validate();

        if (!Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            $this->addError('username', trans('auth.failed'));
            return;
        }

        if ($this->status === 'outgoing') {
            return redirect()->route('outgoing');
        } elseif ($this->status === 'incoming') {
            return redirect()->route('incoming');
        }

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
