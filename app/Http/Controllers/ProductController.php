<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\tbl_product;
use DB;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Database;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;


session_start();

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        return view('admin.add_product');
    }

    public function save_product(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'product_ean' => 'required|unique:tbl_products',
            'category_id' => 'required',
            'manufacturer_id' => 'required|min:0',
            'product_price' => 'required|min:0',
            'product_size' => 'required|min:0',
        ]);

        try {
            $product = new tbl_product();
            $product->product_name = $request->product_name;
            $product->product_ean = $request->product_ean;
            $product->category_id = $request->category_id;
            $product->manufacturer_id = $request->manufacturer_id;
            $product->product_short_description = $request->product_short_description;
            $product->product_long_description = $request->product_long_description;
            $product->product_price = $request->product_price;
            $product->product_size = $request->product_size;
            $product->stock_quantity = $request->stock_quantity;
            $product->publication_status = $request->publication_status;
            $product->created_by = Auth::id();
            $image = $request->file('product_image');

            if ($image) {

                $content = $image->getMimeType();

                if (Str::contains($content, "image")) {
                    $image_name = Str::random(20);
                    $text = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $text;
                    $upload_path = 'images/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $image->move($upload_path, $image_full_name);

                    if ($success) {
                        $product->product_image = $image_url;
                        $product->save();
                        Session::put('message', 'Produto Adicionado com Sucesso!');
                        return Redirect::to('all-product');
                    }
                }
            }


            $product->save();
            Session::put('message', 'Produto Adicionado com Sucesso!');
            return Redirect::to('/all-product');
        } catch (\Exception $ex) {
            return Redirect::back()->withFail('Não foi possivel adiconar o produto!');
        }
    }

    public function all_product()
    {
        $all_product_info = DB::table('tbl_products')
            ->join('tbl_categories', 'tbl_products.category_id', '=', 'tbl_categories.category_id')
            ->join('tbl_manufacturers', 'tbl_products.manufacturer_id', '=', 'tbl_manufacturers.manufacturer_id')
            //->select('tbl_products.*', 'tbl_categories.category_name', 'tbl_manufacturers.manufacturer_name')
            ->orderBy('product_name', 'ASC')
            ->paginate(10);
        $manage_product = view('admin.all_product')
            ->with('all_product_info', $all_product_info);
        return view('admin.admin_layout')
            ->with('admin.all_product', $manage_product);
    }

    public function search_product(Request $request)
    {
        $q = $request->q;

        $all_product_info = DB::table('tbl_products')
            ->where('product_name', 'LIKE', '%' . $q . '%')
            ->join('tbl_categories', 'tbl_products.category_id', '=', 'tbl_categories.category_id')
            ->join('tbl_manufacturers', 'tbl_products.manufacturer_id', '=', 'tbl_manufacturers.manufacturer_id')
            ->paginate(5)
            ->setPath('');

        if (count($all_product_info) > 0) {
            //return view('all_product')->with($all_product_info);
            $manage_product = view('admin.all_product')
                ->with('all_product_info', $all_product_info);
            return view('admin.admin_layout')
                ->with('admin.all_product', $manage_product);
        } else {
            return Redirect::back()->withFail('Não foram encontrados resultado da pesquisa!');
        }
    }

    public function edit_product($product_id)
    {
        $product_info = DB::table('tbl_products')
            ->Where('product_id', $product_id)
            ->join('tbl_categories', 'tbl_products.category_id', '=', 'tbl_categories.category_id')
            ->join('tbl_manufacturers', 'tbl_products.manufacturer_id', '=', 'tbl_manufacturers.manufacturer_id')
            ->select('tbl_products.*', 'tbl_categories.category_name', 'tbl_manufacturers.manufacturer_name')
            ->first();

        $product_info = view('admin.edit_product')
            ->with('product_info', $product_info);
        return view('admin.admin_layout')
            ->with('admin.edit_product', $product_info);
    }

    public function update_product(Request $request, $product_id)
    {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'product_ean' => 'required',
            'category_id' => 'required',
            'manufacturer_id' => 'required|min:0',
            'product_price' => 'required|min:0',
            'product_size' => 'required|min:0',
        ]);

        try {
            $product = tbl_product::find($product_id);
            $product->product_name = $request->product_name;
            $product->product_ean = $request->product_ean;
            $product->category_id = $request->category_id;
            $product->manufacturer_id = $request->manufacturer_id;
            $product->product_short_description = $request->product_short_description;
            $product->product_long_description = $request->product_long_description;
            $product->product_price = $request->product_price;
            $product->product_size = $request->product_size;
            $product->stock_quantity = $request->stock_quantity;
            $product->publication_status = $request->publication_status;
            $product->created_by = Auth::id();
            $image = $request->file('product_image');


            if ($image) {

                $content = $image->getMimeType();

                if (Str::contains($content, "image")) {
                    $image_name = Str::random(20);
                    $text = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $text;
                    $upload_path = 'images/';
                    $image_url = $upload_path . $image_full_name;
                    $success = $image->move($upload_path, $image_full_name);

                    if ($success) {
                        $product->product_image = $image_url;
                    }
                }
            }
            $product->save();
            Session::put('message', 'Produto Editado com Sucesso!');
            return Redirect::to('/all-product');
        } catch (\Exception $ex) {
            return Redirect::back()->withFail('Não foi possivel editar o produto!');
        }
    }

    public function delete_product($product_id)
    {
        try {
            $product = tbl_product::find($product_id);
            $product->delete();
            Session::put('message', 'Produto Eliminado com Sucesso!');
            return Redirect::to('/all-product');
        } catch (\Exception $ex) {
            return Redirect::back()->withFail('Não foi possivel eliminar o Produto!');
        }
    }
}
