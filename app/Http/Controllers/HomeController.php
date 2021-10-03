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
             return view('carreras.index')->with('carrera', $carreras); //lo que se envía como $carreras el html lo reconoce como 'carrera'
        }
        else if(Auth::user()->rol=='Jefe de Carrera'){
            //Logica de jefe de carrera
            //Retornar vista de jefe de carrera
        }
        else if(Auth::user()->rol=='Estudiante'){
            //Logica de Estudiante
            //Retornar vista de estudiante
        }
    }
}
