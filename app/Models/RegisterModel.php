<?php

namespace App\Models;
use Illuminate\Http\Request;
class RegisterModel
{
    public function insert($user){
        \DB::table("blog_users")->insert($user);
    }

    public function insertContactMessage($message){
        \DB::table("messages")->insert($message);
    }
}
