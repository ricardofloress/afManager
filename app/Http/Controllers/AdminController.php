<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use DB;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Database;

use Illuminate\Support\Facades\Session;



class AdminController extends Controller
{
    //

    public function index()
    {
        return view('admin.admin_login');
    }
}
