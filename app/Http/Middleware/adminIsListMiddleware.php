<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class AdminIsListMiddleware
{
    public function handle($request, Closure $next)
    {
		$list = DB::table('checkList')->where('id', '=', $request->id)->get();
		if(!$list->isEmpty()){
			return $next($request);
		}
		else{
			$_SESSION['error'] = 'Чек-лист с id '.$request->id.' не существует';
			return redirect()->route('adminList');
		}
    }
}
