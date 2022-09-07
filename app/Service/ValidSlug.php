<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;

class ValidSlug
{

	public static function slug(string $table, string $slug) : string
	{
		$count = DB::table($table)->where('slug', 'like', "%$slug%")->count();

        if($count > 0){
            $count = $count + 1;
            $slug = "$slug-$count";
        }

        return $slug;
	}
}
