<?php

namespace App\Http\Controllers;

use App\Models\PostSearch;
use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileImgRequest;
use App\Http\Requests\PasswordRequest;

class AccountController extends BasicController
{
    private $modelUser;
    private $modelPost;

    public function __construct()
    {
        parent::__construct();
        $this->modelUser = new UserModel();
        $this->modelPost = new PostSearch();
    }

    public function index(){


        $this->data["user"] = $this->modelUser->getUserInfo(session()->get("user")->id_user);
        $this->data["posts"] = $this->modelPost->userPost(session()->get("user")->id_user);

        return view("frontend.pages.account", $this->data);
    }
    public function changeProfileImg(ProfileImgRequest $request){

        $postInfo = $request->all();
        unset($postInfo["_token"]);
        $image = $request->file("picture_href");
        try{
            $idPic = uniqid()."_".time().".".$image->extension();
            $image->storeAs("public/posts", $idPic);
            $postInfo["picture_href"]=$idPic;
            $this->modelUser->updateUserProfileImg($postInfo["picture_href"], $postInfo["id_user"]);
            return redirect()->back()->with("success" ,"You successfully changed picture!");
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return redirect()->back()->with("error" ,"Something got wrong please try again later!");
        }

    }
    public function changeAccountPassword(PasswordRequest $request){
        try{
            $password = $request->input("password");
            $user_id = $request->input("id_user");

            $password = md5($password);
            $this->modelUser->changePassword($password, $user_id);
            return redirect()->back()->with("success" ,"You successfully updated password");

        }catch (\Exception $e){
            \Log::error($e->getMessage());
            return redirect()->back()->with("error" ,"Something got wrong with your password please try again later!");
        }
    }
}
