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
                <a href="{{URL::to('/dashboard')}}">Página Inicial</a>
                <i style="margin: 0 5px;" class="fas fa-angle-right"></i>

            </li>
            <li>
                <i class="icon-edit"></i>
                <a href="#">Editar Categoria</a>
            </li>
        </ul>
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Editar Categoria</h2>
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
            <form role="form" action="{{url('/update-category/'.$category_info->category_id)}}" method="post">
                {{ csrf_field() }}
                <fieldset>
                    <div class="form-group">
                        <label class="control-label" for="date01">Nome da Categoria</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="category_name" value="{{$category_info->category_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="textarea2">Descrição</label>
                        <div class="controls">
                            <textarea class="form-control" name="category_description" rows="3">{{$category_info->category_description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="textarea2">Estado</label>
                        <div class="controls">
                            <input type='hidden' value='0' name='publication_status'>
                            @if($category_info->publication_status==1)
                            <input type="checkbox" name="publication_status" value="1" checked>
                            @else
                            <input type="checkbox" name="publication_status" value="1">
                            @endif
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Editar Categoria</button>
                        <button type="reset" class="btn"><a href="{{URL::to('/all-category')}}">Cancelar</a></button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
    <!--/span-->

</div>
<!--/row-->

@endsection