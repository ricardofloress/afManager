<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;
use DB;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Database;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class SuperAdminController extends Controller
{

    public function index()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect::to('/admin');
    }
}
