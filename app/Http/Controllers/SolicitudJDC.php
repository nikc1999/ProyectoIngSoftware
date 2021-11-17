<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class SolicitudJDC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()== null)
        {
            return view('auth.login');
        }
        if(Auth::user()->rol=='Jefe de Carrera')
        {
            $listaSolicitudes = collect();
            $solicitud = Solicitud::where('id', $request->search)->first();
            $user = User::where('id', $solicitud->user_id)->first();

            $listaSolicitudes->push($solicitud);

            $solicitud = $listaSolicitudes;

            $datos = [
                'solicitudes' => $solicitud,
                'usuarios' => $user,
            ];

            return view('JefeCarrera.solicitudes')->with('datos', $datos);

        }

        return redirect('/home');
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
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $Solicitud)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $Solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $Solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $Solicitud)
    {
        //
    }
}
