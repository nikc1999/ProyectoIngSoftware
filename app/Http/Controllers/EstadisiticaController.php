<?php

namespace App\Http\Controllers;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //Importante para que reconozca el auth


class EstadisiticaController extends Controller
{
    public function showEstadistica()
    {
        $totalSolicitudes = 0;
        $totalPendiente = 0;
        $totalRechazada = 0;
        $totalAceptada = 0;
        $totalAceptadaObs = 0;
        $totalAnulada = 0;

        $cantTipoSobrecupo = 0;
        $cantTipoCambioParalelo= 0;
        $cantTipoEliminarAsignatura = 0;
        $cantTipoInscripcionAsignatura = 0;
        $cantTipoAyudantia= 0;
        $cantTipoFacilidad = 0;

        $cantEnRango = 0;

        $usuarios = User::where('rol', 'Estudiante')->get();
        $carreraIdJefe = Auth::user()->carrera_id;
        foreach ($usuarios as $key => $usuario) {
            if ($usuario->carrera_id == $carreraIdJefe) {
                foreach ($usuario->solicitudes as $key => $solicitud) {

                    $totalSolicitudes++;
                    switch ($solicitud->getOriginal()['estado']) {
                        case 'Pendiente':
                            $totalPendiente++;
                            break;
                        case 'Rechazada':
                            $totalRechazada++;
                            break;
                        case 'Aceptada':
                            $totalAceptada++;
                            break;
                        case 'Aceptada con observaciones':
                            $totalAceptadaObs++;
                            break;
                        case 'Anulada':
                            $totalAnulada++;
                            break;
                        default:
                            # code...
                            break;
                    }
                    switch ($solicitud->getOriginal()['tipo']) {
                        case 'Sobrecupo':
                            $cantTipoSobrecupo++;
                            break;
                        case 'Cambio paralelo':
                            $cantTipoCambioParalelo++;
                            break;
                        case 'Eliminacion asignatura':
                            $cantTipoEliminarAsignatura++;
                            break;
                        case 'Inscripcion asignatura':
                            $cantTipoInscripcionAsignatura++;
                            break;
                        case 'Ayudantia':
                            $cantTipoAyudantia++;
                            break;
                        case 'Facilidades':
                            $cantTipoFacilidad++;
                            break;
                        default:
                            # code...
                            break;
                    }
                }

            }

        }

        return view('Estadisticas.index')
            ->with('cantTipoSobrecupo', $cantTipoSobrecupo)
            ->with('cantTipoCambioParalelo', $cantTipoCambioParalelo)
            ->with('cantTipoEliminarAsignatura', $cantTipoEliminarAsignatura)
            ->with('cantTipoInscripcionAsignatura', $cantTipoInscripcionAsignatura)
            ->with('cantTipoAyudantia', $cantTipoAyudantia)
            ->with('cantTipoFacilidad', $cantTipoFacilidad)
            ->with('totalPendiente', $totalPendiente)
            ->with('totalRechazada', $totalRechazada)
            ->with('totalAceptada', $totalAceptada)
            ->with('totalAceptadaObs', $totalAceptadaObs)
            ->with('totalAnulada', $totalAnulada)
            ->with('cantEnRango', $cantEnRango)

            ;
    }



    //-----------------------------------------------------------------------------
    public function mostrarEstadisticaFiltrada(Request $inicio)
    {
        $totalSolicitudes = 0;
        $totalPendiente = 0;
        $totalRechazada = 0;
        $totalAceptada = 0;
        $totalAceptadaObs = 0;
        $totalAnulada = 0;

        $cantTipoSobrecupo = 0;
        $cantTipoCambioParalelo= 0;
        $cantTipoEliminarAsignatura = 0;
        $cantTipoInscripcionAsignatura = 0;
        $cantTipoAyudantia= 0;
        $cantTipoFacilidad = 0;

        $cantEnRango = 0;

        $usuarios = User::where('rol', 'Estudiante')->get();
        $fechaIn = $inicio->fecha_inicio;
        $fechaTer = $inicio->fecha_fin;
        if($fechaIn == false){// cuando no se ingresa fecha se asume que la fecha requerida es la actual
            $fechaIn = date(now());
        }
        if($fechaTer == false){// cuando no se ingresa fecha se asume que la fecha requerida es la actual
            $fechaTer= date(now());
        }


        //transformo la fecha dd-mm-aaaa a un numero 000
        $fechaIn = strtotime("-1 day",strtotime($fechaIn));

        $fechaTer = strtotime("+1 day",strtotime($fechaTer));
        $carreraIdJefe = Auth::user()->carrera_id;

        //dd($fechaIn, $fechaTer);

        if($fechaIn>$fechaTer){
            return redirect("/estadisticas")->with('error', 'La fecha inicial es mayor que la fecha final');

        }elseif($fechaIn < $fechaTer || $fechaIn == $fechaTer){
            foreach ($usuarios as $key => $usuario) {
                if ($usuario->carrera_id == $carreraIdJefe) {
                    foreach ($usuario->solicitudes as $key => $solicitud) {

                        $totalSolicitudes++;
                        $fechaSolicitud= $solicitud->created_at; // upadte_at owo
                        $fechaSolicitud= strtotime($fechaSolicitud);


                        if ($fechaSolicitud>=$fechaIn && $fechaSolicitud <= $fechaTer) {
                            switch ($solicitud->getOriginal()['estado']) {
                                case 'Pendiente':

                                    $totalPendiente++;
                                    //$cantEnRango++;


                                    break;
                                case 'Rechazada':
                                    $totalRechazada++;
                                    //$cantEnRango++;

                                    break;
                                case 'Aceptada':
                                    $totalAceptada++;
                                    //$cantEnRango++;
                                    break;
                                case 'Aceptada con observaciones':
                                    $totalAceptadaObs++;
                                    //$cantEnRango++;

                                    break;
                                case 'Anulada':
                                    $totalAnulada++;
                                    //$cantEnRango++;
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                            switch ($solicitud->getOriginal()['tipo']) {
                                case 'Sobrecupo':
                                    $cantTipoSobrecupo++;
                                    break;
                                case 'Cambio paralelo':
                                    $cantTipoCambioParalelo++;
                                    break;
                                case 'Eliminacion asignatura':
                                    $cantTipoEliminarAsignatura++;
                                    break;
                                case 'Inscripcion asignatura':
                                    $cantTipoInscripcionAsignatura++;
                                    break;
                                case 'Ayudantia':
                                    $cantTipoAyudantia++;
                                    break;
                                case 'Facilidades':
                                    $cantTipoFacilidad++;
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                        }
                    }
                }


                   $cantEnRango= $totalPendiente + $totalRechazada + $totalAceptada +$totalAceptadaObs+ $totalAnulada ;
                }

        }
            return view('Estadisticas.index')
            ->with('cantTipoSobrecupo', $cantTipoSobrecupo)
            ->with('cantTipoCambioParalelo', $cantTipoCambioParalelo)
            ->with('cantTipoEliminarAsignatura', $cantTipoEliminarAsignatura)
            ->with('cantTipoInscripcionAsignatura', $cantTipoInscripcionAsignatura)
            ->with('cantTipoAyudantia', $cantTipoAyudantia)
            ->with('cantTipoFacilidad', $cantTipoFacilidad)
            ->with('totalPendiente', $totalPendiente)
            ->with('totalRechazada', $totalRechazada)
            ->with('totalAceptada', $totalAceptada)
            ->with('totalAceptadaObs', $totalAceptadaObs)
            ->with('totalAnulada', $totalAnulada)
            ->with('cantEnRango', $cantEnRango)

            ;
    }
}
