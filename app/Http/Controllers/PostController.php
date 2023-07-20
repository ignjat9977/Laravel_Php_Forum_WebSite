<?php

namespace App\Http\Controllers;

use App\Models\CategoryPerPost;
use App\Models\PostSearch;
use App\Models\TagPerPost;
use Illuminate\Http\Request;

class PostController extends BasicController
{
    private $modelPost;
    private $modelTag;
    private $modelCategory;

    public function index($id){
        $this->modelPost = new PostSearch();
        $this->modelCategory = new CategoryPerPost();
        $this->modelTag = new TagPerPost();

        $this->data["post"] = $this->modelPost->onePost($id);
        $this->data["tags"] = $this->modelTag->getTagsOfPost($id);
        $this->data["categories"] = $this->modelCategory->getCategoriesOfPost($id);

        return view("frontend.pages.onePost", $this->data);
    }
}
