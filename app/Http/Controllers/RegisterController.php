<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\RegisterModel;
use Illuminate\Http\Request;

class RegisterController extends BasicController
{
    public function index(){
        return view("frontend.pages.register", $this->data);
    }
    public function create(RegisterUserRequest $request){

        try{
            $userInfo = $request->all();
            unset($userInfo["_token"]);
            $userInfo["password"] = md5($request->input("password"));
            $userInfo["id_role"] = 1;
            $userInfo["created_at"] = date("Y-m-d H:i:s");
            $model = new RegisterModel();
            $model->insert($userInfo);
            return redirect()->back()->with("successM", "You are successfully registered!");
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return redirect()->back()->with("errorM", "Something gone wrong please try again later!");
        }



    }
}
