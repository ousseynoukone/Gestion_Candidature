<?php

namespace App\Http\Controllers;

use App\Models\Referentiel;
use App\Models\Type;
use Illuminate\Http\Request;

class ReferentielController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c = Referentiel::all();

        $t = Type::all();

        $tabAll=[
            $c,
            $t
        ];
        

        return view('Formation.curdReferentiel.crudreferentiel',compact('tabAll'));  
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('referentiels.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Referentiel::create($request->all());
        toastr()->success('Referentiel ajouté ! ');

        return redirect()->route('referentiels.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Referentiel  $referentiel
     * @return \Illuminate\Http\Response
     */
    public function show(Referentiel $referentiel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Referentiel  $referentiel
     * @return \Illuminate\Http\Response
     */
    public function edit( $referentiel)
    {
        $c =  Referentiel::find($referentiel);

        return (compact('c'));    
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Referentiel  $referentiel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $referentiel)
    {
        $c = Referentiel::find($referentiel);
        $c->update($request->all());

        toastr()->success('Enregistrement réussi ! ');
  
        return 1;  
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Referentiel  $referentiel
     * @return \Illuminate\Http\Response
     */
    public function destroy( $referentiel)
    {
        Referentiel::destroy($referentiel);

        toastr()->warning('Suppression effectuée !');
        return redirect()->route('referentiels.index');


    }
}
