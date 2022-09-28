<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ciudadModel;


class ciudadController extends Controller
{
    function registrarCiudad(Request $req)
    {
        if ($req->ajax()) {

            $ciudad = new ciudadModel();
            $ciudad->nombre_ciudad = $req->nombre_ciudad;
            $ciudad->estatus_ciudad = 1;
            $ciudad->fk_estado = $req->fk_estado;

            if (($ciudad->save()) == TRUE) {
                return 1;
            } else {
                return 0;
            }
        }
    }
}
