
<?php $current_url = explode("/", Request::url()); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/fontawesome-free/css/all.min.css') }} ">
	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/toastr/toastr.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/daterangepicker/daterangepicker.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"> 
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> 
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> --}}
    
  	
    <title>{{ $title  !== "" ? $title : "Gotham"}}</title>

</head>
{{-- <body class="sidebar-mini layout-fixed"> --}}
<body class="sidebar-mini layout-fixed dark-mode">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark bg-lightblue">
                <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/execute/logout" class="nav-link">Logout</a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link bg-lightblue">
                {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
                <span class="brand-text font-weight-light">Gotham API</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar os-host os-theme-light os-host-resize-disabled os-host-transition os-host-overflow os-host-overflow-y os-host-scrollbar-horizontal-hidden"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 347px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
              <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Brandon</a>
                    </div>
                </div>
        
              <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="/admin/dashboard" class="nav-link">
                                <i class="fa-solid fa-gauge"></i>
                                <p>
                                    Dasboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item <?=($current_url[4] && $current_url[4] == "doctors") ? "menu-open" : "";?>">
                            <a href="javascript:void(0)" class="nav-link <?=($current_url[4] &&$current_url[4] == "doctors") ? "active" : "";?>">
                                <i class="fa-solid fa-user-doctor"></i>
                                <p> Doctors
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/doctors" class="nav-link <?=($current_url[4] && $current_url[4] == "doctors") ? "active" : "";?>">
                                        <i class="fa-regular fa-address-book"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/new-doctor" class="nav-link">
                                        <i class="fa-solid fa-person-circle-plus"></i>
                                        <p>New Doctor</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/clients" class="nav-link <?=($current_url[4] && $current_url[4] == "clients") ? "active" : "";?>">
                                <i class="fa-solid fa-hospital-user"></i>
                                <p>
                                    Clients
                                </p>
                            </a>
                        </li>

                        <li class="nav-item <?=( $current_url[4] &&in_array($current_url[4], ['users', 'intakes', 'user-add'])) ? "menu-open" : "";?>">
                            <a href="javascript:void(0)" class="nav-link <?=($current_url[4] &&in_array($current_url[4], ['users', 'intakes', 'user-add'])) ? "active" : "";?>">
                                <i class="fa-solid fa-gears"></i>
                                <p> Maintenance
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/users" class="nav-link <?=($current_url[4] && $current_url[4] == "users") ? "active" : "1";?>">
                                        <i class="fa-solid fa-users-gear"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/intakes" class="nav-link <?=($current_url[4] && $current_url[4] == "intakes") ? "active" : "";?>">
                                        <i class="fa-solid fa-file-circle-question"></i>
                                        <p>Intakes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
              </nav>
              <!-- /.sidebar-menu -->
            </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 25.6071%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
            <!-- /.sidebar -->
          </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> {{ $header }} </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                