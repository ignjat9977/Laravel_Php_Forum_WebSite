<?php

namespace App\Models;

class LikesModel
{
    public function getLikesPerComment($id){
        return \DB::table("likes")
            ->where("id_comment", $id)
            ->count();
    }

    public function insertLike($like){
        \DB::table("likes")
            ->insert($like);
    }
    public function deleteLike($id_comment, $id_user, $deleted_at){
        \DB::table("likes")
            ->where("id_comment", $id_comment)
            ->where("id_user", $id_user)
            ->update([
                "deleted_at"=>$deleted_at
            ]);
    }
    public function deleteLikePost($id_post, $id_user, $deleted_at){
        \DB::table("likes")
            ->where("id_post", $id_post)
            ->where("id_user", $id_user)
            ->update([
                "deleted_at"=>$deleted_at
            ]);
    }
    public function checkIfLiked($id_comment, $id_user){
        $q = \DB::table("likes")
            ->where("id_comment", $id_comment)
            ->where("id_user", $id_user)
            ->whereNull("deleted_at")
            ->count();

        return $q;
    }
    public function checkIfLikedPost($id_post, $id_user){
        $q = \DB::table("likes")
            ->where("id_post", $id_post)
            ->where("id_user", $id_user)
            ->whereNull("deleted_at")
            ->count();

        return $q;
    }
}
