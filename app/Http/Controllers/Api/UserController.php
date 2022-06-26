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
        $user = User::all();

        if(empty($user)) return ReturnMessage::message(false, 'There no users in Database', null, null, [], 204);

        return ReturnMessage::message(false,'Users found', null, null, $user, 200);
    }
    /**
     * store
     *
     * @param  StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
       dd($request->all());

        return ReturnMessage::message(false,'Users found', null, null, [], 200);
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

        if(empty($user)) return ReturnMessage::message(false, 'User not found in Database', null, null, [], 204);

        return ReturnMessage::message(false,'User found', null, null, $user, 200);
    }
}
