<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogUser extends Model
{
    use HasFactory;
    protected $table="blog_users";
    protected $primaryKey="id_user";

    public function comment()
    {
        return $this->hasMany(Comment::class, "id_user", "id_user");
    }
    public function post(){
        return $this->hasMany(Post::class,"id_user", "id_user");
    }

    public function getUserInfo($id){
        return BlogUser::find($id);
    }
    public function getAllUsersInfo(){
        return BlogUser::all();
    }
    public function getAllUsers($skip = 0, $search=""){
        $allUsers = BlogUser::where("blog_users.first_name", "LIKE", "%$search%")->count();
        $perPage = 5;
        $numOfPages = ceil($allUsers/5);

        $skip = $skip * $perPage;

        $query = BlogUser::where("blog_users.first_name", "LIKE", "%$search%")
            ->skip($skip)
            ->take($perPage)
            ->get();

        $info = new \stdClass();

        foreach ($query as $q){
            $q->numOfPosts = $q->post->count();
            $q->numOfComments = $q->comment->count();
        }

        $info->users = $query;
        $info->numOfPages = $numOfPages;

        return $info;

    }
    public function deleteUser($id){
        BlogUser::destroy($id);
    }
}
