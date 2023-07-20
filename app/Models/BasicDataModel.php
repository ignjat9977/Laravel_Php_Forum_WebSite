<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class BasicDataModel
{
    public function nav(){
        return DB::table("navigation")->get();
    }

    public function social(){
        return DB::table("social")->get();
    }

    public function navAdmin(){
        return DB::table("navigation_admin")->get();
    }

}
