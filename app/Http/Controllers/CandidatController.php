<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c = Candidat::all();

     //   Alert::alert('Sucess', 'Candidat ajouté ! ');

        return view('Candidat.crudCandidat.candidats',compact('c') );


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
        return view('Candidat.crudCandidat.createcandidat');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

  
            Candidat::create($request->all());

        

        return redirect()->route('candidats.create');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function show(Candidat $candidat)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function edit($candidat)
    {  
        $c = Candidat::find($candidat);        

        return view('Candidat.crudCandidat.candidatsedit',compact('c'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function update($candidat , Request $request)
    {
      $c = Candidat::find($candidat);

      $c->update($request->all());

      toastr()->success('Enregistrement réussi ! ');

     return redirect()->route('candidats.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function destroy($candidat)
    {


    Candidat::destroy($candidat);
    toastr()->warning('Suppression effectuée !');

    return redirect()->route('candidats.index');



      

    }
}
