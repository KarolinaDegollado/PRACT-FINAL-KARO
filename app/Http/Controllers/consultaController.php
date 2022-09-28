<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\consultaModel;
use App\Models\turnoModel;
use Yajra\DataTables\Facades\DataTables as DataTables;
use Carbon\Carbon;


class consultaController extends Controller
{

    function verConsultasTurno(Request $request)
    {
        if ($request->ajax()) {
            // $consultas = consultaModel::select('consulta.*');
            // return DataTables::of($consultas)
            // ->make(true);

            $consultas = consultaModel::join('empleado', 'consulta.fk_empleado', '=', 'empleado.id_empleado')
                ->join('consultorio', 'consulta.fk_consultorio', '=', 'consultorio.id_consultorio')
                ->join('turno', 'consulta.fk_turno', '=', 'turno.id_turno')
                ->join('parametros_paciente', 'consulta.fk_parametros_paciente', '=', 'parametros_paciente.id_parametros_paciente')
                // ->join('diagnostico', 'consulta.diagnostico_id_diagnostico', '=', 'diagnostico.id_diagnostico')
                ->join('encuesta_consulta', 'consulta.fk_encuesta_consulta', '=', 'encuesta_consulta.id_encuesta')
                ->join('paciente', 'consulta.fk_paciente', '=', 'paciente.id_paciente')
                ->join('persona', 'paciente.fk_persona', '=', 'persona.id_persona')
                // 'diagnostico.*'
                ->where('estatus_turno', 1)
                ->orWhere('estatus_turno', 2)
                ->orWhere('estatus_turno', 3)
                // ->orderBy('turno.turno', 'ASC')
                ->select('consulta.*', 'empleado.*', 'consultorio.*', 'turno.*', 'parametros_paciente.*', 'encuesta_consulta.*', 'persona.*');
            return DataTables::of($consultas)->addColumn('nombre_completo', function ($consulta) {
                return $consulta->nombre . ' ' . $consulta->apaterno . ' ' . $consulta->amaterno;
            })
                ->filterColumn('fecha_hora_turno', function ($query, $keyword) {
                    $sql = "CONCAT(fecha_hora_turno) like? ";
                    $query->whereRaw($sql, ["%$keyword%"]);
                })
                ->filterColumn('folio_consulta', function ($query2, $keyword) {
                    $sql2 = "CONCAT(folio_consulta) like? ";
                    $query2->whereRaw($sql2, ["%$keyword%"]);
                })
                ->filterColumn('tipo_consulta', function ($query3, $keyword) {
                    $sql3 = "CONCAT(tipo_consulta) like? ";
                    $query3->whereRaw($sql3, ["%$keyword%"]);
                })
                ->filterColumn('turno', function ($query4, $keyword) {
                    $sql4 = "CONCAT(turno) like? ";
                    $query4->whereRaw($sql4, ["%$keyword%"]);
                })
                ->filterColumn('numero_consultorio', function ($query5, $keyword) {
                    $sql5 = "CONCAT(numero_consultorio) like? ";
                    $query5->whereRaw($sql5, ["%$keyword%"]);
                })
                ->filterColumn('estatus_turno', function ($query6, $keyword) {
                    $sql6 = "CONCAT(estatus_turno) like? ";
                    $query6->whereRaw($sql6, ["%$keyword%"]);
                })
                ->filterColumn('nombre_completo', function ($query, $keyword) {
                    $sql = "CONCAT(nombre,' ',apaterno,' ',amaterno) like? ";
                    $query->whereRaw($sql, ["%$keyword%"]);
                })
                ->editColumn('consulta', function ($query) {
                    if (($query->fk_empleado) === '') {
                        return "";
                    }
                    if (($query->fk_consultorio) === '') {
                        return "";
                    } else {
                        return $query->fk_consultorio;
                    }
                })
                ->editColumn('estatus_turno', function ($query) {
                    if (($query->estatus_turno) == 1) {
                        return '<span class="badge bg-danger">En consulta</span>';
                    }
                    if (($query->estatus_turno) == 2) {
                        return '<span class="badge bg-warning">En espera</span>';
                    }
                    if (($query->estatus_turno) == 3) {
                        return '<span class="badge bg-info">En proceso de consulta</span>';
                    }
                })
                ->editColumn('tipo_consulta', function ($query2) {
                    return $query2->tipo_consulta == 1 ? '<span class="badge bg-danger">Urgente</span>' : '<span class="badge bg-warning">Normal</span>';
                })
                ->rawColumns(['estatus_turno', 'tipo_consulta'])
                ->make(true);
        }
        return view('/lista_turnos');
    }

    function iniciarConsulta(Request $request)
    {
        if ($request->ajax()) {
            $fecha_hora = Carbon::now()->format('Y-m-d H:i:s');
            $folio_consulta = $request->folio_consulta;

            $consulta_update = consultaModel::where('folio_consulta', $folio_consulta)
                ->update([
                    "fecha_hora_inicio" => $fecha_hora
                ]);
            if ($consulta_update) {
                $turno_update = turnoModel::where('folio_agenda_turno', $folio_consulta)
                    ->update([
                        "estatus_turno" => 1
                    ]);

                if ($turno_update) {
                    return 1;
                }
            } else {
                return 0;
            }
        }
    }





    // 25/07/2022
    function terminarConsultaEC(Request $request)
    {
        if ($request->ajax()) {
            // return "terminarConsultaEC";
            $folio_consulta = $request->folio_consulta;
            $diagnostico_consulta = $request->diagnostico_consulta;
            $fecha_hora = Carbon::now()->format('Y-m-d H:i:s');
            $actualizar_consulta = consultaModel::where('folio_consulta', $folio_consulta)
                ->update([
                    "fecha_hora_final" => $fecha_hora,
                    "diagnostico_consulta" => $diagnostico_consulta
                ]);
            if ($actualizar_consulta) {
                $turno_update = turnoModel::where('folio_agenda_turno', $folio_consulta)
                    ->update([
                        "estatus_turno" => 4
                    ]);
                if ($turno_update) {
                    return 1;
                }
            } else {
                return 0;
            }
        }
    }
}
