<?php

use Illuminate\Support\Facades\Session;
?>
@extends('admin.admin_layout')

@section('admin_content')



<div class="row-fluid sortable">
    <div class="col-md-12" style="padding: 40px;">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{URL::to('/add-manufacturer')}}">
                    <i style="padding: 5px;" class="icon fas fa-plus"></i>
                    Adicionar Marca
                </a>
                <i class="icon-angle-right"></i>
            </li>
        </ul>
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>MARCAS</h2>
        </div>
        <div class="col-md-6">
            @if(Session::has('fail'))
            <div class="alert alert-danger">
                <i style="padding: 5px;" class="icon fas fa-ban"></i>
                {{Session::get('fail')}}
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
                            <h3 class="card-title">Todas as Marcas</h3>
                            <div class="card-tools">
                                <form action="{{url('/search-manufacturer')}}" method="POST" role="search">
                                    {{ csrf_field() }}
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="q" class="form-control float-right" placeholder="Nome da Marca...">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Loja</th>
                                        <th>Estado</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                @foreach( $all_manufacturer_info as $v_manufacture)
                                <tbody>
                                    <tr>
                                        <td class="center">{{ $v_manufacture->manufacturer_name }}</td>
                                        <td class="center">{{ $v_manufacture->store_name }}</td>

                                        <td class="center">
                                            @if($v_manufacture->publication_status == 1)
                                            <span class="badge bg-success">Active</span>
                                            @else
                                            <span class="badge bg-danger">Unactive</span>
                                            @endif
                                        </td>
                                        <td class="center">
                                            <a class="btn btn-info" href="{{URL::to('/edit-manufacturer/'.$v_manufacture->manufacturer_id)}}">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger" href="{{URL::to('/delete-manufacturer/'.$v_manufacture->manufacturer_id)}}" id="delete">
                                                <i style=" width: 18px;" class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $all_manufacturer_info->links() }}
                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <!--/span-->
</div>

<!--/row-->
@endsection