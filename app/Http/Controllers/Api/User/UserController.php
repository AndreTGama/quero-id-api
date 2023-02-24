<?php

namespace App\Http\Controllers\Api\User;

use App\Builder\ReturnMessage;
use App\Enums\HashsUsedsEnum;
use App\Http\Controllers\Api\HashsUseds\HashsUsedsController;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\ResendCodeRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Mail\ActiveAccountMail;
use App\Models\HashsUseds;
use Illuminate\Support\Str;
use App\Models\User;
use App\Service\ValidSlug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {

            $id = auth()->user()->id;

            $user = User::find($id);

            if (empty($user)) return ReturnMessage::message(false, 'There no user in Database', null, null, [], 200);

            return ReturnMessage::message(false, 'Users found', null, null, $user, 200);
        } catch (\Exception $e) {
            return ReturnMessage::message(false, 'User not found', $e->getMessage(), $e, null, 401);
        }
    }
    // TODO verificar esse teste que foi gerado pelo refraction
    public function testIndex()
    {
        try {
            $id = auth()->user()->id;
            $user = User::find($id);

            // Assert user is not empty
            $this->assertNotEmpty($user);

            // Assert the returned message is 'Users found'
            $this->assertEquals(ReturnMessage::message(false, 'Users found', null, null, $user, 200), ReturnMessage::message(false, 'Users found', null, null, $user, 200));

        } catch(\Exception $e) {
            // Assert the exception message is 'User not found'
            $this->assertEquals(ReturnMessage::message(false, 'User not found', $e->getMessage(), $e, null, 401), ReturnMessage::message(false, 'User not found', $e->getMessage(), $e, null, 401));

        }
        }
    /**
     * list all users in database
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        try {
            $users = User::get();

            if (empty($users))
                throw new \Exception('There no users in Database');

            return ReturnMessage::message(false, 'Users found', null, null, $users, 200);
        } catch (\Exception $e) {
            return ReturnMessage::message(false, 'Users not found', $e->getMessage(), $e, null, 200);
        }
    }
    /**
     * Show user table information
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $user = User::find($id);

            if (!isset($user))
                throw new \Exception('User not found in Database');

            $user->type_user = $user->typeUser;

            if (empty($user))
                throw new \Exception('User not found in Database');

            return ReturnMessage::message(false, 'User found', null, null, $user, 200);
        } catch (\Exception $e) {
            return ReturnMessage::message(false, 'User not found', $e->getMessage(), $e, null, 200);
        }
    }
    /**
     * list all users in database
     *
     * @return JsonResponse
     */
    public function listDeleted(): JsonResponse
    {
        try {
            $users = User::onlyTrashed()->get();

            if ($users->isEmpty())
                throw new \Exception('There no users in Database');

            return ReturnMessage::message(false, 'Users deleted found', null, null, $users, 200);
        } catch (\Exception $e) {
            return ReturnMessage::message(false, 'User not found', $e->getMessage(), $e, null, 200);
        }
    }
    /**
     * store
     *
     * @param  StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            $data['slug'] = ValidSlug::slug('users', Str::slug($data['name']));

            $user = User::create($data);
            if (empty($user->id)) throw new \Exception('Error creating user');

            $code = uniqid();
            $hashSuccess = HashsUsedsController::storeActiveAccount($user->id, $code);

            if (!$hashSuccess) throw new \Exception('Error generating activation code');

            // TODO I'm using Gmail to send it, but it's having a problem with authentication, I'll have to validate it later with another email sending system
            // Mail::send(new \App\Mail\ActiveAccountMail($data['email'], $data['name'], $code));

            DB::commit();
            return ReturnMessage::message(false, 'User created successfully', null, null, null, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return ReturnMessage::message(true, 'Error creating user', $e->getMessage(), null, [], 409);
        }
    }
    /**
     * Update
     *
     * @param  UpdateUserRequest $request
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        try {
            $data = $request->all();

            if (!empty($data['name'])) $data['slug'] = $this->countUpdateSlug(Str::slug($data['name']), $id);

            if (empty($data['profile_picture'])) $data['profile_picture'] = "profile_picture_default.png";

            $user = User::find($id)->update($data);

            if (!$user)
                throw new \Exception('Error updating user');

            return ReturnMessage::message(false, 'User successfully updated', null, null, null, 201);
        } catch (\Exception $e) {
            return ReturnMessage::message(false, 'Error updating user', $e->getMessage(), $e, null, 200);
        }
    }
    /**
     * delete
     *
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $user = User::withTrashed()->find($id)->delete();

            if (!$user) throw new \Exception('Error delete user');

            return ReturnMessage::message(false, 'User deleted successfully', null, null, null, 201);
        } catch (\Exception $e) {
            return ReturnMessage::message(false, 'Error delete user', $e->getMessage(), $e, null, 200);
        }
    }
    /**
     * restore
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        try {
            $user = User::withTrashed()->find($id)->restore();

            if (!$user) return ReturnMessage::message(true, 'Error restore user', null, null, [], 409);

            return ReturnMessage::message(false, 'User restored with success', null, null, null, 200);
        } catch (\Exception $e) {
            return ReturnMessage::message(false, 'Error restore user', $e->getMessage(), $e, null, 200);
        }
    }
    /**
     * restoreAll
     *
     * @return JsonResponse
     */
    public function restoreAll(): JsonResponse
    {
        try {
            User::onlyTrashed()->restore();

            return ReturnMessage::message(false, 'Users restored with success', null, null, null, 200);
        } catch (\Exception $e) {
            return ReturnMessage::message(false, 'Error restore user', $e->getMessage(), $e, null, 200);
        }
    }
    /**
     * countUpdateSlug
     *
     * @param  string $slug
     * @param  int $id
     * @return string
     */
    public function countUpdateSlug(string $slug, int $id): string
    {
        $user = User::find($id);

        if ($user->slug == $slug) return $slug;

        $count = User::where('slug', $slug)->count();

        if ($count > 0) $slug = $slug . "$count";

        return $slug;
    }
    /**
     * activeAccount
     *
     * @param  string $code
     * @return JsonResponse
     */
    public function activeAccount(string $code): JsonResponse
    {
        try {
            DB::beginTransaction();

            $hashsUseds = HashsUseds::where('hash', $code)->first();

            if (empty($hashsUseds))
                throw new \Exception("User with code:$code not found in system");

            $user = $hashsUseds->user;

            if ($user->email_verified_at || $hashsUseds->used)
                throw new \Exception("User with code:$code is already active");

            $user->update(['email_verified_at' => date('Y-m-d h:i:s')]);

            $hashsUseds->update(['used' => true]);
            $hashsUseds->delete();

            DB::commit();
            return ReturnMessage::message(false, 'Activated user', 'Activated user', null, null, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return ReturnMessage::message(false, 'Code not found or Used', $e->getMessage(), $e, null, 401);
        }
    }
    public function resendCode(ResendCodeRequest $request) : JsonResponse
    {
        dd( $request);
        $code = uniqid();

        // HashsUsedsController::storeActiveAccount($user->id, $code);
        dd();
    }
}
