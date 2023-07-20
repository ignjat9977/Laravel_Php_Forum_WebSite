<?php

namespace App\Http\Controllers;

use App\Models\PostSearch;
use Illuminate\Http\Request;

class HomeController extends BasicController
{

    public function search(Request $request){

       $model = new PostSearch();

       $checkedCat = $request->get("id_category");
       $sortBy = $request->get("sortBy");
       $keyword = $request->get("keyword");
       $perPage = $request->get("perPage");

       $this->data["categories"] = $model->getCategoies();
       $this->data["posts"] = $model->get($request);
       $this->data["newestPosts"] = $model->newestPosts();
       $this->data["checkedCat"] = $checkedCat;
       $this->data["keyword"]= $keyword;
       $this->data["sortBy"]= $sortBy;
       $this->data["perPage"] = $perPage;

       return view("frontend.pages.index", $this->data);

    }
}
