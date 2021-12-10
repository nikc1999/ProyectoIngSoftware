<?php

namespace App\Http\Controllers;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

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
        // dd($usuarios);
        foreach ($usuarios as $key => $usuario) {
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
        $fechaTer = $inicio->fecha_termino;

        //creo las fechas con el formato 2021-12-04 00:00:00.0 America/Santiago (-03:00) este es igual que el sistema
        $fechaIn = strtotime($fechaIn);
        $fechaTer = strtotime($fechaTer);


        foreach ($usuarios as $key => $usuario) {
            foreach ($usuario->solicitudes as $key => $solicitud) {
                $totalSolicitudes++;
                $fechaSolicitud= $solicitud->created_at;
                $fechaSolicitud= strtotime($fechaSolicitud);
                        switch ($solicitud->getOriginal()['estado']) {
                            case 'Pendiente':

                                $totalPendiente++;
                                if ($fechaSolicitud>$fechaIn && $fechaSolicitud> $fechaTer) {
                                    $cantEnRango++;
                                }

                                break;
                            case 'Rechazada':
                                $totalRechazada++;
                                if ($fechaSolicitud>$fechaIn && $fechaSolicitud> $fechaTer) {
                                    $cantEnRango++;
                                }
                                break;
                            case 'Aceptada':
                                $totalAceptada++;
                                if ($fechaSolicitud>$fechaIn && $fechaSolicitud> $fechaTer) {
                                    $cantEnRango++;
                                }
                                break;
                            case 'Aceptada con observaciones':
                                $totalAceptadaObs++;
                                if ($fechaSolicitud>$fechaIn && $fechaSolicitud> $fechaTer) {
                                    $cantEnRango++;
                                }
                                break;
                            case 'Anulada':
                                $totalAnulada++;
                                if ($fechaSolicitud>$fechaIn && $fechaSolicitud> $fechaTer) {
                                    $cantEnRango++;
                                }
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
                    //dd($cantEnRango);
                }

            $suma = $totalPendiente + $totalRechazada +$totalAceptada+$totalAceptadaObs+$totalAnulada;


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
            ->with('suma', $suma)

            ;
    }
}
