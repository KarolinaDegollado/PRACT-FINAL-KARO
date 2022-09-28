<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\actualizacionturnoModel;

class actualizacion_turno extends Controller
{
    function verificarActTurno(Request $request){

        if($request->ajax()){
            // return "SE HA RECIBIO PETICION CON AJAX XD";
            $actualizacion_turno = new actualizacionturnoModel();
            $actualizacion_turno = actualizacionturnoModel::where('id_actualizacion_turno', '1')->get();

            return $actualizacion_turno;
        }
    }
}
