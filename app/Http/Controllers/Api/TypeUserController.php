<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeUser\StoreTypeUserRequest;
use Illuminate\Http\JsonResponse;
use App\Models\TypeUser;
use Illuminate\Http\Request;

class TypeUserController extends Controller
{
/**
     * list all types users in database
     *
     * @return JsonResponse
     */
    public function list() : JsonResponse
    {
        $typeUsers = TypeUser::get();

        if(empty($typeUsers)) return ReturnMessage::message(false, 'There no users in Database', null, null, [], 204);

        return ReturnMessage::message(false,'Users found', null, null, $typeUsers, 200);
    }
    /**
     * store type user
     *
     * @param  StoreTypeUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreTypeUserRequest $request) : JsonResponse
    {
        $data = $request->all();

        $typeUser = TypeUser::create($data);

        if(empty($typeUser->id)) return ReturnMessage::message(true,'Error creating type user', null, null, [], 409);

        return ReturnMessage::message(false,'Type User created successfully', null, null, null, 201);

    }
    /**
     * Show type user table information
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        $typeUser = TypeUser::find($id);

        if(empty($typeUser)) return ReturnMessage::message(false, 'Type user not found in Database', null, null, [], 204);

        return ReturnMessage::message(false,'Type user found', null, null, $typeUser, 200);
    }
}
