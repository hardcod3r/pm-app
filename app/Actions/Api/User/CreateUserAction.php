<?php declare (strict_types = 1);

namespace App\Actions\Api\User;

use App\Tasks\Api\CreateUserTask;
use App\Tasks\Api\NotifyOtherAdminsTask;
use App\Http\Resources\UserResource;
class CreateUserAction
{
    /**
     * Execute the action.
     *  
     * @param array $data
     * @return mixed
     */
    public function run(array $data) : mixed
    {
        $user = app(CreateUserTask::class)->run($data);
        if($user->success === false){
            return $user;
        }
        app(NotifyOtherAdminsTask::class)->run($user, auth()->id());
        return new UserResource($user);
    }
}