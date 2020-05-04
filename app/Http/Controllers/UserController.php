<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use DB;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Database;

use Illuminate\Support\Facades\Session;

session_start();

class UserController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function user_registration(Request $request)
    {
        $validatedData = $request->validate([
            'user_name' => 'required',
            'user_email' => 'required',
            'password' => 'required',
            'mobile_phone' => 'required',
            'user_birthdate' => 'required',
        ]);

        $data = array();
        $data['user_name'] = $request->user_name;
        $data['user_email'] = $request->user_email;
        $data['password'] = md5($request->password);
        $data['mobile_phone'] = $request->mobile_phone;
        $data['user_birthdate'] = $request->user_birthdate;

        $user_id = DB::table('users')->insertGetId($data);

        Session::put('user_id', $user_id);
        Session::put('user_name', $request->user_name);
        return Redirect::to('/');
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'user_email' => 'required',
            'password' => 'required',
        ]);

        $user_email = $request->user_email;
        $user_password = md5($request->password);

        $result = DB::table('users')
            ->where('user_email', $user_email)
            ->where('password', $user_password)
            ->first();
    
        if ($result) {
            Session::put('user_id',  $result->user_id);
            return Redirect::to('/');
        } else {
            Session::put('message', 'Invalid Email or Password!');
            return Redirect::to('/login');
        }
    }



    public function logout()
    {

        Session::flush();
        return Redirect::to('/');
    }
}
