
@extends('layout.app')
@section('content')
                

 <!-- Button trigger modal -->
 <button type="button" hidden id="toggle" class="btn btn-primary" data-toggle="modal" data-target="#suprType">
</button>
<input hidden value="1" id="formationPage" type="text">

<!-- Modal -->
<div class="modal fade" id="suprType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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




        <div class="row">


  

            <div class="col-md-12">
                <form method="post" id="form0" action="{{route('formations.store')}}">
                    @csrf
                    <div class="container col-md-10 mt-5 text-dark" style="background-color:#ddc1a0 ">
                        <div class="card text-white bg-dark mt-2" >
                            <div class="card-header text-center  " >Ajouter une formation</div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Nom </label>
                    <input type="text"  name="nom" required pattern="^[a-zA-ZÀ-ÖØ-öø-ÿ]+[a-zA-Z0-9\sÀ-ÖØ-öø-ÿ]*$"  class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Duree </label>
                    <input type="number"  step="0.01" min="1" step="0.01"  name="duree" required  class="form-control">
                  </div>
        
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Description </label>
                    <input type="text"  name="description" required pattern="^[a-zA-ZÀ-ÖØ-öø-ÿ]+[a-zA-Z0-9\sÀ-ÖØ-öø-ÿ]*$"  class="form-control">
                  </div>

                  <label for="exampleInputEmail1">Referentiel</label>
                  <select class="form-select form-group" id="" name="referentiel_id" required>
                    <option value="" selected>Choisir un Referentiel</option>

                    @foreach ($tabAll[1] as $ref )

                    <option value="{{$ref->id}}">{{$ref->libelle}}</option>

                      
                    @endforeach


                  </select>

                  <div class="form-group">
                    <label for="exampleInputEmail1"> Date de debut </label>
                    <input type="datetime-local"  name="date_debut" required class="form-control">
                  </div>
        
        

                <div class="row  align-items-center mt-2 modal-footer">
                    <div class="col-md-12 text-center">  <button type="submit"  class="btn btn-warning text-white" id="addformation" style="background-color: #2c2b00">Ajouter</button>  </div>
                  
                
                      </div>
                </form>
            </div>

































         

<div class="row">
            <div class="col-md-12">

                <div class="container mt-5 " >
                    <div class="card" style="background-color:#ddc1a0 ">
                        
        
                      <div class="card-header bg-dark text-white text-center mt-2 ">Liste des formations</div>
                <table class="table  text-dark" style="background-color:#ddc1a0 ">
                  <thead>
                    <tr>
                      <th scope="col">Id</th>
                      <th scope="col">Nom</th>
                      <th scope="col">Durée</th>
                      <th scope="col">Description</th>

                      <th scope="col">Etat</th>

                      <th scope="col">Date de debut</th>
                      <th scope="col">Action</th>
                
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($tabAll[0])!=0 )
                    @foreach ($tabAll[0] as $formation )
                      
                   
                    <tr>
                      
                      <th scope="row">{{$formation->id}}</th>
                      <td>{{$formation->nom}}</td>
                      <td>{{$formation->duree}} h</td>
                      <td>{{$formation->description}}</td>

                      @if($formation->isStarted==0)
                      <td>En attente</td>
                      @else
                      <td>En cours</td>
                      @endif

                      <td>{{$formation->date_debut}}</td>
                      <td>            
                        <a class="btn btn-sm editbtn"  href="#divEdit" onclick="edit({{$formation->id}},1)">  <img  class="mr-3"  src="{{asset('img/edit.png') }}" height="20" alt=" edit img">  </a>
                
                        <form method="POST" action="{{ route('formations.destroy',['formation'=>$formation->id]) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button formation="submit"  onclick="confirmation(event)" class="btn btn-sm" href="" style="background-color:transparent" > <img src="{{asset('img/remove.png') }}" height="20" alt=" remove img"> </button>
                        </form>
                    </td>
                
                 
                
                
                    </tr>
                    @endforeach
                    @else 
                    <p class="text-center mt-3">Il n'y a pas de formation . </p>
                    @endif
                
                
                
                
                
                  </tbody>
                </table>

                


                
                </div>
                
                </div>
                
                
            </div>





            <div class="col-md-12 mt-3 ">
                <div class="card ">
                <div id="divEdit" class="card-header bg-dark text-white text-center">Modification</div>
                <div class="card-body  " style="background-color:#ddc1a0 " >

                <form method="post" id="form1" >
                    @csrf
                    <input hidden id="idTypeToUpdate" type="text">
                
                    <div class="container col-md-10 mt-5 text-dark" style="background-color:#ddc1a0 ">
                        <div id="hide" hidden class="card text-white bg-dark mt-2" >
                            <div class="card-header text-center ">Mettre-a-jour une formation</div>


                  <div class="form-group" >
                    <label for="exampleInputEmail1">Nom</label>
                    <input type="text"   id="nom" name="nom" required pattern="^[a-zA-ZÀ-ÖØ-öø-ÿ]+[a-zA-Z0-9\sÀ-ÖØ-öø-ÿ]*$"   class="form-control control">
                  </div>

                  <div class="form-group" >
                    <label for="exampleInputEmail1">Durée</label>
                    <input type="number"   step="0.01" min="1" step="0.01" id="duree"  name="duree" required  class="form-control">
                  </div>




                  <div class="form-group">
                    <label for="exampleInputEmail1"> Description </label>
                    <input type="text"  id="description" name="description" required pattern="^[a-zA-ZÀ-ÖØ-öø-ÿ]+[a-zA-Z0-9\sÀ-ÖØ-öø-ÿ]*$"  class="form-control control">
                  </div>

                  <label for="exampleInputEmail1">Referentiel</label>
                  <select  class="form-select form-group " id="referentiel" name="referentiel_id" required>

                  </select>

                  <div class="form-group">
                    <label for="exampleInputEmail1"> Date de debut </label>
                    <input type="datetime-local"  id="dateDebut" name="date_debut" required  class="form-control ">
                  </div>
                
                <div class="row  align-items-center mt-2">
                    <div class="col-md-12  text-center">  <button id="sauvegarder"  type="" onclick="update(id,event,1)" class="btn btn-warning text-white" style="background-color: #2c2b00" >Sauvegarder</button>  </div>
                
                </div>
                
                </form>

            </div>
            </div>  
        </div>
        </div>


    </div>


  








@endsection