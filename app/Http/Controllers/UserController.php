<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Actions\Api\User\GetUserListAction;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\ListUsersRequest;
use App\Http\Requests\User\ShowUserRequest;
use App\Http\Requests\User\DestroyUserRequest;
use App\Actions\Api\User\CreateUserAction;
use App\Actions\Api\User\UpdateUserAction;
use App\Actions\Api\User\ShowUserAction;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct(
        private readonly GetUserListAction $getUserListAction,
        private readonly CreateUserAction $createUserAction,
        private readonly ShowUserAction $showUserAction,
        private readonly UpdateUserAction $updateUserAction
    )
    {
       
    }

    protected $model = User::class;
    /**
     * Display a listing of the resource.
     */
    public function index(ListUsersRequest $request)
    {
        return  $this->getUserListAction->run();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(CreateUserRequest $request)
    {
      
        return $this->createUserAction->run($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, ShowUserRequest $request)
    {
        return $this->showUserAction->run($user->id, $request->query('include', ''));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id, UpdateUserAction $action)
    {
        return $this->updateUserAction->run($request->validated(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user , DestroyUserRequest $request)
    {

        try {   
            //we proceed to delete the user 
            if ($user->delete()) {
                return response('', 204);
            }
            return response()->json(['success' => false, 'message' => 'User could not be deleted'], 500);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
