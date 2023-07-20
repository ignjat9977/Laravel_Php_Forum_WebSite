<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = "posts";
    protected $primaryKey = "id_post";

    public function blogUser()
    {
        return $this->hasOne(BlogUser::class, "id_user", "id_user");
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, "post_categories", "id_post", "id_category");
    }
    public function getAllPosts($request = null){
        $perPage = 6;
        $page = 1;
        $search = '';
        if($request !== null){
            $search = $request->get("search");
        }
        $numOfPages = ceil(Post::where("mega_title", "LIKE", "%".$search."%")->count() / $perPage);


        if($request !== null && $request->has("page")){
            $page = $request->get("page");
            if(!is_numeric($page) || $page <= 0 || $page > $numOfPages){
                $page = 1;
            }
        }
        $skip = $perPage * ($page - 1);
        $items = Post::where("mega_title", "LIKE", "%".$search."%")
            ->skip($skip)
            ->take($perPage)
            ->get();
        if($request !== null && $request->has("categoryIds")) {
            $ids = $request->get("categoryIds");
            $numOfPages = ceil(Post::whereHas("categories", function ($c) use($ids){
                $c->whereIn("categories.id_category", $ids);
            })->count() / $perPage);

            $items = Post::whereHas("categories", function ($c) use($ids){
                $c->whereIn("categories.id_category", $ids);
            })
                ->where("mega_title", "LIKE", "%".$search."%")
                ->skip($skip)
                ->take($perPage)
                ->get();

        }



        $info = new \stdClass();
        $info->items = $items;
        $info->numOfPages = $numOfPages;

        return $info;
    }
    public function destryPost($id){
        $x = Post::find($id);
        $x->delete();
    }


}
