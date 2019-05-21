<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function show(){
		if(view()->exists('home')){
			$_SESSION['message'] = 'Добро пожаловать в систему!';
			return view('home');
		}
		abort(404);
	}
}
