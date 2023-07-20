<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $primaryKey = "id_category";
    protected $fillable = ['title'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, "post_categories", "id_category", "id_post");
    }

    public function showAllCategories(){
        return Category::all();
    }
    public function insertCategory($category){
        $cat = new Category();
        $cat->title = $category["title"];
        $cat->content = $category["content"];
        $cat->created_at = $category["created_at"];

        $cat->save();
    }
    public function editCategory($category){
        $cat = Category::where("id_category", "=", (int)$category["id"])->first();
        $cat->title = $category["title"];
        $cat->content = $category["content"];
        $cat->save();
    }
    public function destroyCat($id){
        $x = Category::find($id);
        $x->delete();
    }


}
