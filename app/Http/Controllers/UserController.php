<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //Importante para que reconozca el auth
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()==null)
        {
            return view('auth.login');
        }
        if(Auth::user()->rol=='Administrador')
        {
            $usuarios = User::all();  //Lo que realiza es llamar de la base de datos todos los usuarios
            return view('administrador.gestionar_usuarios');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mostrarAgregarUsuario()
    {
        $carreras = Carrera::all();  //Lo que realiza es llamar de la base de datos todas las carreras
        return view('auth.register')->with('carrera', $carreras);


    }
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

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'rut' => ['required', 'string', 'unique:users','max:9', 'min:8'],
            'rol' => ['string','required', 'in:Administrador,Jefe de Carrera,Alumno'],
            'carrera'=>['exists:App\Models\Carrera,id'] //este es ctm
        ]);

        //Logica para recortar el rut a 6 digitos:

        $defaultPassword = '123456';


        $rut = $request->rut;
        $contrasena = substr($rut, 0, 6);

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($contrasena),
            'rut' => $request['rut'],
            'rol' => $request['rol'],
            'habilitado' => 1,
            'carrera_id' => $request->carrera,
        ]);

        //$newUser->save();        solo para editar un usuario
        return redirect('/usuario');
    }

    /**
     *
     *
     *
     *
     *
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
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
    public function update(Request $request, User $user)
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
