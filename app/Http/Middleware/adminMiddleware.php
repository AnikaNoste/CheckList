<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
		if(Auth::user()->role == 1){
			return $next($request);
		} 
		else{
			$_SESSION['error'] = 'Сожалеем, у Вас нет необходимых прав для выполнения действия';
			return redirect()->route('error');
		}
    }
}
