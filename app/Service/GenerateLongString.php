<?php

namespace App\Service;

class GenerateLongString
{
	/**
	 * generateRandomString
	 *
	 * @param  int $length
	 * @return string
	 */
	public static function generateRandomString(int $length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    /**
     * generateRandomEmail
     *
     * @param  int $length
     * @return string
     */
    public static function generateRandomEmail(int $length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return "$randomString@email.com";
    }
}
