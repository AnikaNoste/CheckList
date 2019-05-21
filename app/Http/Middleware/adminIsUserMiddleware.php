<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class adminIsUserMiddleware
{
    public function handle($request, Closure $next)
    {
		$user = DB::table('users')->where('id', '=', $request->id)->get();
		if(!$user->isEmpty()){
			return $next($request);
		}
		else{
			$_SESSION['error'] = 'Пользователя с id '.$request->id.' не существует';
			return redirect()->route('adminList');
		}
    }
}
