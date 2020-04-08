<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Hash;


class createAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add new admin to user table';

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
        // Retrieve a specific option...
        $email = $this->option('email');
        $password = $this->option('password');
        
        $admin = User::create([
            'national_id' => '11111111111111',
            'name' => 'Admin',
            'email' => $email,
            'password' => Hash::make($password),
            'role_id' => 0
         ]);
         if($admin){
             $this->info('Admin user successfully created the email is '.$email.' and the password is "'.$password.'" ');
         }
    }
}
