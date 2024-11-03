<?php

namespace App\Libraries;

class HashLibrary
{
    public static function hash($plain_password): string
    {
        return password_hash($plain_password, PASSWORD_DEFAULT);
    }

    public static function verify($plain_password, $hashed_password): bool
    {
        return password_verify($plain_password, $hashed_password);
    }
}
