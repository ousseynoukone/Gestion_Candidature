
@extends('layout.app')
@section('content')


<form method="post" action="{{route('candidats.update',['candidat'=>$c->id])}}">
    @csrf
    @method('PUT')

    <div class="container col-md-10 mt-5 text-dark" style="background-color:#ddc1a0 ">
        <div class="card text-white bg-dark mt-2" >
            <div class="card-header text-center ">Mettre-a-jour un candidat</div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nom</label>
    <input type="text" value="{{$c->nom}}" name="nom" required pattern="^[a-zA-ZÀ-ÖØ-öø-ÿ]+[a-zA-Z0-9\sÀ-ÖØ-öø-ÿ]*$" title="Le nom ne peut contenir que des  lettres et espaces" class="form-control">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Prenom</label>
    <input type="text" value="{{$c->prenom}}"  name="prenom" required pattern="^[a-zA-ZÀ-ÖØ-öø-ÿ]+[a-zA-Z0-9\sÀ-ÖØ-öø-ÿ]*$" title="Le nom ne peut contenir que des lettres et espaces" class="form-control">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" value="{{$c->email}}" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"    title="Saisir votre adresse email  " class="form-control">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Age</label>
    <input type="number"value="{{$c->age}}"  name="age" min="5" max="35" required pattern="^[0-9]+$" title="Que les chiffres sont acceptés" class="form-control">
  </div>
  
  <label for="form-select">Niveau d'etude</label>
  <select class="form-select" required name="niveauEtude" aria-label="Default select example">
    <option selected>{{$c->niveauEtude}}</option>

    @if ($c->niveauEtude=="Terminal")
    <option value="Licence">Licence</option>
    <option value="Master">Master</option>
    <option value="Doctorat">Doctorat</option>
        
    @endif

    @if ($c->niveauEtude=="Licence")
    <option value="Terminal">Terminal</option>
    <option value="Master">Master</option>
    <option value="Doctorat">Doctorat</option> 
    @endif

    @if ($c->niveauEtude=="Master")

    <option value="Terminal">Terminal</option>
    <option value="Licence">Licence</option>
    <option value="Doctorat">Doctorat</option>
        
    @endif

    @if ($c->niveauEtude=="Doctorat")

    <option value="Terminal">Terminal</option>
    <option value="Licence">Licence</option>
    <option value="Master">Master</option>
        
    @endif

  </select>


  <label for="form-select" class="mt-2">Sexe</label>
  <select class="form-select" required name="sexe" aria-label="Default select example">
    <option selected>{{$c->sexe}}</option>
    @if ($c->sexe=="Homme")
    <option value="Femme">Femme</option>

    @else
    <option value="Homme">Homme</option>
    @endif
  </select>

<div class="row  align-items-center mt-2">
    <div class="col-md-12  text-center">  <button type="submit"  class="btn btn-warning text-white" style="background-color: #2c2b00" >Sauvegarder</button>  </div>

</div>

</form>

@endsection