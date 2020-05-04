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
                <a href="{{URL::to('/add-product')}}">
                    <i style="padding: 5px;" class="icon fas fa-plus"></i>
                    Adicionar Produto</a>
                </li>
                <i class="icon-angle-right"></i>
            </li>
        </ul>
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>PRODUTOS</h2>

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
                            <h3 class="card-title">Todos os Produtos</h3>
                            <div class="card-tools">
                                <form action="{{url('/search-product')}}" method="POST" role="search">
                                    {{ csrf_field() }}
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="q" class="form-control float-right" placeholder="Nome do Produto...">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table id="myTable" class="table table-head-fixed text-nowrap table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Imagem</th>
                                        <th>Nome</th>
                                        <th>Categoria</th>
                                        <th>Marca</th>
                                        <th>Preço</th>
                                        <th>Quantidade</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                @foreach( $all_product_info as $v_product)
                                <tbody>
                                    <tr>
                                        <td><img src="{{URL::to($v_product->product_image)}}" height="80px" class="imgTableCell"/></td>
                                        <td class="center">{{ $v_product->product_name }}</td>
                                        <td class="center hidden-xs">{{ $v_product->category_name }}</td>
                                        <td class="center hidden-xs">{{ $v_product->manufacturer_name }}</td>
                                        <td class="center hidden-xs">{{ $v_product->product_price }}</td>
                                        <td class="center hidden-xs">{{ $v_product->stock_quantity }}</td>
                                        <td class="center">
                                            <a class="btn btn-info" href="{{URL::to('/edit-product/'.$v_product->product_id)}}">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger" href="{{URL::to('/delete-product/'.$v_product->product_id)}}" id="delete">
                                                <i style=" width: 18px;" class="far fa-trash-alt"></i>
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
                                            td = tr[i].getElementsByTagName("td")[1];
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
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $all_product_info->links() }}
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