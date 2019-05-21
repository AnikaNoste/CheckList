<?php
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;


class CheckListController extends Controller
{ 
	
	public function getArray($checkLists, $title){
		$dataList = ['title'=>$title];
		foreach($checkLists as $list){
			$dataList['id'][] = $list->id;
			$dataList['titleList'][] = $list->titleList;
			$dataList['status'][] = $list->status;
			$dataList['created_at'][] = $list->created_at;
			$dataList['updated_at'][] = $list->updated_at;
		}
		return $dataList;
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
	
	public function isListOk($listId){
		$items = DB::table('items')->where('listId', '=', $listId)->where('status', '=', 0)->get();
		if($items->isEmpty()){
			DB::update("UPDATE `checkList` SET `status` = 1 WHERE `id` = ?", [$listId]);
		}
		else{
			DB::update("UPDATE `checkList` SET `status` = 0 WHERE `id` = ?", [$listId]);
		}
	}
	
    public function showAll(){
		$userId = Auth::user()->id;
		$checkLists = DB::table('checkList')->where('userId', '=', $userId)->get();
		$title = 'Просмотр всех чек листов';
		if(view()->exists('UserCheckList.all')){
			$dateList=$this->getArray($checkLists, $title);
			return view('UserCheckList.all', $dateList);
		}
		abort(404);
	}
	
	public function getListById($id){
		$userId = Auth::user()->id;
		$checkList = DB::table('checkList')->where('userId', '=', $userId)->where('id', '=', $id)->get();
		$title = "Просмотр чек листа с ID=$id";
		if(view()->exists('UserCheckList.list')){
			$dateList=$this->getArrayItems($checkList, $title);
			return view('UserCheckList.list', $dateList);
		}
		abort(404);
	}
   
    public function createList($titleList) {
		$userId = Auth::user()->id;
		DB::insert("INSERT INTO `checkList` (`userId`, `titleList`) VALUES (?, ?)", [$userId, $titleList]);
		return redirect()->route('userAllLists');
	}
	
    public function deleteList($id) {
		DB::delete("DELETE FROM `checkList` WHERE `id` = ?", [$id]);
		return redirect()->route('userAllLists');
	}
	
    public function deleteLists() {
		DB::delete("DELETE FROM `checkList` WHERE `status` = 1");
		return redirect()->route('userAllLists');
	}
	
	public function createItem($listId, $text) {
		$userId = Auth::user()->id;
		DB::insert("INSERT INTO `items` (`listId`, `text`) VALUES (?, ?)", [$listId, $text]);
		$this->isListOk($listId);
		$_SESSION['message'] = 'Пункт добавлен';
		return redirect()->route('userListById', $listId);
	}
	
    public function deleteItem($id) {
		$listId = DB::table('items')->where('id', '=', $id)->value('listId');
		DB::delete("DELETE FROM `items` WHERE `id` = ?", [$id]);
		$this->isListOk($listId);
		$_SESSION['message'] = 'Пункт с id '.$request->id.' удален';
		return redirect()->route('userListById', $listId);
	}
	
    public function OkItem($id) {
		$listId = DB::table('items')->where('id', '=', $id)->value('listId');
		DB::update("UPDATE `items` SET `status` = 1 WHERE `id` = ?", [$id]);
		$this->isListOk($listId);
		$_SESSION['message'] = 'Пункт с id '.$id.' сделан ';
		return redirect()->route('userListById', $listId);
	}
	
    public function NoItem($id) {
		$listId = DB::table('items')->where('id', '=', $id)->value('listId');
		DB::update("UPDATE `items` SET `status` = 0 WHERE `id` = ?", [$id]);
		$this->isListOk($listId);
		$_SESSION['message'] = 'Пункт с id '.$id.' не сделан ';
		return redirect()->route('userListById', $listId);
	} 
	
	
}
