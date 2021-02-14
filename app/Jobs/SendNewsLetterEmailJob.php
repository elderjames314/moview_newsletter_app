<?php

namespace App\Jobs;

use App\Mail\NewsLetter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewsLetterEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //get the list of the active subscribers
        $activeSubscribers = getActiveSubscribers();

        //check if there are any active subscribers and if yes, fire the newsletter email
        if(count($activeSubscribers) > 1) {
            foreach ($activeSubscribers as $subscriber) {
                Mail::to($subscriber->user->email)->send(new NewsLetter($this->data));
            }
        }

      
    }
}
