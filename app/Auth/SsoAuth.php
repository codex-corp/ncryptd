<?php

namespace App\Auth;

use Illuminate\Support\Facades\Auth;
use App\User;

class SsoAuth
{
    public function check()
    {
        return Auth::check();
    }

    public function getUser()
    {
        return Auth::user();
    }

    public function authenticate(array $credentials, $remember = false)
    {
        return Auth::attempt($credentials, $remember);
    }

    public function logout()
    {
        Auth::logout();
    }

    public function isSuperUser()
    {
        $user = Auth::user();
        return $user && method_exists($user, 'isSuperUser') ? $user->isSuperUser() : false;
    }

    public function findUserByLogin($login)
    {
        return User::where('email', $login)->first();
    }

    public function register(array $data)
    {
        return User::create($data);
    }

    public function findAllUsers()
    {
        return User::all();
    }
}
