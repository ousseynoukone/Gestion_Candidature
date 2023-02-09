
 @extends('layout.app')
 @section('content')


 <!-- Button trigger modal -->
<button type="button" hidden id="toggle" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert alert-danger">
        <h5 class="modal-title " id="exampleModalLabel">Confirmez vous la suppression ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body alert alert-warning text-center">
        La supression sera irreversible ! 
      </div>
      <div class="modal-footer">
        <button type="button" id="non" class="btn btn-success alert alert-primary" data-dismiss="modal">Non</button>
        <button type="button" id="oui" class="btn btn-danger alert alert-warning">Oui</button>
      </div>
    </div>
  </div>
</div>
 <div class="container mt-5 ">
    <div class="card">
        
        <a href="{{route('candidats.create')}}"  class="btn btn-dark mt-3 col-md-4">Ajouter un candidat</a>

      <div class="card-header bg-dark text-white text-center mt-2 ">Liste des Candidats</div>
<table class="table  text-dark" style="background-color:#ddc1a0 ">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Email</th>
      <th scope="col">age</th>
      <th scope="col">Niveau d'etude</th>
      <th scope="col">Sexe</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
  @if(count($c)!=0 )
    @foreach ($c as $candidat )
      
   
    <tr>
      
      <th scope="row">{{$candidat->id}}</th>
      <td>{{$candidat->nom}}</td>
      <td>{{$candidat->prenom}}</td>
      <td>{{$candidat->email}}</td>
      <td>{{$candidat->age}}</td>
      <td>{{$candidat->niveauEtude}}</td>
      <td>{{$candidat->sexe}}</td>
      <td>            
        <a class="btn btn-sm" href="{{route('candidats.edit',['candidat'=>$candidat->id])}}">  <img class="mr-3"  src="{{asset('img/edit.png') }}" height="20" alt=" edit img">  </a>

        <form method="POST" action="{{ route('candidats.destroy',['candidat'=>$candidat->id]) }}" accept-charset="UTF-8" style="display:inline">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" onclick="confirmation(event)" class="btn btn-sm" href="" style="background-color:transparent" > <img src="{{asset('img/remove.png') }}" height="20" alt=" remove img"> </button>
        </form>
    </td>

 


    </tr>
    @endforeach
    @else 
    <p class="text-center mt-3">Il n'y a pas de candidat . </p>
    @endif





  </tbody>
</table>

</div>

</div>

@endsection


