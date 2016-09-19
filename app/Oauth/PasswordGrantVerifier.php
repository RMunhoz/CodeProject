<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 16/09/16
 * Time: 11:45
 */

namespace CodeProject\Oauth;

use Illuminate\Support\Facades\Auth;

class PasswordGrantVerifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'     =>  $username,
            'password'  =>  $password,
        ];

        if (Auth::once($credentials)){
            return Auth::user()->id;
        }
        return false;
    }
}