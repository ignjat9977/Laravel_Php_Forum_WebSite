<?php

namespace App\Logging;

use App\Models\BlogUser;

class ReadLogs
{
    public function __construct()
    {

    }

    public function readInfo($time = null){
        $file = fopen(storage_path("logs/info.log"),"r");

        $content = fread($file,filesize(storage_path("logs/info.log")));

        $line = explode("\n", $content);


        $arr = [];
        for($i = 0; $i<count($line); $i++){
            $all = new \stdClass();
            $x = explode(" Info: ", $line[$i]);
            $date = "";
            if(isset($x[0])){
                $date = $x[0];
            }
            if(isset($x[1])){
                $y = explode(" ", $x[1]);
            }
            if(isset($y[1])){
                $z = explode("ttp://127.0.0.1:8000", $y[1]);
            }


            $pagee = "";
            if(isset($z[1])){
                switch($z[1]){
                    case "":
                        $pagee = "Home";
                        break;
                    case "/posts":
                        $pagee = "Home";
                        break;
                    case "/contact":
                        $pagee = "Contact";
                        break;
                    case substr($z[1], 0, 7) == "/posts?":
                        $pagee = "Home";
                        break;
                    case substr($z[1], 0, 7) == "/posts/";
                        $pagee = "Post";
                        break;
                    case "/contacted":
                        $pagee = "We are contacted";
                        break;
                    case "/about":
                        $pagee = "About";
                        break;
                    case "/author":
                        $pagee = "Author";
                        break;
                    case "/login":
                        $pagee = "Login";
                        break;
                    case "/logIn":
                        $pagee = "Logged in";
                        break;
                    case "/register":
                        $pagee = "Register";
                        break;
                    case "/registered":
                        $pagee = "User registered";
                        break;
                    case "/contactAdmin":
                        $pagee = "Contact Admin";
                        break;
                    case "/contactedAdmin":
                        $pagee = "Admin is contacted";
                        break;
                    case "/account":
                        $pagee = "Account";
                        break;
                    case "/logout":
                        $pagee = "Log outed";
                        break;
                    case "/changeProfileImg":
                        $pagee = "Profile image Changed";
                        break;
                    case "/changeAccountPassword":
                        $pagee = "Account password changed";
                        break;
                    case "/commented":
                        $pagee = "Commented some post";
                        break;
                    case "/commentedDelete":
                        $pagee = "Comment deleted";
                        break;
                    case "/likedComment":
                        $pagee = "Some comment liked or unliked";
                        break;
                    case "/likedPost":
                        $pagee = "Some post liked or unliked";
                        break;
                    default:
                        $pagee = "Admin activity";
                        break;

                }
            }
            $user = new BlogUser();
            $in = '';
            if(isset($y[0])){
                $y[0] == 0 ? $in = "Unknown User" : $in = json_decode($user->getUserInfo($y[0]));
            }
            if(isset($y[2])){
                $all->ip_adress = $y[2];
            }

            $all->date = $date;
            $all->user_id = $in;
            $all->page = $pagee;


            $arr[] = $all;

        }
        if($time=="timeAsc")
            return $arr;

        $arr = array_reverse($arr);
        return $arr;
    }
}
