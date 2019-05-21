<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UserController extends Controller
{
    public function blockUser($userId) {
		DB::update("UPDATE `users` SET `block` = ? WHERE ID = ?", [0, $userId]);
		$_SESSION['message'] = 'Пользователь с id '.$userId.' заблокирован';
		return redirect()->route('adminList');
	}
	
    public function unblockUser($userId) {
		DB::update("UPDATE `users` SET `block` = ? WHERE ID = ?", [1, $userId]);
		$_SESSION['message'] = 'Пользователь с id '.$userId.' разблокирован';
		return redirect()->route('adminList');
	}
	
    public function setNumberList($userId, $numberList) {
		DB::update("UPDATE `users` SET `numberlList` = ? WHERE ID = ?", [$numberList, $userId]);
		$_SESSION['message'] = 'Теперь пользователь с id '.$userId.' может иметь '.$numberList.' чек-листов';
		return redirect()->route('adminList');
	}
}
