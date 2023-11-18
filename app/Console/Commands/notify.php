<?php

namespace App\Console\Commands;

use App\Mail\NotifyEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        // $users =  User::select('email')->get();
        $emails = User::pluck('email')->toArray(); // Fix the typo here
        $data = ['title' => 'program', 'body' => 'php'];

        foreach ($emails as $email) {
            Mail::to($email)->send(new NotifyEmail($data));
        }
    }

}
