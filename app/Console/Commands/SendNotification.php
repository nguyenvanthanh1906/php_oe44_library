<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\NotAcceptedRequestsNotification;
use App\Models\CRequest;
use App\Models\User;
use Pusher\Pusher;
use App\Http\Controllers\Controller;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily notification to admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('role_id', 1)->get(); 
        $count = CRequest::where('is_approve', 0)->count();
        $data = ['content' => 'You have '.$count.' request are not accepted yet', 'time' => date("d-m-Y H:i:s"), 'title' => 'Daily notification', 'link' => 'http://localhost:8000/admin/all/accepted=0'];
        foreach($users as $user)
        {
            $user->notify(new NotAcceptedRequestsNotification($data));
        }
        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('NotificationEvent', 'send-message', $data);
                    
    }
}
