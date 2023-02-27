<?php

namespace App\Http\Controllers\Api\SearchSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchSettingsController extends Controller
{
    public function store() : JsonResponse
    {
        try {
            DB::beginTransaction();

        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
