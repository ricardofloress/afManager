<?php

use App\tbl_client_detail;
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
                <a href="{{URL::to('/all-client')}}">Listagem</a>
                <i style="margin: 0 5px;" class="fas fa-angle-right"></i>

            </li>
            <li>
                <i class="icon-edit"></i>
                <a href="#">Editar Cliente</a>
            </li>
        </ul>
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>CLIENTE - <strong>{{$client_info->client_name}}</strong></h2>

        </div>
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
        <?php
        $message = Session::get('message');
        if ($message) {
        ?>
            <div class="col-md-6">
                <p class="alert alert-success" style="padding: 1rem;">
                    <i style="padding: 5px;" class="icon fas fa-check"></i>
                    <?php
                    echo $message;
                    Session::put('message', null);
                    ?>
                </p>
            </div>
        <?php
        }
        ?>
        <div class="box-content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Todos os Trabalho Técnicos</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Trabalho Tecnico</th>
                                        <th>Ações</th>

                                    </tr>
                                </thead>
                                <?php
                                $client_details_info = tbl_client_detail::Where('client_id', $client_info->client_id)->get();
                                ?>
                                @foreach($client_details_info as $v_detail)
                                <tbody>
                                    <tr>
                                        <td class="center">{{ $v_detail->created_at }}</td>
                                        <td class="center">{{ $v_detail->client_work_detail }}</td>
                                        <td class="center">
                                            <a class="btn btn-danger" href="{{URL::to('/delete-client-detail/'.$v_detail->client_detail_id)}}" id="delete">
                                                <i style=" width: 18px;" class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>

        <div class="col-md-6 editclient" style="float: left;">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Editar Cliente</h2>
            </div>
            <div class="box-content">

                <form role="form" action="{{url('/update-client/'.$client_info->client_id)}}" method="post">
                    {!! csrf_field() !!}
                    <fieldset>
                        <div class="form-group">
                            <label class="control-label" for="date01">Nome da Cliente</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="client_name" value="{{$client_info->client_name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="date01">Número de Telemóvel</label>
                            <div class="controls">
                                <input type="number" class="form-control" name="client_phonenumber" value="{{$client_info->client_phonenumber}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="selectError">Tipo de Cabelo</label>
                            <div class="controls">
                                <select name="client_hair_type" class="form-control" id="selectError" data-rel="chosen">
                                    <option value="{{$client_info->client_hair_type}}">(Selecione...)</option>
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
                                    <option value="{{$client_info->client_scalp_type}}">(Selecione...)</option>
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
                                <input type="text" class="form-control" name="client_address" value="{{$client_info->client_address}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="date01">Código Postal</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="client_zip" value="{{$client_info->client_zip}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="date01">Cidade</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="client_city" value="{{$client_info->client_city}}">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Editar Cliente</button>
                            <button type="reset" class="btn"><a href="{{URL::to('/all-client')}}">Cancelar</a></button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-sm-5 editclient" style="float: right;">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Adicinar Trabalho Técnico</h2>
            </div>
            <div class="box-content">
                <form action="{{url('/add-client-detail')}}" method="POST">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="control-label">Trabalho Técnico</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="client_work_detail">
                            <input type="hidden" class="form-control" name="client_id" value="{{$client_info->client_id}}">

                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Adicionar Trabalho</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!--/span-->

</div>
<!--/row-->

@endsection