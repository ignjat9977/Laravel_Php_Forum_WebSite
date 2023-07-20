<?php

namespace App\Http\Controllers;

use App\Logging\ReadLogs;
use App\Models\BlogUser;
use App\Models\Category;
use App\Models\Messages;
use App\Models\Post;
use App\Models\PostSearch;
use App\Models\UserModel;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminController extends BasicAdminController
{
    private $userModel;
    private $messagesModel;
    private $logClass;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new BlogUser();
        $this->messagesModel = new Messages();
        $this->logClass = new ReadLogs();
    }

    public function index(){
        $this->data["messages"] = $this->messagesModel->getAllMessages();
        $this->data["userInfo"] = json_decode($this->userModel->getUserInfo(session()->get("user")->id_user));
        $this->data["allUsers"] = $this->userModel->getAllUsers();

        return view("frontend.pagesAdmin.dashboard", $this->data);
    }
    public function ajaxUser($offset, $search = ""){
        try{
            $allUsers = $this->userModel->getAllUsers($offset, $search);
            return response()->json($allUsers, 200);
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json("Something got wrong with database, please try again later!", 500);
        }
    }
    public function destroyUser(Request $request){
        $userInfo = $request->all();
        unset($userInfo["_token"]);

        $id = $userInfo["id_user"];
        try{
            $this->userModel->deleteUser($id);
            return redirect()->back()->with("success", "You successfuly deleted a user!");

        }catch(\Exception $ex){
            \Log::error($ex->getMessage());
            return redirect()->back()->with("error", "Something wrong in database please try again later!");
        }


    }
    public function ajaxMessages($offset, $search = ""){
        try{
            $allMessages = $this->messagesModel->getAllMessages($offset, $search);
            return response()->json($allMessages, 200);
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json("Something got wrong with database, please try again later!", 500);
        }
    }

    public function posts(Request $request){
        $modelCategory = new Category();
        $modelPost = new Post();
        if($request->has("page")){
            $posts = $modelPost->getAllPosts($request);
            return response()->json($posts);
        }

        $this->data["userInfo"] = json_decode($this->userModel->getUserInfo(session()->get("user")->id_user));
        $this->data["categories"] = $modelCategory->showAllCategories();
        $this->data["users"] = $this->userModel->getAllUsersInfo();
        $this->data["posts"] = $modelPost->getAllPosts();
        return view("frontend.pagesAdmin.postsAdmin", $this->data);
    }
    public function destroy($id){
        $modelPost = new Post();
        try{
            $modelPost->destryPost($id);
            return response()->json("success");
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json("error", 500);
        }
    }
    public function userActivity(Request $request){

        $this->data["userInfo"] = json_decode($this->userModel->getUserInfo(session()->get("user")->id_user));

        $arr = $this->paginate($this->logClass->readInfo($request->input("time")), 20);

        $arr->withPath("/userActivity");

        $this->data["activity"] = $arr;

        return view("frontend.pagesAdmin.userActivity", $this->data);
    }
    public function paginate($items, $perPage = 4, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items , $offset , $perPage);
        return new LengthAwarePaginator($itemstoshow ,$total ,$perPage,[
            'path' => Paginator::resolveCurrentPath()
        ]);
    }
}
