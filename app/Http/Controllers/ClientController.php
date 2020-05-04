<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\tbl_client;
use App\tbl_client_detail;
use DB;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Database;

use Illuminate\Support\Facades\Session;


session_start();

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.add_client');
    }

    public function all_client()
    {
        $all_client_info = tbl_client::orderBy('client_name', 'ASC')->get();

        $manage_client = view('admin.all_client')
            ->with('all_client_info', $all_client_info);
        return view('admin.admin_layout')
            ->with('admin.all_client', $manage_client);
    }

    public function save_client(Request $request)
    {
        $validatedData = $request->validate([
            'client_name' => 'required',
            'client_phonenumber' => 'required|unique:tbl_clients',
        ]);

        try {
            $client = new tbl_client();
            $client->client_name = $request->client_name;
            $client->client_phonenumber = $request->client_phonenumber;
            $client->client_address = $request->client_address;
            $client->client_zip = $request->client_zip;
            $client->client_city = $request->client_city;
            $client->client_hair_type = $request->client_hair_type;
            $client->client_scalp_type = $request->client_scalp_type;
            $client->save();
            Session::put('message', 'Cliente Criada com Sucesso!');
            return Redirect::to('/all-client');
        } catch (\Exception $ex) {
            return Redirect::to('/add-client')->withFail('Não foi possivel adiconar a categoria!');
        }
    }

    public function save_client_detail(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required',
            'client_work_detail' => 'required',
        ]);

        try {
            $client_detail = new tbl_client_detail();
            $client_detail->client_work_detail = $request->client_work_detail;
            $client_detail->client_id = $request->client_id;
            $client_detail->save();
            Session::put('message', 'Trabalho Tecnico Criado com Sucesso!');
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withFail('Não foi possivel adiconar o trabalho tecnico!');
        }
    }

    public function edit_client($client_id)
    {
        $client_info = tbl_client::find($client_id);

        $client_info = view('admin.edit_client')
            ->with('client_info', $client_info);
        return view('admin.admin_layout')
            ->with('admin.edit_client', $client_info);
    }

    public function update_client(Request $request, $client_id)
    {
        $validatedData = $request->validate([
            'client_name' => 'required',
            'client_phonenumber' => 'required',
        ]);

        try {
            $client = tbl_client::find($client_id);
            $client->client_name = $request->client_name;
            $client->client_phonenumber = $request->client_phonenumber;
            $client->client_address = $request->client_address;
            $client->client_zip = $request->client_zip;
            $client->client_city = $request->client_city;
            $client->client_hair_type = $request->client_hair_type;
            $client->client_scalp_type = $request->client_scalp_type;
            $client->save();
            Session::put('message', 'Cliente Editada com Sucesso!');
            return Redirect::to('/all-client');
        } catch (\Exception $ex) {
            return redirect()->back()->withFail('Não foi possivel editar o registo da cliente!');
        }
    }

    public function delete_client_detail($client_detail_id)
    {
        try {
            $client_detail = tbl_client_detail::find($client_detail_id);
            $client_detail->delete();
            Session::put('message', 'Trabalho Técnico Eliminado com Sucesso!');
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withFail('Não foi possivel eliminar o trabalho tecnico!');
        }
    }
}
