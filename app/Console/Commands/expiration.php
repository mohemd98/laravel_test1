<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expire users evrey 5 miunte automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {

     $users =  User::where('expire', 0 )->get();

     foreach ($users as $user){
         $user->update(['expire'=> 1]);
     }

    }
}
