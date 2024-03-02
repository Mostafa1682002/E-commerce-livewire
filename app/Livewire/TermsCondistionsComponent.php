<?php

namespace App\Livewire;

use Livewire\Component;

class TermsCondistionsComponent extends Component
{
    public $title = "Terms & Conditions";
    public function render()
    {
        return view('livewire.terms-condistions-component')->layout('layouts.app', ['title' => $this->title]);
    }
}
