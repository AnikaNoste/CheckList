<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class UserIsAdminMiddleware
{
    public function handle($request, Closure $next)
    {
		$role = DB::table('users')->where('id', '=', $request->id)->value('role');
		if($role != 1 && $role != 2){
			return $next($request);
		}
		else{
			$_SESSION['error'] = 'Невозможно заблокировать/разблокировать администратора';
			return redirect()->route('adminList');
		}
    }
}
