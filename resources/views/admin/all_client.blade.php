<?php

use Illuminate\Support\Facades\Session;
?>
@extends('admin.admin_layout')

@section('admin_content')

<div class="row-fluid sortable">
    <div class="col-md-12" style="padding: 40px;">
        <ul class="breadcrumb">
            <li><a href="{{URL::to('/add-client')}}">
                    <i style="padding: 5px;" class="icon fas fa-plus"></i>
                    Adicionar Cliente</a></li>
        </ul>
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Clientes</h2>
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
                            <h3 class="card-title">Todas as Clientes</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" id="myInput" class="form-control float-right" onkeyup="myFunction()" placeholder="Nome da Cliente..." title="Escreva o nome do Produto">


                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table id="myTable" class="table table-head-fixed text-nowrap table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Telémovel</th>

                                        <th>Ações</th>

                                    </tr>
                                </thead>
                                @foreach( $all_client_info as $v_client)
                                <tbody>
                                    <tr>
                                        <td class="center">{{ $v_client->client_name }}</td>
                                        <td class="center">{{ $v_client->client_phonenumber }}</td>
                                        <td class="center">
                                            <a class="btn btn-info" href="{{URL::to('/edit-client/'.$v_client->client_id)}}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                                <script>
                                    function myFunction() {
                                        var input, filter, table, tr, td, i, txtValue;
                                        input = document.getElementById("myInput");
                                        filter = input.value.toUpperCase();
                                        table = document.getElementById("myTable");
                                        tr = table.getElementsByTagName("tr");
                                        for (i = 0; i < tr.length; i++) {
                                            td = tr[i].getElementsByTagName("td")[0];
                                            if (td) {
                                                txtValue = td.textContent || td.innerText;
                                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                    tr[i].style.display = "";
                                                } else {
                                                    tr[i].style.display = "none";
                                                }
                                            }
                                        }
                                    }
                                </script>
                            </table>
                        </div>
                        <!-- /.card-body -->
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