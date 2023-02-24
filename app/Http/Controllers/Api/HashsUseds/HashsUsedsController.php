<?php

namespace App\Http\Controllers\Api\HashsUseds;

use App\Enums\HashsUsedsEnum;
use App\Http\Controllers\Controller;
use App\Models\HashsUseds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HashsUsedsController extends Controller
{
    /**
     * storeActiveAccount
     *
     * @param  int $idUser
     * @param  string $code
     * @return bool
     */
    public static function storeActiveAccount(int $idUser, string $code): bool
    {
        DB::beginTransaction();

        try {
            HashsUseds::create([
                'user_id' => $idUser,
                'hash' => $code,
                'type' => HashsUsedsEnum::ActiveAccount
            ]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
    public static function storeResendActiveAccount(int $idUser, string $code): bool
    {
        DB::beginTransaction();

        $usersHashs = HashsUseds::where('user_id', $idUser)->select('id')->get();
        dd($usersHashs);
        
        try {
            HashsUseds::create([
                'user_id' => $idUser,
                'hash' => $code,
                'type' => HashsUsedsEnum::ResendActiveAccount
            ]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
