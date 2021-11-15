<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //Importante para que reconozca el auth

class SolicitudController extends Controller
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
        if(Auth::user()->rol=='Estudiante')
        {
            $solicitudes = Auth::user()->solicitudes;
            return view('solicitud.index')->with('solicitudes', $solicitudes);
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
        if(Auth::user()== null)
        {
            return view('auth.login');
        }
        if(Auth::user()->rol=='Estudiante')
        {
            return view('solicitud.create'); //lo que se envía como $carreras el html lo reconoce como 'carrera'
        }
        return redirect('/home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch ($request->tipo) {
            case 'Sobrecupo':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','int','required'],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
                    'detalle' => ['required']
                ]);
                //no se que hace esto U///w///U
                // $findUser = User::find($request->user);

                // $findUser->solicitudes()->attach($request->tipo, [
                //     'telefono' => $request->telefono,
                //     'NRC' => $request->nrc,
                //     'nombre_asignatura' => $request->nombre,
                //     'detalles' => $request->detalle
                // ]);
                Solicitud::create([
                    'telefono' => $request->telefono,
                    'tipo' => $request->tipo,
                    'nombre_asignatura' => $request->nombre,
                    'NRC' =>$request->nrc,
                    'detalles_estudiante' => $request->detalle,
                    'user_id' => $request->user,
                ]);
                return redirect('/solicitud');
                break;

            case 'Cambio paralelo':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','int','required'],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
                    'detalle' => ['required']
                ]);

                Solicitud::create([
                    'telefono' => $request->telefono,
                    'tipo' => $request->tipo,
                    'nombre_asignatura' => $request->nombre,
                    'NRC' =>$request->nrc,
                    'detalles_estudiante' => $request->detalle,
                    'user_id' => $request->user,
                ]);
                return redirect('/solicitud');
                break;



            case 'Eliminacion asignatura':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','int','required'],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
                    'detalle' => ['required']
                ]);

                Solicitud::create([
                    'telefono' => $request->telefono,
                    'tipo' => $request->tipo,
                    'nombre_asignatura' => $request->nombre,
                    'NRC' =>$request->nrc,
                    'detalles_estudiante' => $request->detalle,
                    'user_id' => $request->user,
                ]);
                return redirect('/solicitud');
                break;

            case 'Inscripcion asignatura':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','int','required'],
                    'nrc' => ['required'],
                    'nombre' => ['required'],
                    'detalle' => ['required']
                ]);

                Solicitud::create([
                    'telefono' => $request->telefono,
                    'tipo' => $request->tipo,
                    'nombre_asignatura' => $request->nombre,
                    'NRC' =>$request->nrc,
                    'detalles_estudiante' => $request->detalle,
                    'user_id' => $request->user,
                ]);
                return redirect('/solicitud');
                break;

            case 'Ayudantia':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','int','required'],
                    'nombre' => ['required'],
                    'detalle' => ['required'],
                    'calificacion'=>['regex:/([1-6]\.[0-9])|([7]\.[0])/','required'],// revisar regex 6.9
                    'cantidad'=>['regex:/[0-9]*/','required','int']
                ]);

                Solicitud::create([
                    'telefono' => $request->telefono,
                    'tipo' => $request->tipo,
                    'nombre_asignatura' => $request->nombre,
                    'detalles_estudiante' => $request->detalle,
                    'calificacion_aprob' =>$request->calificacion,
                    'cant_ayudantias' =>$request->cantidad,
                    'user_id' => $request->user,
                ]);
                return redirect('/solicitud');
                break;







            case 'Facilidades':
                $request->validate([
                    'telefono' => ['regex:/[0-9]*/','int','required'],
                    'nombre' => ['required'],
                    'detalle' => ['required'],
                    'facilidad' => ['required','in:Licencia,Inasistencia Fuerza Mayor,Representacion,Inasistencia Motivo Personal'],
                    'profesor' => ['required'],
                    'adjunto.*' => ['mimes:pdf,jpg,jpeg,doc,docx','max:20000'],
                    'adjunto' => ['array','min:0','max:3'],
                ]);

                $findUser = User::find($request->user);

                $aux = 0;

                if($request->adjunto != ''){
                    foreach ($request->adjunto as $file) {
                        // todo falla cuando el archivo subido es PDF
                        $name = $aux.time().'-'.$findUser->name;
                        $file->move(public_path('\storage\docs'), $name);
                        $datos[] = $name;
                        $aux++;
                    }
                    Solicitud::create([
                        'telefono' => $request->telefono,
                        'tipo' => $request->tipo,
                        'nombre_asignatura' => $request->nombre,
                        'detalles_estudiante' => $request->detalle,
                        'tipo_facilidad' => $request->facilidad,
                        'nombre_profesor' => $request->profesor,
                        'archivos' => json_encode($datos),
                        'user_id' => $request->user,
                    ]);
                }else{
                    Solicitud::create([
                        'telefono' => $request->telefono,
                        'tipo' => $request->tipo,
                        'nombre_asignatura' => $request->nombre,
                        'detalles_estudiante' => $request->detalle,
                        'tipo_facilidad' => $request->facilidad,
                        'nombre_profesor' => $request->profesor,
                        'user_id' => $request->user,
                    ]);
                }


                return redirect('/solicitud');
                break;

            default:
                # code...
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $solicitud)
    {
        return view('solicitud.edit')->with('solicitud',$solicitud);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $solicitud)
    {
        $solicitud->estado='Anulada';
        $solicitud->save();

        return redirect('/solicitud');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {

    }
}
