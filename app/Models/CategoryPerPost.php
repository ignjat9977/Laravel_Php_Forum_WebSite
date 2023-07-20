<?php

namespace App\Models;

class CategoryPerPost
{
    public function getCategoriesOfPost($id){
        $queryCat = \DB::table("categories")
            ->join("post_categories", "categories.id_category", "=","post_categories.id_category")
            ->where("post_categories.id_post", $id)
            ->get();
        return $queryCat;
    }
    public function getAllCategoires(){
        $queryCat = \DB::table("categories")->get();
        return $queryCat;
    }
    public function insertPostCategory($ids, $id){

        foreach ($ids as $i){
             if(!\DB::table("post_categories")->insert([
               "id_post" => $id,
               "id_category"=>$i
            ])){
                 return false;
             };
        }
        return true;
    }
    public function deletePostCategory($id){

        \DB::table("post_categories")
            ->where("id_post", $id)
            ->delete();

    }
}
