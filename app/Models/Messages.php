<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;
    protected $table = "messages";
    public $primaryKey = "id";

    public function getAllMessages($skip=0, $search=''){
        $allMessages = Messages::where("email", "LIKE", "%$search%")->count();
        $perPage = 3;
        $skip = $skip * $perPage;
        $numOfPages = ceil($allMessages/$perPage);

        $query = Messages::where("email", "LIKE", "%$search%")
            ->orderByDesc("created_at")
            ->skip($skip)
            ->take($perPage)
            ->get();

        $all = new \stdClass();
        $all->messages = $query;
        $all->numOfPages = $numOfPages;

        return $all;
    }
}
