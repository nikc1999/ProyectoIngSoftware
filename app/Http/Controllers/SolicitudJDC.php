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
            $carreraIdJefe = Auth::user()->carrera_id;
            if ($request->search == null) { //Cuanto por el buscador se entra vacio
                $listaSolicitudes = collect();
                $usuarios = User::where('carrera_id', $carreraIdJefe)->get();
                foreach ($usuarios as $usuario){
                    $solicitudes = Solicitud::where('user_id', $usuario->id)->get();
                    foreach($solicitudes as $solicitud){
                        $listaSolicitudes->push($solicitud);
                }
            }

            $solicitudes = $listaSolicitudes;

            $solicitudes = $solicitudes->sortBy('updated_at');

            $datos = [
                'solicitudes' => $solicitudes,
                'usuarios' => $usuarios,
            ];

            return view('JefeCarrera.solicitudes')->with('datos', $datos);
            }

            else{ //Cuando el buscador entra con algo
                $listaSolicitudes = collect();
                $solicitud = Solicitud::where('id', $request->search)->first();


                if($solicitud == null){ //Cuando no existe la solicitud ingresada por el buscador

                    $solicitud = null;
                    $user = null;
                    $datos = [
                        'solicitudes' => $solicitud,
                        'usuarios' => $user,
                    ];
                    return view('JefeCarrera.solicitudes')->with('datos', $datos);
                }
                if($solicitud->estado != 'Pendiente'){ //Cuando la solicitud encontrada no es pendiente

                    $solicitud = null;
                    $user = null;
                    $datos = [
                        'solicitudes' => $solicitud,
                        'usuarios' => $user,
                    ];
                    return view('JefeCarrera.solicitudes')->with('datos', $datos);
                }

                $user = User::where('id', $solicitud->user_id)->get(); //Llegado a este punto si se encontró la solicitud

                if($user[0]->carrera_id != $carreraIdJefe){ //Si la solicitud hecha por el usuario no pertenece al jefe de carrera que está logeado
                    $solicitud = null;
                    $user = null;
                    $datos = [
                        'solicitudes' => $solicitud,
                        'usuarios' => $user,
                    ];
                    return view('JefeCarrera.solicitudes')->with('datos', $datos);
                }

                $listaSolicitudes->push($solicitud);

                $solicitud = $listaSolicitudes;

                $datos = [
                'solicitudes' => $solicitud,
                'usuarios' => $user,
            ];
                return view('JefeCarrera.infoEstudiante')->with('datos', $datos);
            }
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hola = "hola";
        dd($hola);
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
