<?php

namespace App\Http\Controllers;
use App\Models\LikesModel;
use Illuminate\Http\Request;

class LikesController
{
    public $modelLikes;
    public function __construct()
    {
        $this->modelLikes = new LikesModel();
    }

    public function commentsNumOfLikes($id){

        return $this->modelLikes->getLikesPerComment($id);
    }
    public function store(Request $request){
        $likesInfo = $request->all();
        $likesInfo["id_user"] = session()->get("user")->id_user;
        $likesInfo["created_at"] = date("Y-m-d H:i:s");
        try{
            if($this->modelLikes->checkIfLiked($likesInfo["id_comment"], $likesInfo["id_user"]) > 0){
                $this->modelLikes->deleteLike($likesInfo["id_comment"], $likesInfo["id_user"], $likesInfo["created_at"]);
                return response()->json("down", 200);
            }else{
                $this->modelLikes->insertLike($likesInfo);
                return response()->json("up", 200);
            }
        }catch(\Exception $ex){
            \Log::error($ex->getMessage());
            return response()->json("error", 500);
        }

    }
    public function storePost(Request $request){
        $likesInfo = $request->all();
        $likesInfo["id_user"] = session()->get("user")->id_user;
        $likesInfo["created_at"] = date("Y-m-d H:i:s");
        try{
            if($this->modelLikes->checkIfLikedPost($likesInfo["id_post"], $likesInfo["id_user"]) > 0){
                $this->modelLikes->deleteLikePost($likesInfo["id_post"], $likesInfo["id_user"], $likesInfo["created_at"]);
                return response()->json("down", 200);
            }else{
                $this->modelLikes->insertLike($likesInfo);
                return response()->json("up", 200);
            }
        }catch(\Exception $ex){
            \Log::error($ex->getMessage());
            return response()->json("error", 500);
        }
    }
}
