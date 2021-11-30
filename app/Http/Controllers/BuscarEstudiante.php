<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class BuscarEstudiante extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()== null)
        {
            return view('auth.login');
        }
        if(Auth::user()->rol=='Jefe de Carrera')
        {
            //dd(Auth::user()->rol);
            $user = 'hola';
            $rut = '';
            $solicitudes = collect();
            $datos = [
                'estudiante' => $user,
                'solicitudes' => $solicitudes,
            ];
            return view('BuscarEstudiante.index')->with('datos',$datos)->with('rut',$rut);
        }
        return redirect('/home');
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request  $request)
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $rutPedido = $request->rut;
        $user = User::where('rut', $rutPedido)->first();

        if($user == null){ //Aca es cuando lo ingresado por la pagina no existe como rut en el sistema

            $datos = [
                'estudiante' => null,
                'solicitudes' => null,
                'carrera' => null,
            ];
            return view('BuscarEstudiante.index')->with('datos',$datos);
        }

        $carreraIdJefe = Auth::user()->carrera_id;

        $solicitudes = Solicitud::where('user_id', $user->id)->get();
        $solicitudes = $solicitudes->sortBy('updated_at');

        $carrera = Carrera::where('id', $user->carrera_id)->get();

        try{
            $carrera = $carrera[0];
        }
        catch (Exception $e){
            $datos = [
                'estudiante' => null,
                'solicitudes' => null,
                'carrera' => null,
            ];
            return view('BuscarEstudiante.index')->with('datos',$datos);
        }


        $rut = $user->rut;


        if ($user->carrera_id == $carreraIdJefe && $user->rol == 'Estudiante') { //Lo encuentro y es de la carrera

            $datos = [
                'estudiante' => $user,
                'solicitudes' => $solicitudes,
                'carrera' => $carrera,
            ];

            return view('BuscarEstudiante.index')->with('datos',$datos)->with('rut' ,$rut);
        }

        else{ //Lo encuentro y no es de la carrera

            $datos = [
                'estudiante' => null,
                'solicitudes' => null,
                'carrera' => null,
            ];
            return view('BuscarEstudiante.index')->with('datos',$datos);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        if(Auth::user()== null)
        {
            return view('auth.login');
        }
        if(Auth::user()->rol=='Jefe de Carrera')
        {
            //dd($request);
            $solicitudes = Solicitud::where('id', $id)->first();
            $user = User::where('id', $solicitudes->user_id)->get();
            $user = $user[0];

            $carrera = Carrera::where('id', $user->carrera_id)->get();
            $carrera = $carrera[0];

            $listaestudiante = collect();
            $listaestudiante->push($user);
            $listasolicitud = collect();
            $listasolicitud->push($solicitudes);

            $solicitudes = $listasolicitud;
            $user = $listaestudiante;

            $datos = [
                'solicitudes' => $solicitudes,
                'usuarios' => $user,
                'ruta' => 'buscar',
            ];

            return view('JefeCarrera.infoEstudiante')->with('datos', $datos);

        }
        return redirect('/home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
