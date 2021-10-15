<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\User;
use App\Rules\ValidarCarreraTieneJefe;
use App\Rules\ValidarRut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //Importante para que reconozca el auth
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
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
    public function index(Request $request)
    {
        if(Auth::user()== null)
        {
            return view('auth.login');
        }
        if(Auth::user()->rol=='Administrador')
        {
            if ($request->search == null) {
                $usuarios = User::simplePaginate(10);
                return view('administrador.gestionar_usuarios')->with('usuarios',$usuarios);
            }else {
                $usuarios = User::where('rut', $request->search)->simplePaginate(1);
                return view('administrador.gestionar_usuarios')->with('usuarios',$usuarios);
            }
            //$usuarios = User::all();  //Lo que realiza es llamar de la base de datos todos los usuarios
            //return view('administrador.gestionar_usuarios')->with('usuarios',$usuarios);
        }
        return redirect('/home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mostrarAgregarUsuario()
    {

    }

    public function create()
    {
        $carreras = Carrera::with('users')->get();  //Lo que realiza es llamar de la base de datos todas las carreras
        return view('auth.register')->with('carreras', $carreras);
    }

    public function habilitarUsuario(Request $request)
    {
        $encontrarUsuario = User::where('id', $request->id)->first();

        if ($encontrarUsuario->habilitado === 0) {
            $encontrarUsuario->habilitado = 1;
            $encontrarUsuario->save();
            return redirect('/usuario');
        }else {
            $encontrarUsuario->habilitado = 0;
            $encontrarUsuario->save();
            return redirect('/usuario');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['rol'] == 'Jefe de Carrera'){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'rut' => ['required', 'string', 'unique:users','min:8', 'max:9',new ValidarRut],
                'rol' => ['string','required', 'in:Administrador,Jefe de Carrera,Alumno'],
                'carrera'=>['exists:App\Models\Carrera,id',new ValidarCarreraTieneJefe]
            ]);
        }
        else{
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'rut' => ['required', 'string', 'unique:users','min:8', 'max:9',new ValidarRut],
                'rol' => ['string','required', 'in:Administrador,Jefe de Carrera,Alumno'],
                'carrera'=>['exists:App\Models\Carrera,id']
            ]);
        }

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
    public function edit(int $id)
    {
        $user = User::where('id', $id)->first();
        $carreras = Carrera::with('users')->get();
        $datos = [
            'carreras' => $carreras,
            'usuario' => $user,
        ];
        if ($user->rol == 'Administrador'){
            return view('usuario.edit')->with('datos', $datos);
        }
        return view('usuario.edit')->with('datos', $datos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $user = User::where('id', $id)->first();
        if ($user->rol == 'Administrador'){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
                'rut' => ['required', 'string','unique:users,rut,'.$user->id,'min:8', 'max:9',new ValidarRut],
            ]);
            $user->name = $request->name;
            $user->rut = $request->rut;
            $user->email = $request->email;
            $user->save();
            return redirect('/usuario');
        }
        if ($request['rol'] == 'Alumno' or ($request['rol'] == 'Jefe de Carrera' and $user['rol'] == 'Jefe de Carrera' and $request['carrera'] == $user['carrera_id'])){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
                'rut' => ['required', 'string', 'unique:users,rut,'.$user->id,'min:8', 'max:9',new ValidarRut],
                'rol' => ['string','required', 'in:Administrador,Jefe de Carrera,Alumno'],
                'carrera'=>['exists:App\Models\Carrera,id']
            ]);
        }
        else{
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
                'rut' => ['required', 'string', 'unique:users,rut,'.$user->id,'min:8', 'max:9',new ValidarRut],
                'rol' => ['string','required', 'in:Administrador,Jefe de Carrera,Alumno'],
                'carrera'=>['exists:App\Models\Carrera,id',new ValidarCarreraTieneJefe]
            ]);
        }
        $user->name = $request->name;
        $user->rut = $request->rut;
        $user->email = $request->email;
        $user->rol = $request->rol;
        $user->carrera_id = $request->carrera;
        $user->save();
        return redirect('/usuario');
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

    public function restablecerContrasena(Request $request)
    {
        $encontrarUsuario = User::where('id', $request->id)->first();
        $rut=$encontrarUsuario->rut;
        $contrasena=substr($rut,0,6);
        $encontrarUsuario->password=bcrypt($contrasena);
        $encontrarUsuario->save();
        return redirect('/usuario');
    }
}
