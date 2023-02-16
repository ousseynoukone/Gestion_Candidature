<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\FormationReferentiel;
use App\Models\Referentiel;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {           

        $f = Formation::all();



        $r = Referentiel::all();

        $tabAll=[
            $f,
            $r
        ];
        

        return view('Formation.crudFormation.crudformation',compact('tabAll'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $f= Formation::create($request->all());
      $fr = new  FormationReferentiel ();
      $fr->formation_id=$f->id ;
      $fr->referentiel_id=$request->referentiel_id ;
      $fr->save();

        toastr()->success('Formation ajouté ! ');

        return redirect()->route('formations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function show( $formation)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function edit( $formation)
    {


        $tabAll = [
            Formation::find($formation),
            Formation::find($formation)->referentiels,
            Referentiel::all()
        ];
        
        return (compact('tabAll')); 


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $formation)
    {
        $c = Formation::find($formation);
        $c->update($request->all());

        toastr()->success('Enregistrement réussi ! ');
  
        return 1;  
    
    }

    public function updateStart( $id)
    {

        $f = Formation::find($id);
        $f1 = Formation::find($id)->referentiels;


         if($f1[0]->validated==0 ) {
            toastr()->error("Echec , veuillez d'abords valider le referentiel de cette formation ! ","Referentiel non validé", [ 'timeOut'=> 10000]);
            return 0 ;
         }else{
            if($f->isStarted==0){
                $f->isStarted = true;
                toastr()->success('Formation demarrée ! ');
    
            }else{
                $f->isStarted = false;
                toastr()->success('Formation cloturée ! ');
            }
    
            $f->save();

         }




     
  
        return 1;
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function destroy( $formation)
    {

        $form = Formation::find($formation);
        $candidat = $form->candidats()->get();
      //  $form->candidats()->delete();
      //  $candidat->each->delete();
        $form->candidats()->detach();     
        $form->delete();


        toastr()->warning('Suppression effectuée !');
        return redirect()->route('formations.index');
    }
}
