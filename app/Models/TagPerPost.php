<?php

namespace App\Models;

class TagPerPost
{
    public function getTagsOfPost($id){
        $queryTag = \DB::table("tags")
            ->join("post_tags", "tags.id_tag", "=","post_tags.id_tag")
            ->where("post_tags.id_post", $id)
            ->get();

        return $queryTag;
    }
    public function getAllTags(){
        $queryTag = \DB::table("tags")->get();
        return $queryTag;
    }
    public function insertPostTag($ids, $id){
        foreach ($ids as $i){
            if(!\DB::table("post_tags")->insert([
                "id_post" => $id,
                "id_tag"=>$i
            ])){
                return false;
            };
        }
        return true;
    }
    public function deletePostTag($id){

        \DB::table("post_tags")
            ->where("id_post", $id)
            ->delete();

    }
}
