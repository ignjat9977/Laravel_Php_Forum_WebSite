<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryInsertRequest;
use App\Http\Requests\TagsCategoryRequest;
use App\Models\BlogUser;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminCategoriesController extends BasicAdminController
{

    private $userModel;
    private $categoriesModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new BlogUser();
        $this->categoriesModel = new Category();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->data["userInfo"] = json_decode($this->userModel->getUserInfo(session()->get("user")->id_user));
        $this->data["categories"] = json_decode($this->categoriesModel->showAllCategories());
        return view("frontend.pagesAdmin.categories", $this->data);
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
    public function store(CategoryInsertRequest $request)
    {

        $categoriesInfo = $request->all();

        unset($categoriesInfo["_token"]);
        $categoriesInfo["created_at"]=date("Y-m-d h:i:s");
        try{
            $this->categoriesModel->insertCategory($categoriesInfo);
            return redirect()->back()->with("success", "Category successfuly inserted!");
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
            $modelTag = new Category();
            $modelTag->editCategory($request->all());

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
        $modelCategory = new Category();
        try{
            $modelCategory->destroyCat($id);

            return redirect()->back()->with("success", "You successfully deleted a category!");
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->with("error", "Something gone wrong please try again later!");
        }
    }
}
