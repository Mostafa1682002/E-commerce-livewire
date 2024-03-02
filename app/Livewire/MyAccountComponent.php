<?php

namespace App\Livewire;

use Livewire\Component;

class MyAccountComponent extends Component
{
    public $title = "My Account";
    public $user;
    public $name;
    public $email;
    public $phone;
    public $password = '';
    public $password_confirmation = '';

    public function mount()
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => "required|string|max:255",
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'phone' => "required|max:20|unique:users,phone," . $this->user->id,
            'password' => "nullable|string|confirmed|min:6",
        ]);
        if ($this->password != null || $this->password != '') {
            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => bcrypt($this->password)
            ]);
        }
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
        $this->reset(['password', 'password_confirmation']);
        session()->flash('success_up', 'Success Update Your Account');
    }

    public function render()
    {

        $orders = auth()->user()->orders;
        return view('livewire.my-account-component', compact('orders'))
            ->layout('layouts.app', ['title' => $this->title]);
    }
}
