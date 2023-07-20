<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends BasicController
{
    public function index(Request $request){

        return view("frontend.pages.login", $this->data);
    }
    public function login(Request $request){
        $email = $request->input("loginEmail");
        $password = md5($request->input("loginPassword"));

        try{
            $user = \DB::table("blog_users")
                ->join("roles", "blog_users.id_role", "=","roles.id_role")
                ->where("email", "=", $email)
                ->where("password", "=", $password)
                ->first();

            if($user && $user->id_role == 11){
                $request->session()->put("user", $user);
                return redirect()->route("dashboard");
            }

            if($user){
                $request->session()->put("user", $user);
                return redirect()->route("home");
            }

            $request->session()->put("loginError", "Your email or password is inccorect!");
            return redirect()->route("login");
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
        }
    }
    public function logout(Request $request){
        $request->session()->remove("user");
        return redirect()->route("home");
    }
}
