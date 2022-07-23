<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * list all users in database
     *
     * @return JsonResponse
     */
    public function list() : JsonResponse
    {
        $users = User::get();

        if(empty($users)) return ReturnMessage::message(false, 'There no users in Database', null, null, [], 204);

        return ReturnMessage::message(false,'Users found', null, null, $users, 200);
    }
    /**
     * list all users in database
     *
     * @return JsonResponse
     */
    public function listDeleted() : JsonResponse
    {
        $users = User::onlyTrashed()->get();

        if($users->isEmpty()) return ReturnMessage::message(false, 'There no users in Database', null, null, [], 204);

        return ReturnMessage::message(false,'Users deleted found', null, null, $users, 200);
    }
    /**
     * store
     *
     * @param  StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request) : JsonResponse
    {
        $data = $request->all();

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        if(empty($user->id)) return ReturnMessage::message(true,'Error creating user', null, null, [], 409);

        return ReturnMessage::message(false,'User created successfully', null, null, null, 201);

    }
    /**
     * Update
     *
     * @param  UpdateUserRequest $request
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, int $id) : JsonResponse
    {
        $data = $request->all();

        $user = User::find($id)->update($data);

        if(!$user) return ReturnMessage::message(true,'Error updating user', null, null, [], 409);

        return ReturnMessage::message(false,'User successfully updated', null, null, null, 201);

    }
     /**
     * delete
     *
     * @return JsonResponse
     */
    public function delete(int $id) : JsonResponse
    {
        $user = User::withTrashed()->find($id)->delete();

        if(!$user) return ReturnMessage::message(true,'Error delete user', null, null, [], 409);

        return ReturnMessage::message(false,'User deleted successfully', null, null, null, 201);

    }
    /**
     * Show user table information
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        $user = User::find($id);

        $user->type_user = $user->typeUser;

        if(empty($user)) return ReturnMessage::message(false, 'User not found in Database', null, null, [], 204);

        return ReturnMessage::message(false,'User found', null, null, $user, 200);
    }
}
