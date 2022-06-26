<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest as StoreUserRequest;
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
        // TODO continua daqui -> tentar trazer o tipo de usuário junto com o usuáio
        $user = User::with(['typeUser'])->get();

        if(empty($user)) return ReturnMessage::message(false, 'There no users in Database', null, null, [], 204);

        return ReturnMessage::message(false,'Users found', null, null, $user, 200);
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
