<?php declare (strict_types = 1);

namespace App\Tasks\Api;
use App\Models\User;
use App\Enums\Role;
class CreateUserTask
{
    /**
     * Execute the task.
     *  
     * @param array $data
     * @return mixed
     */
    public function run(array $data) : mixed
    {
        try{
            //also set default role
            $data['role'] = Role::User;
            //also set email_verified_at
            $data['email_verified_at'] = now();
            $user = User::create($data);
            $user->refresh();
            return $user;
        }catch(\Exception $e){
            return [
                'success' => false,
                'message' => 'Unable to create user',
                'errors' => [$e->getMessage()],
            ];
        }
  
    }
}