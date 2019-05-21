<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class isItemMiddleware
{
    public function handle($request, Closure $next)
    {
		$listId = DB::table('items')->where('id', '=', $request->id)->value('listId');
		if($listId!=null){
			$list = DB::table('checkList')->where('id', '=', $listId)->where('userId', '=', Auth::user()->id)->get();
			if(!$list->isEmpty()){
				return $next($request);
			}
			else{
				$_SESSION['error'] = 'Пункт с id '.$request->id.' не существует';
				return redirect()->route('userAllLists');
			}
		}
		else{
			$_SESSION['error'] = 'Пункта с id '.$request->id.' не существует';
			return redirect()->route('userAllLists');
		}
		
    }
}
