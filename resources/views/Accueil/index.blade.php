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


<div class="card-header bg-white  text-center">Liste des etudiants</div>
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

  


     
</div>
<div class="container ml-4"   hidden id="parametrerFormation">

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
                          
                          <div class="form-check">
                            <input onclick="updateForm({{$formation->id}})" class="form-check-input" type="checkbox" value="" >
                            <label class="form-check-label" for="">
                              Démarrer ou arreter la formation
                            </label>
                          </div>
                      
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
                                <input class="form-check-input" onclick="updateRef({{$referentiel->id}})" type="radio" checked disabled name="flexRadioDefault" >
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

  console.log("hihi")
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
  

 }







 function load1(){
  
  document.getElementById("parametrerFormation").removeAttribute("hidden")
  console.log(document.getElementById("parametrerFormation").removeAttribute("hidden"))

  document.getElementById("addFormation").setAttribute("hidden","")

 }

 function load2(){
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