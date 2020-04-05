<?php

namespace App\Console\Commands;

use App\Client;
use App\Notifications\CheckOnUser;
use Illuminate\Console\Command;

class notifyUsersNotLoggedInForMonth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users-not-logged-in-for-month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send an email notification to users ​ who didn’t login from the
    past month​';

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
     * @return mixed
     */
    public function handle()
    {
        $clients = Client::where('last_login_at', '<', now()->subDays(30))->get();
        foreach ($clients as $client) {
            $client->user->notify(new CheckOnUser);
        }
    }
}
