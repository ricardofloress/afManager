<?php

use Illuminate\Support\Facades\Session;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aida Flores Cabeleireiro</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
    <!-- Theme style custom -->
    <link rel="stylesheet" href="{{asset('backend/css/af.css')}}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="shortcut icon" href="{{URL::to('img/favicon.ico')}}">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="https://aidaflorescabeleireiro.pt/" target="blank" class="nav-link">Site</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="https://aidaflorescabeleireiro.pt/contactos.php" target="blank" class="nav-link">Contactos</a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="{{URL::to('/admin-logout')}}" class="dropdown-item dropdown-footer">Terminar Sessão</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{URL::to('/')}}" class="brand-link">
                <img src="{{asset('AidaFloresCabeleireiroLogoAdmin.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AF Cabeleireiro</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Clientes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{URL::to('/all-client')}}" class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p>Listagem</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{URL::to('/add-client')}}" class="nav-link">
                                        <i class="nav-icon fas fa-plus-square"></i>
                                        <p>Adicionar Cliente</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-store-alt"></i>


                                <p>
                                    Lojas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{URL::to('/all-store')}}" class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p>Listagem</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{URL::to('/add-store')}}" class="nav-link">
                                        <i class="nav-icon fas fa-plus-square"></i>
                                        <p>Adicionar Loja</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Categorias
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{URL::to('/all-category')}}" class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p>Listagem</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{URL::to('/add-category')}}" class="nav-link">
                                        <i class="nav-icon fas fa-plus-square"></i>
                                        <p>Adicionar Categoria</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-copyright"></i>
                                <p>
                                    Marcas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{URL::to('/all-manufacturer')}}" class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p>Listagem</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{URL::to('/add-manufacturer')}}" class="nav-link">
                                        <i class="nav-icon fas fa-plus-square"></i>
                                        <p>Adicionar Marca</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-wine-bottle"></i>
                                <p>
                                    Produtos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{URL::to('/all-product')}}" class="nav-link">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p>Listagem</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{URL::to('/add-product')}}" class="nav-link">
                                        <i class="nav-icon fas fa-plus-square"></i>
                                        <p>Adicionar Produto</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('admin_content')
    </div>
    <!-- /.content-wrapper -->

    <!-- jQuery -->
    <script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('backend/dist/js/demo.js')}}"></script>

    <script type="text/javascript" src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js')}}"></script>

    <script>
        $(document).on("click", "#delete", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            bootbox.confirm("De certeza que quer apagar?", function(confirmed) {
                if (confirmed) {
                    window.location.href = link;
                };

            });
        });
    </script>

</body>

</html>