<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Mail;

class cronEmail extends Command
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
    protected $description = 'Send number of registered users every day';

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle()
    {
        $admin=Admin::first();
        $date =  Date::now();
        $date->modify("-1 day");
        $users=User::where('created_at','>=',$date)->get();
        $to_name = $admin->name;
        $to_email = 'ahmadalzein06@gmail.com';
        $data = ['number',sizeof($users)];
Mail::send("email-template", $data, function($message) use ($to_name, $to_email) {
    $message->to($to_email, $to_name)
        ->subject("Daily Update");
$message->from(env('MAIL_USERNAME'));
});
return response()->json(['status'=>true]);
    }


}
