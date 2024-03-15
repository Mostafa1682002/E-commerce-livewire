<?php

namespace App\Jobs;

use App\Events\OrderNotification;
use App\Models\Admin;
use App\Notifications\NewOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class NewOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //Event
        event(new OrderNotification($this->data));
        //Send Notification;
        $admins = Admin::all();
        Notification::send($admins, new NewOrder($this->data));
    }
}
