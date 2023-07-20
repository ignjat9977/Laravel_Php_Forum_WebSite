<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = "tags";
    protected $primaryKey = "id_tag";
    protected $fillable = array('title', 'content');

    public function showAllTags(){
        return Tag::all();
    }
    public function insertTag($tag){
        $t = new Tag();
        $t->title = $tag["title"];
        $t->content = $tag["content"];
        $t->created_at = $tag["created_at"];

        $t->save();
    }
    public function editTag($tagg){
        $tag = Tag::where("id_tag", "=", (int)$tagg["id"])->first();
        $tag->title = $tagg["title"];
        $tag->content = $tagg["content"];
        $tag->save();
    }
    public function destroyTag($id){
        $x = Tag::find($id);
        $x->delete();
    }

}
