<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CheckListController extends Controller
{
	function getArray($checkLists, $title){
		$dateList = ['title'=>$title];
		foreach($checkLists as $list){
			$dateList['id'][] = $list->id;
			$dateList['userId'][] = $list->userId;
			$dateList['titleList'][] = $list->titleList;
			$dateList['status'][] = $list->status;
			$dateList['created_at'][] = $list->created_at;
			$dateList['updated_at'][] = $list->updated_at;
		}
		return $dateList;
	}
	
	public function getArrayItems($checkList, $title){
		$dataList = ['title'=>$title];
		foreach($checkList as $list){
			$dataList['titleList'] = $list->titleList;
			$dataList['listId'] = $list->id;
			$dataList['statusList'] = $list->status;
			$listId=$list->id;
		}
		$items = DB::table('items')->where('listId', '=', $listId)->get();
		foreach($items as $item){
			$dataList['id'][] = $item->id;
			$dataList['text'][] = $item->text;
			$dataList['statusItem'][] = $item->status;
		}
		return $dataList;
	}
	
	function showLists($checkLists, $title){
		if(view()->exists('adminCheckList.all')){
			$dateList=$this->getArray($checkLists, $title);
			return view('adminCheckList.all', $dateList);
		}
		abort(404);
	}
	
	function showList($checkList, $title){
		if(view()->exists('adminCheckList.list')){
			$dateList=$this->getArrayItems($checkList, $title);
			return view('adminCheckList.list', $dateList);
		}
		abort(404);
	}
	
    public function showAllSort($field){
		$title = "Просмотр всех чек листов c cортировкой по полю $field";
		$checkLists = DB::table('checkList')->orderBy($field)->get();
		return $this->showLists($checkLists, $title);
	}

	public function showAll(){ 
		$title = "Просмотр всех чек листов";
		$checkLists = DB::table('checkList')->get();
		return $this->showLists($checkLists, $title);
	}
	
	public function getListById($id){
		$title = "Просмотр чек листа с ID=$id";
		$checkList = DB::table('checkList')->where('id', '=', $id)->get();
		return $this->showList($checkList, $title);
	}
	
	public function getListsByUserId($userId){
		$title = "Просмотр чек листов где userID=$userId";
		$checkLists = DB::table('checkList')->where('userId', '=', $userId)->get();
		return $this->showLists($checkLists, $title);
	}
}
