<?php

namespace App\Models;

class UserModel
{
    public function getUserInfo($id){
        return \DB::table("blog_users")
            ->where("id_user", $id)
            ->get();
    }
    public function updateUserProfileImg($img, $idUser){
        \DB::table("blog_users")
            ->where("id_user", $idUser)
            ->update([
                "picture_href" => $img,
                "updated_at" =>date("Y-m-d H:i:s")
            ]);
    }
    public function changePassword($password, $idUser){
        \DB::table("blog_users")
            ->where("id_user", $idUser)
            ->update([
                "password"=> $password,
                "updated_at"=>date("Y-m-d H:i:s")
            ]);
    }
}
