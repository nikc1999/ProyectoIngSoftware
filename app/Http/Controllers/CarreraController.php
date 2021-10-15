<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //Importante para que reconozca el auth
use Illuminate\Support\Facades\Validator;

class CarreraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'codigo' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    public function index()
    {
        if(Auth::user()== null)
        {
            return view('auth.login');
        }
        if(Auth::user()->rol=='Administrador')
        {
            $carreras = Carrera::all();  //Lo que realiza es llamar de la base de datos todas las carreras
            return view('administrador.index')->with('carrera', $carreras); //lo que se envía como $carreras el html lo reconoce como 'carrera'
        }
        return redirect('/home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function agregarCarrera()
    {
        return view('administrador.crearcarrera');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|unique:carreras|regex:/[1-9][0-9][0-9][0-9]/',
            'nombre' => 'required',
        ]);

        $carrera= new Carrera();
        $carrera->nombre=$request->nombre;
        $carrera->codigo=$request->codigo;

        $carrera->save();
        return redirect('/gestionarcarreras');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function show(Carrera $carrera)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */

    public function mostrarPanelCarreras()
    {
        $carreras = Carrera::all();
        $usuarios = User::all();
        $datos = [
            'carreras' => $carreras,
            'usuarios' => $usuarios,
        ];
        return view('administrador.gestionar_carreras')->with('datos', $datos);
    }

    public function edit(Carrera $carrera)
    {
        return view('administrador.editar')->with('carrera', $carrera);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carrera $carrera)
    {
        $carrera->nombre = $request->nombre;
        $carrera->save();
        return redirect('/gestionarcarreras');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carrera $carrera)
    {
        //
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
}
