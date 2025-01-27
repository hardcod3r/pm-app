<?php declare (strict_types = 1);   

namespace App\Tasks\Api;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserCreated;
class NotifyOtherAdminsTask
{
    /**
     * Execute the task.
     *  
     * @param User $user
     * @return void
     */
    public function run(User $user, string $except) : void
    {
        $admins = User::adminsOnly()->exceptUserId($except)->get();
        //array map to notify all admins
        $admins->map(function($admin) use ($user){
            logger()->info('Notifying admin: '.$admin->email.' about new user: '.$user->email);
            //mail notification approach
           # Mail::to($admin->email)->send(new NewUserCreated($user, $admin));
        });
    }

}