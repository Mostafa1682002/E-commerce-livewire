<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class HeaderComponent extends Component
{
    public $numNotificationUnread, $notifications;

    public function render()
    {
        $this->numNotificationUnread = count(auth('admin')->user()->unreadNotifications);
        $this->notifications = auth('admin')->user()->notifications;
        return view('livewire.dashboard.header-component')->layout('layout.master');
    }
}
