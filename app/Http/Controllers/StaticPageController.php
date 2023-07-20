<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUserRequest;
use App\Models\RegisterModel;
use Illuminate\Http\Request;

class StaticPageController extends BasicController
{
    public function contact(){
        return view("frontend.pages.contact", $this->data);
    }
    public function create(ContactUserRequest $request){
        $contactInfo = $request->all();
        unset($contactInfo["_token"]);
        $contactInfo["created_at"] = date("Y-m-d H:i:s");
        $model = new RegisterModel();
        try{
            $model->insertContactMessage($contactInfo);
            session()->put("success", "Your message has been sent!");
            return redirect()->route("contact");
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            session()->put("error", "Something gone wrong please try again!");
            return redirect()->route("contact");
        }

    }
    public function author(){
        return view("frontend.pages.author", $this->data);
    }

    public function about(){
        return view("frontend.pages.about", $this->data);
    }
    public function error(){
        return view("frontend.pages.error", $this->data);
    }
    public function contactAdmin(){
        return view("frontend.pages.contactAdmin", $this->data);
    }
}
