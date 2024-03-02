<?php

namespace App\Livewire;

use Livewire\Component;

class AboutComponent extends Component
{
    public $title = "About";
    public function render()
    {
        return view('livewire.about-component')->layout('layouts.app', ['title' => $this->title]);
    }
}
