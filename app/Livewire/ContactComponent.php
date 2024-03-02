<?php

namespace App\Livewire;

use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ContactComponent extends Component
{
    public $title = "Contact";

    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;

    public function send()
    {
        $validData =  $this->validate([
            'name' => 'required|min:6|max:255',
            'email' => 'required|email|max:100',
            'phone' => "required|string|max:20",
            'subject' => "required|string|max:255",
            'message' => "required|string|min:3"
        ]);
        Contact::create($validData);
        session()->flash('success_contact', 'Message Successfuly Sended');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.contact-component')->layout('layouts.app', ['title' => $this->title]);
    }
}
