<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
	public function login($email, $password)
    {
		if(Auth::attempt([
			'email'=>$email,
			'password'=>$password,
			]))
			{
				return redirect()->route('userAllLists');
			}
		else{
			$_SESSION['error'] = 'Логин или пароль неверный';
			return redirect()->route('error');
		}
    }
}
