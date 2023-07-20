<?php

namespace App\Http\Controllers;

use App\Models\BasicDataModel;
use App\Models\BlogUser;
use Illuminate\Http\Request;

abstract class BasicAdminController extends Controller
{
    private $modelNavigation;
    private $userModel;
    protected $data;


    public function __construct()
    {
        $this->modelNavigation = new BasicDataModel();
        $this->userModel = new BlogUser();


        $this->data["navItems"] = $this->modelNavigation->navAdmin();

    }

}
