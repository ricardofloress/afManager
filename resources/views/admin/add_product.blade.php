<?php

use App\tbl_category;
use App\tbl_client_scalp;
use App\tbl_manufacturer;
use App\tbl_product;
use Illuminate\Support\Facades\Session;
?>
@extends('admin.admin_layout')

@section('admin_content')



<div class="row-fluid sortable">
    <div class="col-md-12" style="padding: 40px;">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{URL::to('/dashboard')}}">Página Inicial</a>
                <i style="margin: 0 5px;" class="fas fa-angle-right"></i>

            </li>
            <li>
                <i class="icon-edit"></i>
                <a href="#">Adicionar Produto</a>
            </li>
        </ul>
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Adicionar Produto</h2>
        </div>
        <div class="box-content">
        <div class="col-md-6" style="padding-left: 0; ">
                @if(Session::has('fail'))
                <div class="alert alert-danger">
                    <i style="padding: 5px;" class="icon fas fa-ban"></i>
                    {{Session::get('fail')}}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style=" padding-left: 0;  margin-bottom: 0;">
                        @foreach ($errors->all() as $error)
                        <li style="list-style: none;">
                            <i style="padding: 5px;" class="icon fas fa-ban"></i>
                            {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <form role="form" action="{{url('/save-product')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <fieldset>
                    <div class="form-group">
                        <label class="control-label" for="date01">Nome do Produto</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="product_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="date01">Código de Barras</label>
                        <div class="controls">
                            <input type="number" class="form-control" name="product_ean">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="selectError">Categoria</label>
                        <div class="controls">
                            <select name="category_id" class="form-control" id="selectError" data-rel="chosen">
                                <option>(Seleciona Uma Categoria...)</option>
                                <?php
                                $all_published_categories = tbl_category::all();
                                foreach ($all_published_categories as $v_category) {
                                ?>
                                    <option value="{{$v_category->category_id}}">{{$v_category->category_name}}</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="selectError3">Marca</label>
                        <div class="controls">
                            <select id="selectError3" class="form-control" name="manufacturer_id">
                                <option value="">(Seleciona Uma Marca...)</option>
                                <?php
                                $all_published_manufacture = tbl_manufacturer::all();
                                foreach ($all_published_manufacture as $v_manufacture) {
                                ?>
                                    <option value="{{$v_manufacture->manufacturer_id}}">{{$v_manufacture->manufacturer_name}}</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label" for="textarea2">Pequena Descrição</label>
                        <div class="controls">
                            <textarea class="form-control" name=" product_short_description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label" for="textarea2">Descrição</label>
                        <div class="controls">
                            <textarea class="form-control" name=" product_long_description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="date01">Preço</label>
                        <div class="controls">
                            <input type="number" class="form-control" name="product_price">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Imagem</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="product_image" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Escolher Imagem</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="date01">Tamanho</label>
                        <div class="controls">
                            <input type="number" class="form-control" name="product_size">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="date01">Stock(Quantidade)</label>
                        <div class="controls">
                            <input type="number" class="form-control" name="stock_quantity">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="control-label" for="textarea2">Estado</label>
                        <div class="controls">
                            <input type='hidden' value='0' name='publication_status'>
                            <input type="checkbox" name="publication_status" value="1">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Adicionar Produto</button>
                        <button type="reset" class="btn"><a href="{{URL::to('/all-product')}}">Cancelar</a></button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
    <!--/span-->

</div>
<!--/row-->

@endsection