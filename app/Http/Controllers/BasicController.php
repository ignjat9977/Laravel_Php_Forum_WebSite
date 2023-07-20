<?php

namespace App\Http\Controllers;

use App\Models\BasicDataModel;
use Illuminate\Http\Request;

abstract class BasicController extends Controller
{
    protected $data;

    public function __construct()
    {
        $model = new BasicDataModel();

        $this->data["navItems"] = $model->nav();



    }
}

