<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\tbl_store;
use DB;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Database;

use Illuminate\Support\Facades\Session;


session_start();

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.add_store');
    }

    public function all_store()
    {
        $all_store_info = tbl_store::all();
        $manage_store = view('admin.all_store')
            ->with('all_store_info', $all_store_info);
        return view('admin.admin_layout')
            ->with('admin.all_store', $manage_store);
    }

    public function save_store(Request $request)
    {
        $validatedData = $request->validate([
            'store_name' => 'required',
            'store_vat' => 'required|unique:tbl_stores',
        ]);

        try {
            $store = new tbl_store();
            $store->category_name = $request->store_name;
            $store->store_vat = $request->store_vat;
            $store->publication_status = $request->publication_status;
            $store->save();
            Session::put('message', 'Loja Adicionada com Sucesso!');
            return Redirect::to('/all-store');
        } catch (\Exception $ex) {
            return Redirect::back()->withFail('Não foi possivel adiconar a Loja!');
        }
    }

    public function edit_store($store_id)
    {
        $store_info = tbl_store::find($store_id);
        $store_info = view('admin.edit_store')
            ->with('store_info', $store_info);
        return view('admin.admin_layout')
            ->with('admin.edit_store', $store_info);
    }

    public function update_store(Request $request, $store_id)
    {

        try {

            $store = tbl_store::find($store_id);
            $store->category_name = $request->store_name;
            $store->store_vat = $request->store_vat;
            $store->publication_status = $request->publication_status;
            $store->save();
            Session::put('message', 'Loja Editada com Sucesso!');
            return Redirect::to('/all-store');
        } catch (\Exception $ex) {
            return Redirect::back()->withFail('Não foi possivel editar a Loja!');
        }
    }

    public function delete_store($store_id)
    {
        try {
            $store = tbl_store::find($store_id);
            $store->delete();
            Session::put('message', 'Loja Eliminada com Sucesso!');
            return Redirect::to('/all-store');
        } catch (\Exception $ex) {
            return Redirect::back()->withFail('Não foi possivel eliminar a Loja!');
        }
    }
}
