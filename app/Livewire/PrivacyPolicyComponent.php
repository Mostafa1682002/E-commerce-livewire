<?php

namespace App\Livewire;

use Livewire\Component;

class PrivacyPolicyComponent extends Component
{
    public $title = "Privacy Policy";
    public function render()
    {
        return view('livewire.privacy-policy-component')->layout('layouts.app', ['title' => $this->title]);
    }
}
