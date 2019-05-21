<?php

namespace App\Http\Middleware;
//session_start();
use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class AdminIsNotEmptyDateMiddleware
{
    public function handle($request, Closure $next)
    {
		$data = DB::table('checkList')->get();
		if(!$data->isEmpty())
			return $next($request);
		else
		{
			$_SESSION['error'] = 'В системе нет ни одного чек-листа';
			return redirect()->route('error');
		}
    }
}
