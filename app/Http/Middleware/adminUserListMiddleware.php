<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class adminUserListMiddleware
{
    public function handle($request, Closure $next)
    {
		$list = DB::table('checkList')->where('userId', '=', $request->id)->get();
		if(!$list->isEmpty()){
			return $next($request);
		}
		else{
			$_SESSION['error'] = 'У пользователя с id '.$request->id.' нет ни одного чек-листа';
			return redirect()->route('adminList');
		}
    }
}
