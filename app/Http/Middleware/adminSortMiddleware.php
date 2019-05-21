<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Schema;
use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class adminSortMiddleware
{
    public function handle($request, Closure $next)
    {
		if(Schema::hasColumn('checkList', $request->field)){
			return $next($request);
		}
		else{
			$_SESSION['error'] = 'Столбец  '.$request->field.' в таблице не существует';
			return redirect()->route('adminList');
		} 
    }
}
