<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\tbl_category;
use DB;
use Exception;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Database;

use Illuminate\Support\Facades\Session;


session_start();

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.add_category');
    }

    public function all_category()
    {
        $all_category_info = tbl_category::paginate(10);

        $manage_category = view('admin.all_category')
            ->with('all_category_info', $all_category_info);
        return view('admin.admin_layout')
            ->with('admin.all_category', $manage_category);
    }

    public function save_category(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:tbl_categories',
        ]);

        try {

            $category = new tbl_category();
            $category->category_name = $request->category_name;
            $category->category_description = $request->category_description;
            $category->publication_status = $request->publication_status;
            $category->save();
            Session::put('message', 'Categoria Adiconada com Sucesso!');
            return Redirect::to('/all-category');

        } catch (Exception $ex) {
            return Redirect::to('/add-category')->withFail('Não foi possivel adiconar a categoria!');
        }
    }

    public function edit_category($category_id)
    {
        $category_info = tbl_category::find($category_id);

        $category_info = view('admin.edit_category')
            ->with('category_info', $category_info);
        return view('admin.admin_layout')
            ->with('admin.edit_category', $category_info);
    }

    public function update_category(Request $request, $category_id)
    {
        $validatedData = $request->validate([
            'category_name' => 'required',
        ]);

        try {

            $category = tbl_category::find($category_id);
            $category->category_name = $request->category_name;
            $category->category_description = $request->category_description;
            $category->publication_status = $request->publication_status;
            $category->save();
            Session::put('message', 'Categoria Editada com Sucesso!');
            return Redirect::to('/all-category');

        } catch (Exception $ex) {
            return Redirect::back()->withFail('Não foi possivel editar a categoria!');
        }
    }

    public function delete_category($category_id)
    {
        try {
            $category = tbl_category::find($category_id);
            $category->delete();
    
            Session::put('message', 'Categoria Eliminada com Sucesso!');
            return Redirect::to('/all-category');

        } catch (Exception $ex) {
            return Redirect::back()->withFail('Não foi possivel editar a categoria!');
        }
    }
}
