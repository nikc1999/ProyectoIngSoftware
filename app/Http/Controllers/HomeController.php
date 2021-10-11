<?php


namespace App\Http\Controllers;

use App\Models\Carrera; //hardcodeado, este es el punto principal en donde se ve a donde controlador va, en este caso carreras
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //Importante para que reconozca el auth

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() //hardcodeado
    {
        if (Auth::user()->rol=='Administrador') {
             $carreras = Carrera::all();  //Lo que realiza es llamar de la base de datos todas las carreras
             return view('administrador.index')->with('carrera', $carreras); //lo que se envía como $carreras el html lo reconoce como 'carrera'
        }
        else if(Auth::user()->rol=='Jefe de Carrera'){
            //$carreras = Carrera::all();  //Se debería cargar todos los datos que corresponden a los de jefe carrera
            return view('JefeCarrera.index');//Retornar la vista de jefe de carreras
        }
        else if(Auth::user()->rol=='Alumno'){
            $carreras = Carrera::all();  //Lo que realiza es llamar de la base de datos todas las carreras
            return view('estudiante.index');
        }
    }
}
