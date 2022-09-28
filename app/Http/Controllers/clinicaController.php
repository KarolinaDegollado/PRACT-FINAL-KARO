<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clinicaModel;
use App\Models\consultorio_doctorModel;
use App\Models\empleadoModel;


class clinicaController extends Controller
{
    function consultarClinicas()
    {

        $clinicas = consultorio_doctorModel::where('ocupado', '=', '0')->join('consultorio', 'consultorio_doctor.fk_consultorio', '=', 'consultorio.id_consultorio')->get();
        return view("dashboard", compact("clinicas"));
    }

    public function seleccionarClinica(Request $request)
    {
        if ($request->ajax()) {

            $consultorio = $request->consultorio;
            $empleado = $request->fk_empleado;

            $empleados = new empleadoModel();
            $empleados = empleadoModel::where("fk_persona", '=', $request->fk_persona)->firstOrFail();

            if ($empleados == []) {
                return "SIN NINGUN REGISTRO";
            } else {
                $empleado = $empleados->id_empleado;
                $consultorio_doctornew = consultorio_doctorModel::where("fk_consultorio", '=', $consultorio)->update(
                    [
                        "fk_empleado" => $empleado,
                        "ocupado" => 1
                    ]
                );
                if ($consultorio_doctornew) {
                    $request->session()->put('fk_consultorio', $consultorio);
                    $request->session()->put('fk_empleado', $empleado);
                    return response()->json([
                        'respuesta' => 200
                    ]);
                }
            }
            return response()->json([
                'respuesta' => 500 //INTERNAL SERVER ERROR;
            ]);
            // $request->session()->put('fk_consultorio', $consultorio);

            // return $empleados;
        }
    }
}
