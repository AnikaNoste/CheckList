<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class limitCountListMiddleware
{
    public function handle($request, Closure $next)
    {	
		$numberlList = Auth::user()->numberlList;
		$count = DB::table('checkList')->where('userId', '=', Auth::user()->id)->count();
		
		if($count<$numberlList){
			return $next($request);
		}
		else{
			$_SESSION['error'] = 'Невозможно добавить. Количество возможных чек-листов = '.$numberlList;
			return redirect()->route('userAllLists');
		}
	}
}
