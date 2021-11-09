<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //Importante para que reconozca el auth
use Illuminate\Support\Facades\Validator;


class ContraseñaController extends Controller
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
    public function index()
    {
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
    public function edit(int $id)
    {
        $user = User::where('id', $id)->first();
        if (Auth::user()==$user){
            return view('contrasena.edit')->with('user',$user);
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
    public function update(Request $request,int $id)
    {
        $user = User::where('id', $id)->first();
        //dd($request);
        if($request->contrasena === $request->contrasena2){
            $user->password = bcrypt($request->contrasena);
            $request->validate([
                'contrasena' => ['required', 'string', 'min:6','max:255'],
            ]);
            $user->save();
            // <script >
            //     Swal.fire({
            //         position: 'center',
            //         icon: 'success',
            //         title: 'Contraseña Restablecida',
            //         showConfirmButton: false,
            //         timer: 2000,
            //         })
            //     if($user->rol == 'Administrador'){
            //         Auth::logout();
            //         return redirect('/login');
            //     }
            // <script>
            if($user->rol == 'Administrador'){
                Auth::logout();
                return redirect('/login');
            }

            return redirect('/home');
            }else{

                return redirect("/contrasena/". strval($id). "/edit")->with('error', 'Las contraseñas no coinciden');
            }

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
