<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class AdminIsNotEmptyListMiddleware
{
    public function handle($request, Closure $next)
    {
		$data = DB::table('items')->where('listId', '=', $request->id)->get();
		if(!$data->isEmpty())
			return $next($request);
		else{
			$_SESSION['error'] = 'Чек-лист с id '.$request->id.' не содержит пунктов';
			return redirect()->route('adminList');
		}
    }
}
