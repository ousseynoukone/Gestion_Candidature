@extends('layout.app')
@section('content1')


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








<div class="main-container  d-flex">
  <div class="sidebar" id="sidebar">

    <?php 
    $check = 0 ;
    if (Auth::check()) {
      $nom = Auth::user()->nom;
      $prenom = Auth::user()->prenom;
      $user_id = Auth::user()->id;
      $role = Auth::user()->role;
    } 
    ?>

    <input hidden value="{{$role}}"  id="role" type="text">

    <div class="header-box">
      <h4 class="fs-4" >  <span style="background-color:#ddc1a0" class=" text-dark rounded shadow px-2 me-2 ">Bienvenue</span> <br><br><span  class="text-white h5 " style="padding-top: 10em"> {{$prenom.' '.$nom}}</span>  </h4>
      <hr style="background-color: white ; ">

    </div>
@if ($role==1)
  

    <div class="row">
      <div class="col-12 mt-1">
        <div class="list-group" id="list-tab" role="tablist">
          <a  class="list-group-item list-group-item-action active" id="list-home" onclick="load0()"  data-toggle="list" href="#list-home" role="tab" aria-controls="home">Les candidats</a>
          <a class="list-group-item list-group-item-action" id="list-profile" onclick="load1()" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Valider les formations</a>
          <a class="list-group-item list-group-item-action" id="list-messages" onclick="load2()" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Statistiques</a>
        </div>
      </div>

    </div>  

  </div>

    <div class="container mt-5" id="addFormation"    >
      <div class="card-header bg-white text-center">Liste des candidats</div>
      <table class="table  text-dark" style="background-color:#ddc1a0 ">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom </th>
            <th scope="col">Prenom</th>
            <th scope="col">Email</th>
            <th scope="col">age</th>
            <th scope="col">Niveau d'etude</th>
            <th scope="col">Sexe</th>
            <th scope="col">Action</th>
      
          </tr>
        </thead>
        <tbody>
        @if(count($tabAll['users'])>1 )
          @foreach ($tabAll['users'] as $candidat )
            
         @if($candidat->role!=1)
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
          @endif
          @endforeach
          @else 
          <p class="text-center mt-3 bg-warning ">Il n'y a pas de candidat . </p>
          @endif
      
      
      
      
      
        </tbody>
      </table>
     
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
                          @if (count($formation->users)!=0)
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
                      @foreach ($formation->users as $candidat)
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


<div class="container ml-5 mt-5 " hidden id="stats" >
<div class="card" style="  overflow: scroll; height:300px;" >

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
                        @if (count($formation->users)!=0)
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
@if (count($formation->users)!=0)
  

              @foreach ($formation->users as $index =>$candidat)
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

<div class="card mt-5">
  <div>
    <h3 class="card-header text-center ">Graphiques</h3>
    <div class="card-body col-md-10  ">
      <h5 class="card-header ">Repartition total  des candidats par sexe</h5>

      <canvas id="graphique1" role="img" aria-label="chart"></canvas>

    </div>

    <div class="card-body col-md-10  ">
      <h5 class="card-header">Repartition   des formations par Type</h5>

      <canvas id="graphique2" role="img" aria-label="chart"></canvas>

    </div>


    <div class="card-body col-md-10  ">
      <h5 class="card-header">Graphe representant les tranches d'ages</h5>

      <canvas id="graphique3" role="img" aria-label="chart"></canvas>

    </div>

    <div class="card-body col-md-10  ">
      <h5 class="card-header">Graphe representant le statistique des formations (en cours, en attente)</h5>

      <canvas id="graphique4" role="img" aria-label="chart"></canvas>

    </div>
     </div>
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
<script src="{{ asset('build/assets/chart.min.js') }}"></script>

<script>


//Mettre a jour la champs isStarted de formation
function updateForm(id){
  $.ajax({
        type:"GET",
        url: "formations/update/"+id,

        success: function(data){
          window.location.replace("/fcs");

        }
      })

}

//mettre a jour le champs Validated de referentiel
function updateRef(id){

  $.ajax({
        type:"GET",
        url: "referentiels/update/"+id,

        success: function(data){
          window.location.replace("/fcs");

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

//Graphiques
$.ajax({
      url: "jscontroller",
      type: 'GET',
      dataType: 'json',

      success: function(data) {

        graphique(data)


      }
      
      
    })



//Les fonctuions pour les differents graphiques 
function graphique(data) {

  const charBar = document.getElementById("graphique1");
  const charBar2 = document.getElementById("graphique2");
  const charBar3 = document.getElementById("graphique3");
  const charBar4 = document.getElementById("graphique4");
  //const role =  document.getElementById("role").value

   candidat = data['candidats']
//enlever l'admin
 candidat = candidat.filter(c => c.role !== 1);






  const formationParType = data['types']
  const formation = data['formations']

  //pour graphe 4
  FormationEnCours = 0 
  FormationEnAttente = 0
  formation.forEach(f => {
    if(f.isStarted)
    {
      FormationEnCours+=1
    }else{
      FormationEnAttente+=1
    }
    
  });
  tabStatFormation=[
    FormationEnCours,
    FormationEnAttente
  ]






  EnfantArray = []
  AdolescentsArray = []
  AdultesArray = []
  AinesArray = []

candidat.forEach(c => {
  if(c.age>=0 && c.age <= 14)
  EnfantArray.push(c.age)
  else if(c.age>=15 && c.age <= 24)
  AdolescentsArray.push(c.age)
  else if(c.age>=25 && c.age <= 64)
  AdultesArray.push(c.age)
  else
  AinesArray.push(c.age)  
   
});

var trancheAgeData  = [
  {
    "libelle"  : "Enfants",
    "age" : EnfantArray
  },
  
  {
    "libelle"  : "Adolescents",
    "age" : AdolescentsArray
  },

  {
    "libelle"  : "Adultes",
    "age" : AdultesArray
  }

]




  let nmbrSexeHomme = 0
  let nmbrSexeFemme  = 0

  let tabType = []
  let tabNombre
  candidat.forEach(f => {

    if(f.sexe=="Homme")
      nmbrSexeHomme+=1
    else  
      nmbrSexeFemme+=1
    
  });




//conf 1

datas = {
      labels  : ["Homme" , "Femme"],
      datasets:[{
          label: 'Repartition par sexe',

          data : [nmbrSexeHomme,nmbrSexeFemme],
          backgroundColor : [
            "red  ",
            "blue",
          ]
      }]  
    }

  options =  {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
}





//charts 1

  if (charBar) {
  const chart = new Chart(charBar,{
    type : "bar",
    data: datas,
    options: options,
  });
}


//charts 2


if (charBar2) {
  //couleur en fonction du nombre de types
  const couleur = formationParType.map(() => {
  const r = Math.floor(Math.random() * 256);
  const g = Math.floor(Math.random() * 256);
  const b = Math.floor(Math.random() * 256);
  return `rgb(${r}, ${g}, ${b})`;
})



  const chart = new Chart(charBar2,{
    type: 'bar',
  data: {
    labels: formationParType.map(type => type['libelle']),
    datasets: [{
      label: 'Nombre de formation',
      data: formationParType.map(type => type.count),
      backgroundColor: couleur
    }]
  },
  options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
  }
  });
}

//chart 3
if (charBar3) {
  //couleur en fonction du nombre de types
  const couleur = trancheAgeData.map(() => {
  const r = Math.floor(Math.random() * 256);
  const g = Math.floor(Math.random() * 256);
  const b = Math.floor(Math.random() * 256);
  return `rgb(${r}, ${g}, ${b})`;
})

  const chart = new Chart(charBar3,{
    type: 'pie',
  data: {
    labels: trancheAgeData.map(tr => tr.libelle),
    datasets: [{
      label: "Tranche d'age",
      data:trancheAgeData.map(tr=>tr.age.length) ,
      backgroundColor: couleur
    }]
  },
  options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
  }
  });
}


//charts 4
if (charBar4) {
  const chart = new Chart(charBar4,{
    type: 'bar',
  data: {
    labels: ['En cours' , 'En attente'],
    datasets: [{
      label: 'Formation',
      data:tabStatFormation ,
      backgroundColor:[
        'red',
        'purple'
      ],
    }]
  },
  options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
  }
  });
}

}





</script>



@else
</div>
</div>

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
    @if(count($tabAll['formations'])!=0 )
      @foreach ($tabAll['formations'] as $formation )
        
     
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
        
          @foreach ($formation->users as $u )
          @if ($u->id==$user_id)
           <?php $check=1 ; ?>
           @endif
           @endforeach           
          @if ($check==0)
          <a class="btn btn-sm text-white btn-danger"  onclick="choisir({{$formation->id}},{{$user_id}})"> Choisir </a>
          
          @else         
           <a class="btn btn-sm text-white btn-danger" > Formation deja choisie !   </a>
           <?php   
                $check = 0;
           
           ?>
           @endif

            

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
<script>
  function choisir(id,user_id) {

    $.ajax({
  url: "jscontroller/" + id+"/"+user_id,
  type: 'get',
  dataType: 'json',
  success: function(data) {
alert('Formation intégrée ! ')
window.location.replace("/fcs");

  }


    })
    
  }
</script>
@endif

@endsection