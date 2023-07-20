<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    private $modelComment;

    public function store(CommentRequest $request){
        unset($request["_token"]);

        $this->modelComment = new CommentModel();
        $comment = $request->all();
        $comment["created_at"] = date("Y-m-d H:i:s");
        try{
            $this->modelComment->insertComment($comment);
            $comment = $this->modelComment->getLastComment();
            $comment->id_user = session()->get("user")->id_user;
            return response()->json($comment, 200);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            return response()->json("something gone wrong please try again later", 500);
        }


    }
    public function destroy(Request $request){
        try{
            $this->modelComment =new CommentModel();
            $this->modelComment->destroyComment($request->get("id"));
            return response()->json("success", 200);

        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json("error", 500);
        }
    }
}
