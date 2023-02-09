
@extends('layout.app')
@section('content')
                

 <!-- Button trigger modal -->
 <button type="button" hidden id="toggle" class="btn btn-primary" data-toggle="modal" data-target="#suprType">
</button>
<input hidden value="0" id="formationPage" type="text">

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
                <form method="post" id="form0" action="{{route('types.store')}}">
                    @csrf
                    <div class="container col-md-10 mt-5 text-dark" style="background-color:#ddc1a0 ">
                        <div class="card text-white bg-dark mt-2" >
                            <div class="card-header text-center  " >Ajout</div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">libelle</label>
                    <input type="text"  name="libelle" required pattern="^[a-zA-Z]+[a-zA-Z0-9\s]*$"  class="form-control">
                  </div>
                
                <div class="row  align-items-center mt-2 modal-footer">
                    <div class="col-md-12 text-center">  <button type="submit"  class="btn btn-warning text-white" id="addType" style="background-color: #2c2b00">Ajouter</button>  </div>
                  
                
                      </div>
                </form>
            </div>

































         

<div class="row">
            <div class="col-md-6">

                <div class="container mt-5 " >
                    <div class="card" style="background-color:#ddc1a0 ">
                        
        
                      <div class="card-header bg-dark text-white text-center mt-2 ">Liste des types</div>
                <table class="table  text-dark" style="background-color:#ddc1a0 ">
                  <thead>
                    <tr>
                      <th scope="col">Id</th>
                      <th scope="col">Libelle</th>
                      <th scope="col">Action</th>
                
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($c)!=0 )
                    @foreach ($c as $type )
                      
                   
                    <tr>
                      
                      <th scope="row">{{$type->id}}</th>
                      <td>{{$type->libelle}}</td>
                      <td>            
                        <a class="btn btn-sm" onclick="edit({{$type->id}})">  <img onclick="" class="mr-3"  src="{{asset('img/edit.png') }}" height="20" alt=" edit img">  </a>
                
                        <form method="POST" action="{{ route('types.destroy',['type'=>$type->id]) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit"  onclick="confirmation(event)" class="btn btn-sm" href="" style="background-color:transparent" > <img src="{{asset('img/remove.png') }}" height="20" alt=" remove img"> </button>
                        </form>
                    </td>
                
                 
                
                
                    </tr>
                    @endforeach
                    @else 
                    <p class="text-center mt-3">Il n'y a pas de type . </p>
                    @endif
                
                
                
                
                
                  </tbody>
                </table>

                


                
                </div>
                
                </div>
                
                
            </div>





            <div class="col-md-6 mt-5 ">
                <div class="card ">
                <div class="card-header bg-dark text-white text-center">Modification</div>
                <div class="card-body  " style="background-color:#ddc1a0 " >

                <form method="post" id="form1" >
                    @csrf
                    <input hidden id="idTypeToUpdate" type="text">
                
                    <div class="container col-md-10 mt-5 text-dark" style="background-color:#ddc1a0 ">
                        <div class="card text-white bg-dark mt-2" >
                            <div class="card-header text-center ">Mettre-a-jour un type</div>
                  <div class="form-group" >
                    <label for="exampleInputEmail1">Libelle</label>
                    <input type="text" readonly id="libelle" name="libelle" required pattern="^[a-zA-Z]+[a-zA-Z0-9\s]*$"  title="Le libelle ne peut contenir que des  lettres et espaces" class="form-control">
                  </div>

              
                
                <div class="row  align-items-center mt-2">
                    <div class="col-md-12  text-center">  <button id="sauvegarder" type="" onclick="update(id,event)" class="btn btn-warning text-white" style="background-color: #2c2b00" >Sauvegarder</button>  </div>
                
                </div>
                
                </form>

            </div>
            </div>  
        </div>
        </div>


    </div>


  








@endsection