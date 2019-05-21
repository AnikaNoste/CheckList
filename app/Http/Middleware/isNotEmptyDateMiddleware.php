<?php

namespace App\Http\Middleware;
use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class isNotEmptyDateMiddleware
{
    public function handle($request, Closure $next)
    {
		$data = DB::table('checkList')->where('userId', '=', Auth::user()->id)->get();
		if(!$data->isEmpty())
			return $next($request);
		else
		{
			$_SESSION['error'] = 'у вас нет ни одного чек-листа';
			return redirect()->route('error');
		}
    }
}
