<?php

use App\tbl_client_hair_type;
use App\tbl_client_scalp;
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
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Adicionar Cliente</h2>
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
            <form role="form" action="{{url('/save-client')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <fieldset>
                    <div class="form-group">
                        <label class="control-label" for="date01">Nome da Cliente</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="client_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="date01">Número de Telemóvel</label>
                        <div class="controls">
                            <input type="number" class="form-control" name="client_phonenumber">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="selectError">Tipo de Cabelo</label>
                        <div class="controls">
                            <select name="client_hair_type" class="form-control" id="selectError" data-rel="chosen">
                                <option></option>
                                <?php
                                $all_published_hair_type = tbl_client_hair_type::all();
                                foreach ($all_published_hair_type as $v_hair_type) {
                                ?>
                                    <option value="{{$v_hair_type->hair_type_id}}">{{$v_hair_type->hair_type}}</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="selectError3">Couro Cabeludo</label>
                        <div class="controls">
                            <select id="selectError3" class="form-control" name="client_scalp_type">
                                <option></option>
                                <?php
                                $all_published_sclap = tbl_client_scalp::all();
                                foreach ($all_published_sclap as $v_scalp) {
                                ?>
                                    <option value="{{$v_scalp->scalp_type_id}}">{{$v_scalp->scalp_type}}</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="date01">Morada</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="client_address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="date01">Código Postal</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="client_zip">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="date01">Cidade</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="client_city">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Adicionar Cliente</button>
                        <button type="reset" class="btn"><a href="{{URL::to('/all-client')}}">Cancelar</a></button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
    <!--/span-->

</div>
<!--/row-->

@endsection