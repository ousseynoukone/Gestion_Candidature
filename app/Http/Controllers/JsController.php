<?php

namespace App\Http\Controllers;
use App\Models\Candidat;
use App\Models\Formation;
use App\Models\FormationCandidat;
use App\Models\Referentiel;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class JsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

                    $types = Type::with(['referentiels.formations'])->get();

                    $counts = [];
                    foreach ($types as $type) {
                        $count = 0;

                        foreach ($type->referentiels as $referentiel) {
                            $count += $referentiel->formations->count();
                        }
                        $counts[] = [
                            'libelle' => $type->libelle,
                            'count' => $count,
                        ];
                    }
         

        return( [
            'formations'=>Formation::all(),
            'types'=>$counts,
            'candidats' =>User::all(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id , $user_id)
    {
        $f = Formation::find($id);
        $u = User::find($user_id);
        $u->formations()->attach($f->id);

        return 1 ;


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
