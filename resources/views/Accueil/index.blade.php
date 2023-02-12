@extends('layout.app')
@section('content1')


<div class="main-container  d-flex">
  <div class="sidebar" id="sidebar">

    <div class="header-box">
      <h4 class="fs-4" > <span style="background-color:#ddc1a0 " class=" text-dark rounded shadow px-2 me-2">OK</span><span  class="text-white h4"> Ousseynou Kone</span>  </h4>
    </div>

    <div class="row">
      <div class="col-12 mt-4">
        <div class="list-group" id="list-tab" role="tablist">
          <a  class="list-group-item list-group-item-action active" id="list-home" onclick="load0()"  data-toggle="list" href="#list-home" role="tab" aria-controls="home">Former les formations</a>
          <a class="list-group-item list-group-item-action" id="list-profile" onclick="load1()" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Valider les formations</a>
          <a class="list-group-item list-group-item-action" id="list-messages" onclick="load2()" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Statistiques</a>
        </div>
      </div>

    </div>  

    <hr class="h-color mx-3">
  </div>

    <div class="container mt-5" id="addFormation"    >


      @if(count($tabAll['candidats'])!=0)
<div class="card-header bg-white  text-center">Liste des Candidats</div>
<table class="table table-dark">
  <thead>
        <tr>
          <th scope="col">#Id</th>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($tabAll['candidats'] as $c )
          
        <tr>
          <td>{{$c->id}}</td>
          <td>{{$c->nom}}</td>
          <td>{{$c->prenom}}</td>
          <td>                        
            <a class="btn text-white bg-dark"    onclick="ajoutFormation({{$c->id}})">   Ajouter a une formation  </a>      
          </td>
        </tr>

        @endforeach

      </tbody>
    </table>
@else
<h4 class="card-header bg-white text-center">Il n'y a pas de candidat</h4>
@endif


     
</div>
<div class="container ml-4"   hidden id="parametrerFormation">
@if(count($tabAll['formations']) !=0)
@foreach ($tabAll['formations'] as $index=> $formation    )


    <div class="card mt-5">

      
          <h4 class="card-header text-center">Formation N°{{$index+1}}</h4>
                <div class="card-body">
                  <table class="table table-dark">
                    <thead>
                      <tr>
                        <th scope="col">#Id</th>
                        <th scope="col">Nom de la formation</th>
                        <th scope="col">Etat</th>
                        <th scope="col">Demarer la formation</th>
                      </tr>
                    </thead>
                    <tbody>

                      <tr>
                        <td>{{$formation->id}}</td>
                        <td>{{$formation->nom}}</td>
                        @if($formation->isStarted==0)

                        <td>En attente</td>

                        @else
                        <td>En cours...</td>
                        @endif
                        <td>
                          @if (count($formation->candidats)!=0)
                          <div class="form-check">
                            <input class="btn btn-secondary" value="Démarrer ou arreter la formation" onclick="updateForm({{$formation->id}})" class="form-check-input" type="button" value="" >
                 
                          </div>
                          @else
                          <div class="form">
                            <h6 class=" text-center">Impossible de démarrer une formation sans candidats</h6>
  
                          </div>
                          @endif
                      
                      </td>
                       
                      </tr>


                    </tbody>
                  </table>

                </div>




                <div class="card-header">Referentiel</div>
                <div class="card-body">
                  <table class="table table-dark">
                    <thead>
                      <tr>
                        <th scope="col">#Id</th>
                        <th scope="col">Libelle du referentiel</th>
                        <th scope="col">Validation</th>
                        <th scope="col">Valider le referentiel</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($formation->referentiels as $referentiel)
                      <tr>
                        <td>{{$referentiel->id}}</td>
                        <td>{{$referentiel->libelle}}</td>
                        <td>
                          @if ($referentiel->validated)
                            Validé <img height="20px" src="{{asset('img/succes.png') }}" alt="">
                            <td>
                              <div class="form-check">
                                <input class="form-check-input" onclick="updateRef({{$referentiel->id}})" type="radio"  type="radio" checked="checked" disabled name="flexRadioDefault" >
                                <label class="form-check-label" >
                                  Valider 
                                </label>
                              </div>
                            </td>
                          @else
                            Non Validé <img height="20px" src="{{asset('img/remove.png') }}" alt="">

                            <td>
                              <div class="form-check">
                                <input class="form-check-input " onclick="updateRef({{$referentiel->id}})" type="radio" name="flexRadioDefault" >
                                <label class="form-check-label" >
                                  Valider
                                </label>
                              </div>
                            </td>
                          @endif
                        </td>

                        


                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>





          <div class="card-header">Type</div>
                <div class="card-body col-md-6">


                  <table class="table table-dark ">
                    <thead>
                      <tr>
                        <th scope="col">#Id</th>
                        <th scope="col">Libelle du type</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($formation->referentiels as $referentiels)
                      <tr>
                        <td>{{$referentiels->types->id}}</td>
                        <td>{{$referentiels->types->libelle}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>




          <div class="card-header">Candidat(s) de la formation</div>
                <div class="card-body">

                  <table class="table table-dark">
                    <thead>
                      <tr>
                        <th scope="col">#Id</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Niveau</th>
                        <th scope="col">Email</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($formation->candidats as $candidat)
                      <tr>
                        <td>{{$candidat->id}}</td>
                        <td>{{$candidat->nom}}</td>
                        <td>{{$candidat->prenom}}</td>
                        <td>{{$candidat->niveauEtude}}</td>
                        <td>{{$candidat->email}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>




</div>
@endforeach
@else
<h4 class="card-header mt-5 mr-5 bg-white text-center">Il n'y a pas de formation</h4>
@endif
</div>
<!-- Statistiques nombres -->


<div class="container ml-5 mt-5 " style="  overflow: scroll; height:300px;" hidden id="stats">
<div class="card">

  @if(count($tabAll['formations'])==0)
  <h5 class="card-header">Il n'y a pas de formations</h5>
  @else
  <h5 class="card-header">Statistiques</h5>

  @foreach ($tabAll['formations'] as $index=> $formation    )


  <div class="card mt-5">

    
              <div class="card-body">
                <h4 class="card-header text-center">Formation N°{{$index+1}}</h4>

                <table class="table table-dark">
                  <thead>
                    <tr>
                      <th scope="col">#Id</th>
                      <th scope="col">Nom de la formation</th>
                      <th scope="col">Etat</th>
                      <th scope="col">Demarer la formation</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td>{{$formation->id}}</td>
                      <td>{{$formation->nom}}</td>
                      @if($formation->isStarted==0)

                      <td>En attente</td>

                      @else
                      <td>En cours...</td>
                      @endif
                      <td>
                        @if (count($formation->candidats)!=0)
                        <div class="form-check">
                          <input class="btn btn-secondary" value="Démarrer ou arreter la formation" onclick="updateForm({{$formation->id}})" class="form-check-input" type="button" value="" >
               
                        </div>
                        @else
                        <div class="form">
                          <h6 class=" text-center">Impossible de démarrer une formation sans candidats</h6>

                        </div>
                        @endif
                    
                    </td>
                     
                    </tr>


                  </tbody>
                </table>

              </div>
@if (count($formation->candidats)!=0)
  

              @foreach ($formation->candidats as $index =>$candidat)
              <?php
               $val = $index+1 
                 ?>

              @endforeach
  @else 

  <?php 
    $val = 0 ;

  ?>


  @endif


    <div class="row">
        <div class="ml-4 form-control col-md-4">Nombre de candidats de la formation : </div>
          <div class="ml-2">
            <input type="number" readonly value="{{$val}}" class="form-control" id="nmbrParFormation" placeholder="Password">
          </div>
    </div>

</div>
@endforeach




@foreach ($tabAll['referentiels'] as $index=> $referentiel    )

<div class="card mt-5">

  
            <div class="card-body">
              <h4 class="card-header text-center">Réferentiel N°{{$index+1}}</h4>

              <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Nom de la referentiel</th>
                    <th scope="col">Validation</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <tr>
                    <td>{{$referentiel->id}}</td>
                    <td>{{$referentiel->libelle}}</td>
                    @if($referentiel->validated)

                    <td>Oui</td>

                    @else
                    <td>Non</td>
                    @endif

                   
                  </tr>


                </tbody>
              </table>

            </div>
      
@if (count($referentiel->formations)!=0)

@foreach ($referentiel->formations as $index => $formation)

            <?php 

            $val = $index+1;

            
            ?>
                
@endforeach

@else

<?php 
$val = 0 ;

?>


@endif



  <div class="row">
      <div class="ml-4 form-control col-md-4">Nombre de  formation du referentiel  : </div>
        <div class="ml-2">
          <input type="number" readonly value="{{$val}}" class="form-control" id="nmbrParFormation" placeholder="Password">
        </div>
  </div>

</div>
@endforeach













@endif
</div>

</div>

    </div>
















<!-- Button trigger modal -->
<button type="button" id="btnModal" hidden class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
</button>

<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">

    <form method="post" action="{{route('fcs.store')}}">
      @csrf
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-white" id="exampleModalLabel">Ajouter a une formation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body text-white">


        <input type="text" name="candidat_id" hidden id="candidatID"  >
        <label for="form-group">Choisir une formation</label>
        <select class="form-select form-group" id="formation" name="formation_id" required>
          <option value="" selected>Choisir une Formation</option>



        </select>

      </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-success">Sauvegarder</button>
      </div>
    </div>
  </form>
  </div>
</div>
















<script src="{{ asset('build/assets/jquery-3.6.0.js') }}"></script>

<script>



function updateForm(id){
  $.ajax({
        type:"GET",
        url: "formations/update/"+id,

        success: function(data){
          window.location.replace("/");

        }
      })

}

function updateRef(id){

  $.ajax({
        type:"GET",
        url: "referentiels/update/"+id,

        success: function(data){
          window.location.replace("/");

        }
      })

}




function updateForm(id){
  $.ajax({
        type:"GET",
        url: "formations/update/"+id,

        success: function(data){
          window.location.replace("/");

        }
      })

}



 function load0(){
  document.getElementById("addFormation").removeAttribute("hidden")
  document.getElementById("parametrerFormation").setAttribute("hidden","")
  document.getElementById("stats").setAttribute("hidden","")
  

 }







 function load1(){
  
  document.getElementById("parametrerFormation").removeAttribute("hidden")
  console.log(document.getElementById("parametrerFormation").removeAttribute("hidden"))

  document.getElementById("addFormation").setAttribute("hidden","")
  document.getElementById("stats").setAttribute("hidden","")

 }

 function load2(){
  document.getElementById("stats").removeAttribute("hidden")

  document.getElementById("addFormation").setAttribute("hidden","")
  document.getElementById("parametrerFormation").setAttribute("hidden","")


 }



 function ajoutFormation(id){

  var form 
  var allForm

document.getElementById("btnModal").click()
document.getElementById("candidatID").value=id
$.ajax({
  url: "fcs/" + id,
  type: 'GET',
  dataType: 'json',
  success: function(data1) {
    document.getElementById("formation").innerText=""
    document.getElementById("formation").innerHTML='<option value="" selected>Choisir une Formation</option>'

    $.ajax({
      url: "fcs/create",
      type: 'GET',
      dataType: 'json',
      success: function(data2) {
        let tableau1 = data1;
        let tableau2 = data2;
        let resultat = tableau2.filter(function(obj2) {
          return !tableau1.some(function(obj1) {
            return obj1.id === obj2.id;
            
          });
        });


        console.log(resultat);
                  resultat.forEach(f => {

          let option = document.createElement("option");
          option.setAttribute('value', f.id);
          option.innerText=f.nom
          document.getElementById("formation").appendChild(option);
          })
      }
    });
  }
});


  



}




</script>


@endsection