<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('build/assets/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/style.css') }}" rel="stylesheet">

    <title>Gestion de candidature</title>
</head>
<?php 
if (Auth::check()) {
  $role = Auth::user()->role;
} 
?>

<body class="bg-dark">


	<nav class="navbar navbar-expand-sm navbar-light  navbar-inverse navbar-fixed-top" style="z-index: 1;position: fixed;top: 0;left: 0;width: 100%;" id="neubar">

    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button class="btn btn-warning" type="submit">Se deconnecter</button>
  </form>
  @if ($role==1)
    
          <div class=" collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto ">
              <li class="nav-item">
                <a  id="un" class="nav-link mx-2 active " aria-current="page" href="{{route('fcs.index')}}">Accueil</a>
              </li>



              <div class="dropdown " id="trois">
                <button class="btn btn-warning  dropdown-toggle nav-link mx-2 active" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Operations CRUD
                </button>
                <div class="dropdown-menu" id="dropMenu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item text-white" href="{{route('formations.index')}}">Formation</a>
                  <a class="dropdown-item text-white" href="{{route('referentiels.index')}}">Referentiel</a>
                  <a class="dropdown-item text-white" href="{{route('types.index')}}">Type</a>
                </div>
              </div>
              

            </ul>
          </div>
          @else
          <div class=" collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto ">
              <li class="nav-item">
                <a  id="un" class="nav-link mx-2 active " aria-current="page" href="{{route('fcs.index')}}">Accueil</a>
              </li>
            </ul>
          </div>

          @endif

      </nav>


    <div class="container mt-5">
            @yield('content')

    </div>

    <div class="container" style="float: right">
      @yield('content1')

    </div>

    
    
</body>

</html>

<script src="{{ asset('build/assets/script.js') }}"></script>
<!--
<script src="{{ asset('build/assets/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('build/assets/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('build/assets/jquery.dataTables.js') }}"></script> -->

<script src="{{ asset('build/assets/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('build/assets/bootstrap.js') }}"></script>
