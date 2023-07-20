<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagInsertRequest;
use App\Http\Requests\TagsCategoryRequest;
use App\Models\BlogUser;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminTagsController extends BasicAdminController
{

    private $userModel;
    private $tagsModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new BlogUser();
        $this->tagsModel = new Tag();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->data["userInfo"] = json_decode($this->userModel->getUserInfo(session()->get("user")->id_user));
        $this->data["tags"] = json_decode($this->tagsModel->showAllTags());
        return view("frontend.pagesAdmin.tags", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagInsertRequest $request)
    {
        $tagsInfo = $request->all();

        unset($tagsInfo["_token"]);
        $tagsInfo["created_at"] = date("Y-m-d h:i:s");

        try{
            $this->tagsModel->insertTag($tagsInfo);
            return redirect()->back()->with("success", "Tag successfuly inserted!");
        }catch(\Exception $ex){
            \Log::error($ex->getMessage());
            return redirect()->back()->with("error", "Error with database try again later");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagsCategoryRequest $request)
    {
        try{
            $modelTag = new Tag();
            $modelTag->editTag($request->all());

            return response()->json("success");
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json("error", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modelTag = new Tag();
        try{
            $modelTag->destroyTag($id);

            return redirect()->back()->with("success", "You successfully deleted a category!");
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->with("error", "Something gone wrong please try again later!");
        }
    }
}
