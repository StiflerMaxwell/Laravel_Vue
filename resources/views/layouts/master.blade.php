
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Laravel+Vue DEMO</title>
 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">

 <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition sidebar-mini" >
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
      </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

   
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/dashboard" class="brand-link">
      <img src="{{ asset('/img/logo.svg') }}" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Laravel+Vue</span>
    </router-link>

    <!-- Sidebar -->


    
     <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <router-link to="/profile"  class="d-flex">    
        <div class="image">
          {{-- <img src="./img/man.svg" class="img-circle elevation-2 mt-2" alt="User Image"> --}}
         <img src="./img/profile/{{ Auth::user()->photo }}"  class="img-circle elevation-2 mt-2" alt="User Image"/>
        </div>
        <div class="info">           
            {{ Auth::user()->name }}
            <span class="d-block  ">
              {{ Ucfirst(Auth::user()->type) }}
            </span>
        </div>
      </router-link>
      </div>



     
        <!-- Sidebar Menu -->
      @include('layouts.side-menu')
      <!-- /.sidebar-menu -->
    </div>  
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
         {{--  <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item">
                  <router-link to="/dashboard" class="nav-link">
                      Home    
                  </router-link>
             </li>
              <li class="breadcrumb-item active">{{url()->current()}}</li>
            </ol>
          </div> --}}<!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

   
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
   
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a target="_blank" href="https://www.chengzzz.site">Chengzzz</a>.</strong> All rights reserved.


    <div class="float-right d-none d-sm-inline">
       Power with Admin LTE 3
      </div>

  </footer>
</div>
 


@auth
<script>
    window.user = @json(auth()->user())
 

</script>
@endauth
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
