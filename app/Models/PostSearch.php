<?php

namespace App\Models;
use Illuminate\Http\Request;
class PostSearch
{
    public function get(Request $request){
        $query = \DB::table("posts");

        $query = $query->join("blog_users", "posts.id_user", "=", "blog_users.id_user");
        $query = $query->whereNull("posts.deleted_at");
        if($request->has("id_category")){

            $q = \DB::table("categories");
            $q = $q->join("post_categories", "categories.id_category", "=", "post_categories.id_category");
            $q = $q->whereIn("post_categories.id_category",$request->get("id_category"));
            $q = $q->select("id_post");
            $q = $q->get();
            $postIds = [];
            foreach($q as $x){
                $postIds[] = $x->id_post;
            }
            $query = $query->whereIn("id_post",$postIds);
        }
        if($request->has("keyword")){
            $query = $query->where("mega_title", "Like","%".$request->get("keyword")."%")
                ->where("title", "Like", "%".$request->get("keyword")."%");
        }
        $query = $query->select("mega_title", "title", "content", "posts.created_at as createdDateTime",
            "first_name", "last_name", "blog_users.picture_href as userImg", "posts.picture_href as postImg", "posts.id_post as postId");




        $orderBy = $this->checkOrderByParam($request);
        $query = $query->orderBy($orderBy[0], $orderBy[1]);



        $perPage = $this->checkPerPageParam($request);
        $page = $request->has("page") ? $request->get("page") : 1;

        $totalCount = $query->count();

        $query = $query->take($perPage);

        $offset = ((int)$page - 1) * (int)$perPage;
        $query = $query->skip($offset);

        $pageResponse = new \stdClass();
        $pageResponse->items = $query->get();
        $pageResponse->pageCount = ceil($totalCount/$perPage);
        $pageResponse->totalCount = $totalCount;

        return $pageResponse;



    }
    private function checkPerPageParam($request){
        $perPage = $request->get("perPage");
        if(is_numeric($perPage) && $perPage>0 && $perPage<20){
            return $perPage;
        }
        return 4;
    }
    private function checkOrderByParam($request){
        $orderBy = [
            "1"=> ["mega_title", "ASC"],
            "2"=> ["mega_title", "DESC"],
            "3"=> ["posts.created_at", "ASC"],
            "4"=> ["posts.created_at", "DESC"]
        ];
        $defaultSort = $orderBy["1"];

        if($request->has("sortBy") && is_numeric($request->get("sortBy"))){
            if(isset($orderBy[$request->get("sortBy")])){
                $order = $orderBy[$request->get("sortBy")];
                if($order){
                    $defaultSort = $order;
                }
            }
        }
        return $defaultSort;
    }
    public function getCategoies(){

        return \DB::select("select * from categories");
    }
    public function newestPosts(){
        $query = \DB::table("posts")
            ->join("blog_users", "posts.id_user", "=", "blog_users.id_user")
            ->whereNull("posts.deleted_at")
            ->select("mega_title", "title", "content", "posts.created_at as createdDateTime", "first_name",
                "last_name", "blog_users.picture_href as userImg", "posts.picture_href as postImg", "posts.id_post as postId")
            ->orderByDesc("posts.created_at")
            ->take(2);

        return $query->get();
    }
    public function onePost($id){
        $query = \DB::table("posts")
            ->join("blog_users", "posts.id_user", "=", "blog_users.id_user")
            ->where("posts.id_post", $id)
            ->select("mega_title", "title", "content", "posts.created_at as createdDateTime", "first_name",
                "last_name", "blog_users.picture_href as userImg", "posts.picture_href as postImg", "posts.id_post as postId")
            ->get();

        foreach ($query as $p){
            $p->likes = \DB::table("likes")
                ->where("id_post", $id)
                ->whereNull("deleted_at")
                ->count();
        }
        return $query;
    }
    public function userPost($id){
        $query = \DB::table("posts")
            ->join("blog_users", "posts.id_user", "=", "blog_users.id_user")
            ->whereNull("posts.deleted_at")
            ->where("posts.id_user", $id)
            ->select("mega_title", "title", "content", "posts.created_at as createdDateTime",
                "posts.picture_href as postImg", "posts.id_post as postId")
            ->get();

        return $query;
    }
    public function insertPost($post){
        \DB::table("posts")->insert($post);
    }
    public function lastPost(){
        return \DB::table("posts")->max("id_post");
    }
    public function softDeletePost($id){
        \DB::table("posts")
            ->where("id_post",$id)
            ->update([
            "deleted_at"=>date("Y-m-d H:i:s")
            ]);

    }
    public function updatePost($id, $post){
        \DB::table("posts")
            ->where("id_post", $id)
            ->update($post);
    }
}
