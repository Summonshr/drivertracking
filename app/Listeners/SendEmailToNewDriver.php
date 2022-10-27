<?php

namespace App\Listeners;

use App\Events\DriverAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailToNewDriver
{
    public function __construct() {
    }
    /**
     * Handle the event.
     *
     * @param  \App\Events\DriverAdded  $event
     * @return void
     */
    public function handle(DriverAdded $event)
    {
        dd($event);
    }
}
