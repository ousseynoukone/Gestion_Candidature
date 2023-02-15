



















  
  
  
    function confirmation(e) {
      e.preventDefault();
      document.getElementById('toggle').click();
      
      document.getElementById("oui").addEventListener("click", function(){
          e.target.closest("form").submit();
      });    
    }
  



  
  //EDIT 
  function edit(id,val) {



    if(val==0)
    {
      url= 'referentiels/'+id+'/edit'

    }
    else if(val==1){
      url= 'formations/'+id+'/edit'

    }
    else{
      url= 'types/'+id+'/edit'

    }

    
    $.ajax({
        url: this.url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          if(val==0)
          {
            document.getElementById("libelle").value=data.c.libelle;
            document.getElementById("horaire").value=data.c.horaire;
            document.getElementById("idTypeToUpdate").value=data.c.id;

          }else if(val==1){
            c=data.tabAll[0]
            f=data.tabAll[1][0]
            refAll=data.tabAll[2]

            document.getElementById("nom").value=c.nom;
            document.getElementById("idTypeToUpdate").value=c.id;
            document.getElementById("description").value=c.id;
            document.getElementById("duree").value=c.duree;
            document.getElementById("dateDebut").value=c.date_debut;

            document.getElementById("referentiel").innerHTML=""

            let option = document.createElement("option");
            option.setAttribute('value', f.id);
            option.setAttribute('selected',"" );
            option.innerText=f.libelle
            document.getElementById("referentiel").appendChild(option);
            refAll.forEach(ref => {
              if(ref.id!=f.id)
              {
                let option = document.createElement("option");
                option.setAttribute('value', ref.id);
                option.innerText=ref.libelle
                document.getElementById("referentiel").appendChild(option);

              }

              
              
            });
            
      
          }
          else{
            document.getElementById("libelle").value=data.c.libelle;
            document.getElementById("idTypeToUpdate").value=data.c.id;
          }

        }
     });
     
    
  }




  if(document.getElementById("formationPage").value!=1)
  {
//check control saisie type
if( document.getElementById("libelle").value==""  )
document.getElementById('sauvegarder').setAttribute("disabled","")
  }

  function update(id,e,val){
    e.preventDefault();
    id = document.getElementById("idTypeToUpdate").value ;

    if(val==0)
    {
      url= 'referentiels/'+id

    }
    else if(val==1){

      url= 'formations/'+id

    }else{

      url= 'types/'+id

    }



    console.log(id)
    $.ajax({
        type:"PUT",
        url: this.url,
        data: $('#form1').serialize(),
        success: function(data){
            console.log(data);

            if(val==0){
              window.location.href='/referentiels'


            }
            else if(val==1){
              window.location.href='/formations'

            }else{
              window.location.href='/types'

            }

        },
        error: function(){
            console.log("Error updating");
            
        }
    });
} 

if(document.getElementById("formationPage").value!=1)
{
//Controle de saisie Type
document.getElementById("libelle").addEventListener("click", function() {
    if(document.getElementById("libelle").value!="")
    {
        document.getElementById("libelle").removeAttribute("readonly")
        document.getElementById('sauvegarder').removeAttribute("disabled")

    }


})
  
  
document.getElementById("libelle").addEventListener("input", function() {

  var input = this.value;
  var regex = /^[a-zA-Z]+[a-zA-Z0-9\s]*$/;
  if (!regex.test(input)) {
    this.value = input.substr(0, input.length - 1);
  }

    
  if(document.getElementById("libelle").value=="")
  {
      document.getElementById('sauvegarder').setAttribute("disabled","")

  }else{
    document.getElementById('sauvegarder').removeAttribute("disabled")


  }



  });

  
  
  



//Controle de saisie referentiel

document.getElementById("horaire").addEventListener("click", function() {
  if(document.getElementById("horaire").value!="")
  {
      document.getElementById("horaire").removeAttribute("readonly")
      document.getElementById('sauvegarder').removeAttribute("disabled")

  }


})



document.getElementById("horaire").addEventListener("input", function() {
  var input = this.value;
  var regex = /^\d+$/;

  console.log(input)
  if (!regex.test(input)) {
    this.value = input.substr(0, input.length - 1);
  }
  

  
if(document.getElementById("horaire").value=="")
{
    document.getElementById('sauvegarder').setAttribute("disabled","")

}else{
  document.getElementById('sauvegarder').removeAttribute("disabled")


}



});

}
  
//Controle de saisie formation


if(document.getElementById("formationPage").value==1)
{

nom=document.getElementById("nom")

duree=document.getElementById("duree")
btnEnregistrer=document.getElementById("sauvegarder")
description=document.getElementById("description")
referentiel=document.getElementById("referentiel")
hide=document.getElementById("hide")






const editBtn = document.querySelectorAll(".editbtn");



for (let i = 0; i < editBtn.length; i++) {
  editBtn[i].addEventListener("click", function() {

    hide.removeAttribute("hidden")

  });
}










const elements = document.querySelectorAll(".control");

for (let i = 0; i < elements.length; i++) {
  elements[i].addEventListener("input", function() {
    if(elements[i].value=="")
    {
      btnEnregistrer.setAttribute("disabled","")
    }else{

      btnEnregistrer.removeAttribute("disabled")
    }

    var input = this.value;
    var regex = /^[a-zA-Z]+[a-zA-Z0-9\s]*$/;
    if (!regex.test(input)) {
      this.value = input.substr(0, input.length - 1);
    }


  });
}








}

