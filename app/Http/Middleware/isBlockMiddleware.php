<?php

namespace App\Http\Middleware;
use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class isBlockMiddleware
{
    public function handle($request, Closure $next)
    {
		
		if(Auth::user()->block == 1)
			return $next($request);
		else
		{
			$_SESSION['error'] = 'Сожалеем, вы заблокированы';
			return redirect()->route('error');
		}
    }
}
