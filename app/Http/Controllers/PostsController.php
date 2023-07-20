<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BasicController as BasicController;
use App\Http\Requests\CreatePostRequest;
use App\Models\CategoryPerPost;
use App\Models\CommentModel;
use App\Models\PostSearch;
use App\Models\TagPerPost;
use Illuminate\Http\Request;

class PostsController extends BasicController
{
    private $modelPost;
    private $modelTag;
    private $modelCategory;
    private $modelComment;


    public function __construct()
    {
        $this->modelPost = new PostSearch();
        $this->modelCategory = new CategoryPerPost();
        $this->modelTag = new TagPerPost();

        parent::__construct();

    }

    public function index(Request $request){

        $checkedCat = $request->get("id_category");
        $sortBy = $request->get("sortBy");
        $keyword = $request->get("keyword");
        $perPage = $request->get("perPage");

        $this->data["categories"] = $this->modelPost->getCategoies();
        $this->data["posts"] = $this->modelPost->get($request);
        $this->data["newestPosts"] = $this->modelPost->newestPosts();

        $this->data["checkedCat"] = $checkedCat;
        $this->data["keyword"]= $keyword;
        $this->data["sortBy"]= $sortBy;
        $this->data["perPage"] = $perPage;


        return view("frontend.pages.index", $this->data);
    }


    /**
     *
     */
    public function create()
    {
        $this->data["tags"]=$this->modelTag->getAllTags();
        $this->data["categories"]=$this->modelCategory->getAllCategoires();

        return view("frontend.pages.postCreate", $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CreatePostRequest $request)
    {
        $postInfo = $request->all();
        $image = $request->file("picture_href");
        if(isset($image)){
            try{
                $idPic = uniqid()."_".time().".".$image->extension();
                $image->storeAs("public/posts", $idPic);
                $postInfo["picture_href"]=$idPic;
            }catch(\Exception $e){
                \Log::error($e->getMessage());
            }

        }
        if(isset($postInfo["id_category"])){
            $id_cat = $postInfo["id_category"];
            unset($postInfo["id_category"]);

        }
        if(isset($postInfo["id_tag"])){
            $id_tag = $postInfo["id_tag"];
            unset($postInfo["id_tag"]);
        }

        $postInfo["created_at"]=date("Y-m-d H:i:s");
        $postInfo["id_user"] = session()->get("user")->id_user;
        $error = 0;
        \DB::beginTransaction();
        try {

            $this->modelPost->insertPost($postInfo);
            $getLastPostId = $this->modelPost->lastPost();

            isset($id_cat)?$this->modelCategory->insertPostCategory($id_cat, $getLastPostId)?"":$error++:"";
            isset($id_tag)?$this->modelTag->insertPostTag($id_tag, $getLastPostId)?"":$error++:"";
            \DB::commit();
            return redirect()->route("home");
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            session()->put("errorPosts","Error while entering data to database");
            \DB::rollBack();
            return redirect()->route("posts.create");
        }

    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        $this->modelComment = new CommentModel();
        $this->data["comments"] = $this->modelComment->getComments($id);
        $this->data["post"] = $this->modelPost->onePost($id);
        $this->data["tags"] = $this->modelTag->getTagsOfPost($id);
        $this->data["categories"] = $this->modelCategory->getCategoriesOfPost($id);

        return view("frontend.pages.onePost", $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data["post"] = $this->modelPost->onePost($id);

        $categories = [];
        $tags = [];

        foreach ($this->modelCategory->getCategoriesOfPost($id) as $c){
            $categories[] = $c->id_category;
        }
        foreach ($this->modelTag->getTagsOfPost($id) as $c){
            $tags[] = $c->id_tag;
        }

        $categories!=null?$categories:[];
        $tags!=null?$tags:[];

        $this->data["categoriesOfPost"] = $categories;
        $this->data["tagsOfPost"] = $tags;
        $this->data["categories"] = $this->modelCategory->getAllCategoires();
        $this->data["tags"] = $this->modelTag->getAllTags();

        return view("frontend.pages.editPost", $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, $id)
    {
        try{
            \DB::beginTransaction();
            $postInfo = $request->all();
            unset($postInfo['_token']);
            unset($postInfo["_method"]);
            $image = $request->file("picture_href");
            if(isset($image)){
                try{
                    $idPic = uniqid()."_".time().".".$image->extension();
                    $image->storeAs("public/posts", $idPic);
                    $postInfo["picture_href"]=$idPic;
                }catch(\Exception $e){
                    \Log::error($e->getMessage());
                }

            }
            if(isset($postInfo["id_category"])){
                $id_cat = $postInfo["id_category"];
                unset($postInfo["id_category"]);

            }
            if(isset($postInfo["id_tag"])){
                $id_tag = $postInfo["id_tag"];
                unset($postInfo["id_tag"]);
            }

            $postInfo["updated_at"]=date("Y-m-d H:i:s");
            $this->modelPost->updatePost($id, $postInfo);


            $getLastPostId = $this->modelPost->lastPost();


            $this->modelCategory->deletePostCategory($getLastPostId);
            $this->modelTag->deletePostTag($getLastPostId);
            isset($id_cat)?$this->modelCategory->insertPostCategory($id_cat, $getLastPostId):"";
            isset($id_tag)?$this->modelTag->insertPostTag($id_tag, $getLastPostId):"";


            \DB::commit();
            return redirect()->route("home");

        }catch(\Exception $e){
            \Log::error($e->getMessage());
            session()->put("errorPosts","Error while entering data to database");
            \DB::rollBack();
            return redirect()->route("posts.create");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy($id)
    {

        try{

            $this->modelPost->softDeletePost($id);
            return redirect()->route("account");

        }catch(\Exception $e){

            \Log::error($e->getMessage());
            return redirect()->route("error");
        }

    }
}
