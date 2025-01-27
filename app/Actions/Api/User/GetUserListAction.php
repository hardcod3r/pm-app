<?php declare (strict_types = 1);

namespace App\Actions\Api\User;

use App\Http\Resources\UserResource;
use App\Models\User;
class GetUserListAction
{
    /**
     * Execute the action.
     *  
     * @return mixed
     */
    public function run()
    {
        try{
            $users = User::paginate();
            return   UserResource::collection($users);
        }catch(\Exception $e){
            return [
                'status' => 'error',
                'message' => 'Unable to fetch users',
                'errors' => [$e->getMessage()],
            ];
        }
  
    }
}