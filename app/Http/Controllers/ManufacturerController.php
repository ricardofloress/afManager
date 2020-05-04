<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\tbl_manufacturer;
use DB;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Database;

use Illuminate\Support\Facades\Session;

session_start();

class manufacturerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.add_manufacturer');
    }

    public function save_manufacturer(Request $request)
    {
        $validatedData = $request->validate([
            'manufacturer_name' => 'required|unique:tbl_manufacturers',
        ]);

        try {

            $manufacturer = new tbl_manufacturer();
            $manufacturer->manufacturer_name = $request->manufacturer_name;
            $manufacturer->manufacturer_description = $request->manufacturer_description;
            $manufacturer->publication_status = $request->publication_status;
            $manufacturer->manufacturer_store = $request->manufacturer_store;
            $manufacturer->save();

            Session::put('message', 'Marca Adicionada com Sucesso!');
            return Redirect::to('/all-manufacturer');
        } catch (\Exception $ex) {
            return Redirect::back()->withFail('Não foi possivel adiconar a Marca');
        }
    }

    public function all_manufacturer()
    {
        $all_manufacturer_info = DB::table('tbl_manufacturers')
            ->leftjoin('tbl_stores', 'tbl_manufacturers.manufacturer_store', '=', 'tbl_stores.store_id')
            ->paginate(10);
        $manage_manufacturer = view('admin.all_manufacturer')
            ->with('all_manufacturer_info', $all_manufacturer_info);
        return view('admin.admin_layout')
            ->with('admin.all_manufacturer', $manage_manufacturer);
    }

    public function edit_manufacturer($manufacturer_id)
    {
        $manufacturer_info = tbl_manufacturer::find($manufacturer_id);
        $manufacturer_info = view('admin.edit_manufacturer')
            ->with('manufacturer_info', $manufacturer_info);
        return view('admin.admin_layout')
            ->with('admin.edit_manufacturer', $manufacturer_info);
    }

    public function search_manufacturer(Request $request)
    {
        $q = $request->q;

        $all_manufacturer_info = DB::table('tbl_manufacturers')
            ->where('manufacturer_name', 'LIKE', '%' . $q . '%')
            ->join('tbl_stores', 'tbl_manufacturers.manufacturer_store', '=', 'tbl_stores.store_id')
            ->paginate(5)
            ->setPath('');

        if (count($all_manufacturer_info) > 0) {
            //return view('all_product')->with($all_product_info);
            $manage_manufacturer = view('admin.all_manufacturer')
                ->with('all_manufacturer_info', $all_manufacturer_info);
            return view('admin.admin_layout')
                ->with('admin.all_manufacturer', $manage_manufacturer);
        } else {
            return Redirect::back()->withFail('Não foram encontrados resultado da pesquisa!');
        }
    }

    public function update_manufacturer(Request $request, $manufacturer_id)
    {
        $validatedData = $request->validate([
            'manufacturer_name' => 'required',
        ]);

        try {
            $manufacturer = tbl_manufacturer::find($manufacturer_id);
            $manufacturer->manufacturer_name = $request->manufacturer_name;
            $manufacturer->manufacturer_description = $request->manufacturer_description;
            $manufacturer->publication_status = $request->publication_status;
            $manufacturer->manufacturer_store = $request->manufacturer_store;
            $manufacturer->save();

            Session::put('message', 'Marca Editada com Sucesso!');
            return Redirect::to('/all-manufacturer');
        } catch (\Exception $ex) {
            return Redirect::back()->withFail('Não foi possivel editar a Marca!');
        }
    }

    public function delete_manufacturer($manufacturer_id)
    {
        try {
            $manufacturer = tbl_manufacturer::find($manufacturer_id);
            $manufacturer->delete();
            Session::put('message', 'Marca Eliminada com Sucesso!');
            return Redirect::to('/all-manufacturer');
        } catch (\Exception $ex) {
            return Redirect::back()->withFail('Não foi possivel eliminar a Marca!');
        }
    }
}
