<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
{
   $credentials =$request->validate([
    'email' => 'required|email'
    'password' => 'required',
   ]);
   if (auth::attempt($credentials)) {
    return 'Login Berhasil'
   }

   return 'Password Atau Email Tidak Valid'
}
}
