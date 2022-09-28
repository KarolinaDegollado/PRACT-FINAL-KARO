<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\turnoModel;
use App\Models\consultaModel;
use Carbon\Carbon;

class turnoController extends Controller
{
    function verTurnosActuales(Request $request)
    {
        if ($request->ajax()) {

            $turnorec = new turnoModel();
            $fecha = $turnorec->fecha_hora_turno = $request->fecha_actual;


            $turnorec = turnoModel::where('turno.fecha_hora_turno', 'like', "$fecha%")
                ->where('turno.estatus_turno', '=', 2)
                ->orderBy('turno.turno', 'ASC')
                ->first();

            // $id_registro = $turnorec->turno;
            // $numero_turno = $turnorec->turno;


            // OBTIENE EL ANO, MES Y DIA

            // $actualizar_turno = new turnoModel();
            $fecha_actualServer = Carbon::now()->format('Y-m-d');
            $nuevo_turno_actual = $turnorec['turno'];

            // DATOS DEL NUEVO TURNO --NO MOVER
            $turno_folio = "NUEVOTURNO";
            $turno_express = $nuevo_turno_actual;
            $fechaH_actual = Carbon::now()->format('Y-m-d H:i:s');
            $estatus_turno = 3;
            // SIGNIFICADO DE ESTATUS DE TURNOS
            // ESTATUS 1: EN CONSULTA
            // ESTATUS 2: EN ESPERA
            // ESTATUS 3: EN PROCESO DE CONSULTA
            // ESTATUS 4: CONCLUIDA
            

// YA FUNCIONA, SOLO FALTA INSERTAR LA NUEVA CONSULTA EN LA TABLA CONSULTA
            if ($turnorec !== "") {
                $turnorec = turnoModel::where('fecha_hora_turno', 'like', "$fecha_actualServer%")
                    ->where('estatus_turno', '=', '2')
                    ->increment('turno', 1);

                // $turno->save(); 
                if ($turnorec == "") {

                    return "NO incrementaron ";
                } else {
                    // return " SE INCREMENTARON";
                    $nreg = new turnoModel();
                    $nreg->folio_agenda_turno = $turno_folio;
                    $nreg->turno = $turno_express;
                    $nreg->fecha_hora_turno = $fechaH_actual;
                    $nreg->estatus_turno = $estatus_turno;
                    $nreg->save();

                    if ($nreg !== "") {
                        return "Se registro";
                    } else {
                        return "no se registro";
                    }
                }
            } else {
                return "Viene vacia la variable turnorec";
            }
        }




        // return json_encode($turnorec);


        // if(($turno->save())==TRUE){
        //     echo "SE GUARDO";

        // }else{
        //     echo "NO SE GUARDO";
        // }



        // return $turno->turno;
        // return json_encode($turno);






        // $turnorec->folio_agenda_turno = $turno_folio;
        // $turnorec->turno = $turno_express;
        // $turnorec->fecha_hora_turno = $fecha_actual;
        // $turnorec->estatus_turno = $estatus_turno;

        // if (($turnorec->save()) == TRUE) {
        //     $solo_dia_actual = Carbon::now()->format('Y-m-d');

        // }
        // return json_encode($turno);
        // return $fecha;
    }
}
    // function updateAllTurnos(Request $request)
    // {
    //     if ($request->ajax()) {
    //     }
    // }




// $turnoact = '';
//                 if($turno_express==1){
//                     $turnoact = $turno_express;
//                 }
//                 $all_turnos = 

//                 if (($all_turnos->save())) {
//                     return "SE ACTUALIZO Y GUARDO TODO";
//                 } else {
//                     return 'Ocurrio un error al actualizar todos los turnos';
//                 }
//             } else {
//                 return "Ocurrio un error al guardar el turno urgente";
//             }



            // return $actual;