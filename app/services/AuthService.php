<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthService
{
    /**
     * Register User
     */
    public function register($data)
    {
        try {

            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            return $user ? true : false;

        } catch (\Throwable $th) {

            Log::error('Register Failed', [
                'message' => $th->getMessage(),
                'line'    => $th->getLine(),
            ]);

            return false;
        }
    }

    /**
     * Login User
     */
    public function login($data)
    {
        try {

            // cek login
            if (Auth::attempt([
                'email'    => $data['email'],
                'password' => $data['password']
            ])) {

                // ambil data user login
                $user = Auth::user();

                // simpan session
                Session::put('logged_in', true);
                Session::put('user_id', $user->id);
                Session::put('user_name', $user->name);
                Session::put('user_email', $user->email);

                return true;
            }

            return false;

        } catch (\Throwable $th) {

            Log::error('Auth service login failed', [
                'message' => $th->getMessage(),
                'line'    => $th->getLine(),
            ]);

            return false;
        }
    }

    /**
     * Logout User
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
    }
}