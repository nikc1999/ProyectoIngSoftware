<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Solicitud;
use App\Models\User;
use App\Rules\ValidarCarreraTieneJefe;
use App\Rules\ValidarRut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; //Importante para que reconozca el auth
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Mockery\Undefined;
//aaa
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


use function PHPUnit\Framework\isEmpty;

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
        if (Auth::user()== null) {
            return view('auth.login');
        }
        if (Auth::user()->rol=='Administrador') {
            if ($request->search == null) {
                $usuarios = User::simplePaginate(10);
                return view('administrador.gestionar_usuarios')->with('usuarios', $usuarios);
            } else {
                $usuarios = User::where('rut', $request->search)->simplePaginate(1);
                return view('administrador.gestionar_usuarios')->with('usuarios', $usuarios);
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

    public function mostrarCargaMasivaEstudiantes(){
        return view('Administrador.carga_masiva');
    }

    public function cargarExcel(Request $request){
        set_time_limit(1000);
        $auxAdd = [];
        $auxHeader = false;
        $auxDatos = new Request();
        $auxErrores = [];

        $request->validate([
            "adjunto" => 'mimes:xlsx|required'
        ]);
        $doc = IOFactory::load($request->adjunto);
        $hoja1 = $doc->getSheet(0);

        if (is_numeric($hoja1->getCell('A1')->getValue())) { //Quiero ver si el excel tiene datos textuales
            $auxHeader = false;
        }
        else {
            $auxHeader = true;
        }

        if ($auxHeader) {
            foreach ($hoja1->getRowIterator(2, null) as $key => $fila) {
                foreach ($fila->getCellIterator() as $key => $celda) {
                    switch ($celda->getColumn()) {
                        case 'A':
                            $auxDatos->request->add(["carrera" => $celda->getValue()]);
                            break;
                        case 'B':
                            $auxDatos->request->add(["rut" => $celda->getValue()]);
                            break;
                        case 'C':
                            $auxDatos->request->add(["nombre" => $celda->getValue()]);
                            break;
                        case 'D':
                            $auxDatos->request->add(["email" => $celda->getValue()]);
                            break;

                        default:
                            # code...
                            break;
                    }
                }

                $validator = Validator::make($auxDatos->request->all(), [
                    'nombre' => ['required', 'string', 'max:255'],
                    'carrera'=> ['exists:App\Models\Carrera,codigo'],
                    'rut' => ['required', 'string', 'unique:users','min:8', 'max:9',new ValidarRut],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
                ]);

                if (!$validator->fails()) {

                    $carrera = Carrera::where('codigo', $auxDatos->request->all()["carrera"])->first();
                    $contrasena = substr($auxDatos->request->all()["rut"], 0, 6);

                    //crear pass
                    $newUser = User::create([
                        'name' => $auxDatos->request->all()["nombre"],
                        'email' => $auxDatos->request->all()["email"],
                        'password' => bcrypt($contrasena),
                        'rut' => $auxDatos->request->all()["rut"],
                        'rol' => "Estudiante",
                        'habilitado' => 1,
                        'carrera_id' => $carrera->id,
                    ]);
                    $auxAdd["fila".$fila->getRowIndex()] = $newUser;
                }
                else{
                    $auxDatos->request->add(["error" => $celda->getValue()]);
                    $auxErrores["fila" . $fila->getRowIndex()] = $validator->getMessageBag()->getMessages();
                }
            }
        }
        else {
            foreach ($hoja1->getRowIterator(2, null) as $key => $fila) {
                foreach ($fila->getCellIterator() as $key => $celda) {
                    switch ($celda->getColumn()) {
                        case 'A':
                            $auxDatos->request->add(["carrera" => $celda->getValue()]);
                            break;
                        case 'B':
                            $auxDatos->request->add(["rut" => $celda->getValue()]);
                            break;
                        case 'C':
                            $auxDatos->request->add(["nombre" => $celda->getValue()]);
                            break;
                        case 'D':
                            $auxDatos->request->add(["email" => $celda->getValue()]);
                            break;

                        default:
                            # code...
                            break;
                    }
                }

                $validator = Validator::make($auxDatos->request->all(), [
                    'nombre' => ['required', 'string', 'max:255'],
                    'carrera'=> ['exists:App\Models\Carrera,codigo'],
                    'rut' => ['required', 'string', 'unique:users','min:8', 'max:9',new ValidarRut],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
                ]);

                /* dd($validator->getMessageBag()->getMessages()); */
                if (!$validator->fails()) {
                    $contrasena = substr($auxDatos->request->all()["rut"], 0, 6);
                    $carrera = Carrera::where('codigo', $auxDatos->request->all()["carrera"])->first();
                    $newUser = User::create([
                        'name' => $auxDatos->request->all()["nombre"],
                        'email' => $auxDatos->request->all()["email"],
                        'password' => bcrypt($contrasena),
                        'rut' => $auxDatos->request->all()["rut"],
                        'rol' => "Estudiante",
                        'habilitado' => 1,
                        'carrera_id' => $carrera->id,
                    ]);
                    $auxAdd["fila".$fila->getRowIndex()] = $newUser;
                }
                else{

                    $auxErrores["fila" . $fila->getRowIndex()] = $validator->getMessageBag()->getMessages();
                }
            }
        }
        dd($auxErrores);
        return view("Administrador.carga_masiva")->with('errores', $auxErrores)->with('nuevos', $auxAdd);
    }

    public function cargaMasivaEstudiantes(Request $request){
        $aux = 0;
        $request->validate([
            'adjunto' => ['max:10000'],
        ]);

        $file = $request->file('adjunto');

        if ($file) {
            $name = $aux.time().'.'.$file->getClientOriginalExtension();

            $file->move(public_path('\storage\docs'), $name);
            $filepath = public_path('\storage\docs', $name);
            // Reading file
            $filepath= $filepath . '\\' . $name;

            $file = fopen($filepath, "r");

            $importData_arr = array(); // Read through the file and store the contents as an array
            $i = 0;
            //Read the contents of the uploaded file
            while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                $num = count($filedata);

                if ($num!=4){
                    return redirect('/menucarga');
                }
                // Skip first row (Remove below comment if you want to skip the first row)
                if ($i == 0) {

                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    if(!$importData_arr[$i][0] || $importData_arr[$i][0]!='CARRERA'){

                        return redirect('/menucarga');
                    }
                    if(!$importData_arr[$i][1] || $importData_arr[$i][1]!='RUT'){

                        return redirect('/menucarga');
                    }
                    if(!$importData_arr[$i][2] || $importData_arr[$i][2]!='NOMBRE'){
                        return redirect('/menucarga');
                    }
                    if(!$importData_arr[$i][3] || $importData_arr[$i][3]!='CORREO'){
                        return redirect('/menucarga');
                    }


                }
                if ($i != 0) {
                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                }

                $i++;
            }
            fclose($file); //Close after reading
            set_time_limit(400);
            foreach ($importData_arr as $importData) {
                if ($importData[0] == "CARRERA") {
                    continue;
                }

                try {


                    $rut = $request->rut;
                    $contrasena = substr($rut, 0, 6);

                    $carrera = Carrera::where('codigo',$importData[0])->first();
                    $id_carrera = $carrera->id;

                    $validator = Validator::make($importData, [
                        $importData[2] => ['required', 'string', 'max:255'],
                        $importData[3] => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        $importData[1] => ['required', 'string', 'unique:users','min:8', 'max:9',new ValidarRut],
                        $id_carrera =>['exists:App\Models\Carrera,id']
                    ]);

                    User::create([
                    'name' => $importData[2],
                    'email' => $importData[3],
                    'password' => bcrypt($contrasena),
                    'rut' => $importData[1],
                    'rol' => 'Estudiante',
                    'habilitado' => 1,
                    'carrera_id' => $id_carrera,
                    ]);
                    //meter el rut y el nombre en una lista
                } catch (\Exception $e) {
                    //meter el rut y nombre en una lista
                }
            }
            return redirect('/usuario');
        }
        return redirect('/menucarga');
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
        } else {
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
        if ($request['rol'] == 'Jefe de Carrera') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'rut' => ['required', 'string', 'unique:users','min:8', 'max:9',new ValidarRut],
                'rol' => ['string','required', 'in:Administrador,Jefe de Carrera,Estudiante'],
                'carrera'=>['exists:App\Models\Carrera,id',new ValidarCarreraTieneJefe]
            ]);
        } else {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'rut' => ['required', 'string', 'unique:users','min:8', 'max:9',new ValidarRut],
                'rol' => ['string','required', 'in:Administrador,Jefe de Carrera,Estudiante'],
                'carrera'=>['exists:App\Models\Carrera,id']
            ]);
        }

        $rut = $request->rut;
        $contrasena = substr($rut, 0, 6);

        $newUser = User::create([
            'name' => $request->nombre,
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
        if ($user->rol == 'Administrador') {
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
        if ($user->rol == 'Administrador') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
                'rut' => ['required', 'string','unique:users,rut,'.$user->id,'min:8', 'max:9',new ValidarRut],
            ]);
            $user->name = $request->nombre;
            $user->rut = $request->rut;
            $user->email = $request->email;
            $user->save();
            return redirect('/usuario');
        }
        if ($request['rol'] == 'Estudiante' or ($request['rol'] == 'Jefe de Carrera' and $user['rol'] == 'Jefe de Carrera' and $request['carrera'] == $user['carrera_id'])) {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
                'rut' => ['required', 'string', 'unique:users,rut,'.$user->id,'min:8', 'max:9',new ValidarRut],
                'rol' => ['string','required', 'in:Administrador,Jefe de Carrera,Estudiante'],
                'carrera'=>['exists:App\Models\Carrera,id']
            ]);
        } else {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
                'rut' => ['required', 'string', 'unique:users,rut,'.$user->id,'min:8', 'max:9',new ValidarRut],
                'rol' => ['string','required', 'in:Administrador,Jefe de Carrera,Estudiante'],
                'carrera'=>['exists:App\Models\Carrera,id',new ValidarCarreraTieneJefe]
            ]);
        }
        $user->name = $request->nombre;
        $user->rut = $request->rut;
        $user->email = $request->email;
        $user->rol = $request->rol;

        if($user->carrera_id == $request->carrera){ //Si no se cambió de carrera todo bien
            $user->carrera_id = $request->carrera;
        }
        elseif($user->carrera_id != $request->carrera){ //Si se cambió de carrera se deben anular todas las solicitudes


            $solicitudes = Solicitud::where('user_id', $user->id)->get();

            foreach($solicitudes as $solicitud){
                $solicitud->estado = 'Anulada';
                $solicitud->save();
            }
            $user->carrera_id = $request->carrera;
        }

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
        $contrasena=substr($rut, 0, 6);
        $encontrarUsuario->password=bcrypt($contrasena);
        $encontrarUsuario->save();
        return redirect('/usuario');
    }

    public function mostrarSolicitudesPendientesJefe()
    {
        $listaSolicitudes = collect();
        $carreraIdJefe = Auth::user()->carrera_id;
        $usuarios = User::where('carrera_id', $carreraIdJefe)->get();
        foreach ($usuarios as $usuario) {
            $solicitudes = Solicitud::where('user_id', $usuario->id)->get();
            foreach ($solicitudes as $solicitud) {
                if ($solicitud->estado == 'Pendiente') {
                    $listaSolicitudes->push($solicitud);
                }
            }
        }

        $solicitudes = $listaSolicitudes->sortBy('updated_at');

        $solicitudes = $solicitudes->sortBy('updated_at');

        $datos = [
            'solicitudes' => $solicitudes,
            'usuarios' => $usuarios,
            'ruta' => 'panel',
        ];

        return view('JefeCarrera.solicitudes')->with('datos', $datos);

        // $listaSolicitudes = collect();
        //$listaEstudiantes = collect();

        //foreach ($solicitudes as $solicitud) {
        //    if ($solicitud->estado == 'Pendiente') {
         //       $idUsuario = $solicitud->user_id;
        //        foreach ($usuarios as $usuario) {
        //            if ($usuario->id == $idUsuario) {
        //                if ($usuario->carrera_id == $carreraIdJefe) {
        //                    $listaSolicitudes->push($solicitud);
        //                    $listaEstudiantes->push([$usuario->rut,$usuario->name,$usuario->email]);
        //                }
        //            }
        //        }
        //    }
        //}

        //$listaSolicitudes = $listaSolicitudes->sortBy('updated_at');

        //dd($listaSolicitudes,$listaEstudiantes);
        //return view('JefeCarrera.solicitudes')->with('solicitudesPendientes', $listaSolicitudes)->with('datosEstudiantesPendientes' , $listaEstudiantes);
    }

    public function mostrarSolicitudesFiltrar(Request $request)
    {
        if ($request->tipo == null) {
            $listaSolicitudes = collect();
            $carreraIdJefe = Auth::user()->carrera_id;
            $usuarios = User::where('carrera_id', $carreraIdJefe)->get();
            foreach ($usuarios as $usuario) {
                $solicitudes = Solicitud::where('user_id', $usuario->id)->get();
                foreach ($solicitudes as $solicitud) {
                    $listaSolicitudes->push($solicitud);
                }
            }

            $solicitudes = $listaSolicitudes->sortBy('updated_at'); //ninguno de los dos funciona :c

            $solicitudes = $solicitudes->sortBy('updated_at');

            $datos = [
                'solicitudes' => $solicitudes,
                'usuarios' => $usuarios,
                'ruta' => 'panel',
            ];

            return view('JefeCarrera.solicitudes')->with('datos', $datos);
        }

        $listaSolicitudes = collect();
        $carreraIdJefe = Auth::user()->carrera_id;
        $usuarios = User::where('carrera_id', $carreraIdJefe)->get();


        foreach ($usuarios as $usuario) {
            $solicitudes = Solicitud::where('user_id', $usuario->id)->get();
            foreach ($solicitudes as $solicitud) {
                if ($solicitud->tipo == $request->tipo) {
                    $listaSolicitudes->push($solicitud);
                }
            }
        }

        $listaSolicitudes = $listaSolicitudes->sortBy('updated_at');

        $solicitudes = $listaSolicitudes;

        $datos = [
            'solicitudes' => $solicitudes,
            'usuarios' => $usuarios,
            'ruta' => 'panel',
        ];


        return view('JefeCarrera.solicitudes')->with('datos', $datos);

        //dd($listaSolicitudes,$listaEstudiantes);
        //return view('JefeCarrera.filtrarSolicitudes')->with('solicitudes', $listaSolicitudes)->with('datosEstudiantes' , $listaEstudiantes);
    }

    public function mostrarEstadosFiltrar(Request $request)
    {
        if ($request->estado == null) {
            $listaSolicitudes = collect();
            $carreraIdJefe = Auth::user()->carrera_id;
            $usuarios = User::where('carrera_id', $carreraIdJefe)->get();
            foreach ($usuarios as $usuario) {
                $solicitudes = Solicitud::where('user_id', $usuario->id)->get();
                foreach ($solicitudes as $solicitud) {
                    $listaSolicitudes->push($solicitud);
                }
            }

            $solicitudes = $listaSolicitudes;

            $solicitudes = $solicitudes->sortBy('updated_at');

            $datos = [
                'solicitudes' => $solicitudes,
                'usuarios' => $usuarios,
                'ruta' => 'panel',
            ];

            return view('JefeCarrera.solicitudes')->with('datos', $datos);
        }

        $listaSolicitudes = collect();
        $carreraIdJefe = Auth::user()->carrera_id;
        $usuarios = User::where('carrera_id', $carreraIdJefe)->get();


        foreach ($usuarios as $usuario) {
            $solicitudes = Solicitud::where('user_id', $usuario->id)->get();
            foreach ($solicitudes as $solicitud) {
                if ($solicitud->estado == $request->estado) {
                    $listaSolicitudes->push($solicitud);
                }
            }
        }

        $listaVacia = collect();

        $listaSolicitudes = $listaSolicitudes->sortBy('updated_at');

        if($listaVacia == $listaSolicitudes){ //Si no se encontro ninguna solicitud se le debe enviar algo a la vista

            $solicitudes = $listaSolicitudes;

            $datos = [
                'solicitudes' => $solicitudes,
                'usuarios' => $usuarios,
                'ruta' => 'panel',
            ];

            return view('JefeCarrera.solicitudes')->with('datos', $datos);
        }

        $solicitudes = $listaSolicitudes;

        $datos = [
            'solicitudes' => $solicitudes,
            'usuarios' => $usuarios,
            'ruta' => 'panel',
        ];

        return view('JefeCarrera.solicitudes')->with('datos', $datos);
    }

    public function mostrarInfoSolicitudBoton(Request $request){


        $datos = [

        ];
        return view('JefeCarrera.infoEstudiante')->with('datos', $datos);
    }

}
