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

<body class="bg-dark">


	<nav class="navbar navbar-expand-sm navbar-light  navbar-inverse navbar-fixed-top" style="z-index: 1;position: fixed;top: 0;left: 0;width: 100%;" id="neubar">

       
          <div class=" collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto ">
              <li class="nav-item">
                <a  id="un" class="nav-link mx-2 active " aria-current="page" href="{{route('accueil')}}">Accueil</a>
              </li>

              <li class="nav-item">
                <a id="deux" class="nav-link mx-2 active" aria-current="page" href="{{route('candidats.index')}}">Candidat</a>
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
      </nav>


    <div class="container mt-5">
            @yield('content')

    </div>

    
    
</body>

</html>

<script src="{{ asset('build/assets/script.js') }}"></script>


<script src="{{ asset('build/assets/jquery-3.6.0.js') }}"></script>

<script src="{{ asset('build/assets/bootstrap.js') }}"></script>
