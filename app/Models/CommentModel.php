<?php

namespace App\Models;

class CommentModel
{
    public function getComments($id, $id_parent=0){
        $comments = \DB::table("comments")
            ->join("blog_users", "comments.id_user","=","blog_users.id_user")
            ->where("comments.id_post", $id)
            ->where("comments.id_parent", $id_parent)
            ->whereNull("comments.deleted_at")
            ->get();


        foreach ($comments as $c){
            $c->likes = \DB::table("likes")
                ->where("id_comment", $c->id_comment)
                ->whereNull("deleted_at")
                ->count();
            $c->children = $this->getComments($id, $c->id_comment);

        }

        return $comments;

    }
    public function insertComment($comment){
        \DB::table("comments")->insert($comment);
    }
    public function getLastComment(){

        $id = \DB::table("comments")->max("id_comment");
        return \DB::table("comments")
            ->join("blog_users", "comments.id_user","=","blog_users.id_user")
            ->where("comments.id_comment", $id)
            ->get();
    }
    public function destroyComment($id){
        \DB::table("comments")
            ->where("id_comment", $id)
            ->update([
                "deleted_at"=>date("Y-m-d h:i:s")
            ]);
    }
}
