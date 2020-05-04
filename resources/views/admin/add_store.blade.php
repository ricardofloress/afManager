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
                <a href="#">Adicionar Loja</a>
            </li>
        </ul>
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Adicionar Loja</h2>
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
            <form role="form" action="{{url('/save-store')}}" method="post">
                {{ csrf_field() }}
                <fieldset>
                    <div class="form-group">
                        <label class="control-label" for="date01">Nome da Loja</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="store_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="date01">Nif</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="store_vat">
                        </div>
                    </div>
                    <div class="form-group  ">
                        <label class="control-label" for="textarea2">Estado</label>
                        <div class="controls">
                            <input type='hidden' value='0' name='publication_status'>
                            <input type="checkbox" name="publication_status" value="1">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Adicionar Loja</button>
                        <button type="reset" class="btn"><a href="{{URL::to('/all-store')}}">Cancelar</a></button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
    <!--/span-->

</div>
<!--/row-->

@endsection