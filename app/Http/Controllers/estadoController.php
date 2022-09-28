<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estadoModel;

class estadoController extends Controller
{
    public function guardarEstado(Request $req)
    {
        $estado = new estadoModel();
        $estado->nombre_estado = $req->nombre_estado;
        $estado->estatus_estado = 1;

        if (($estado->save()) == TRUE) {
            return 1;
        } else {
            return 0;
        }
    }
     function nombreEstados()
    {
        $estados = estadoModel::all();
        return view("dashboard", compact('estados'));
    }
}
