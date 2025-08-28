<?php

namespace App\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\AuthenticationException;
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
        if (!Auth::attempt($credentials, $remember)) {
            throw new AuthenticationException('Invalid credentials');
        }

        return Auth::user();
    }

    public function login(User $user, $remember = false)
    {
        Auth::login($user, $remember);

        return $user;
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
        $data['password'] = Hash::make($data['password']);
        $data['is_superuser'] = $data['is_superuser'] ?? false;

        return User::create($data);
    }

    public function findAllUsers()
    {
        return User::all();
    }
}
