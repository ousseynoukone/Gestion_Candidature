
@extends('layout.app')
@section('content')

<!-- Button trigger modal -->
<button type="button" hidden id="toggle1" class="btn btn-primary" data-toggle="modal" data-target="#modal">
</button>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert alert-danger">
        <h5 class="modal-title " id="exampleModalLabel">Erreur de saisie ! </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="alertText" class="modal-body alert alert-warning text-center">
      </div>

    </div>
  </div>
</div>

<form method="post" action="{{route('candidats.store')}}">
    @csrf
    <div class="container col-md-10 mt-5 text-dark" style="background-color:#ddc1a0 ">
        <div class="card text-white bg-dark mt-2" >
            <div class="card-header text-center ">Ajouter un candidat</div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nom</label>
    <input type="text"  name="nom" required pattern="[\p{L}\s]+" title="Le nom ne peut contenir que des  lettres et espaces" class="form-control">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Prenom</label>
    <input type="text"  name="prenom" required pattern="[\p{L}\s]+" title="Le nom ne peut contenir que des lettres et espaces" class="form-control">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email"  name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"    title="Saisir votre adresse email  " class="form-control">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Age</label>
    <input type="number"  name="age" min="5" max="90" required pattern="^[0-9]+$" title="Que les chiffres sont acceptés" class="form-control">
  </div>
  
  <label for="form-select">Niveau d'etude</label>
  <select class="form-select"id="niveau" required name="niveauEtude" aria-label="Default select example">
    <option value="" selected>Choisir...</option>
    <option value="Terminal">Terminal</option>
    <option value="Licence">Licence</option>
    <option value="Master">Master</option>
    <option value="Doctorat">Doctorat</option>
  </select>


  <label for="form-select" class="mt-2">Sexe</label>
  <select class="form-select" id="sexe" required name="sexe" aria-label="Default select example" pattern="(Homme|Femme)">
    <option value="" selected>Choisir...</option>
    <option value="Homme">Homme</option>
    <option value="Femme">Femme</option>
  </select>
  

<div class="row  align-items-center mt-2">
    <div class="col-md-3 offset-1 text-center">  <button type="submit" onclick="check(event)" class="btn btn-warning text-white" id="add" style="background-color: #2c2b00">Ajouter</button>  </div>
  
    <div class="text-center offset-3">  <a href="{{route('candidats.index')}}" class="btn btn-warning text-white" style="background-color: #2c2b00">Liste des candidats</a>     </div>

      </div>
</form>

@endsection