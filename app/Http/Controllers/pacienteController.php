<?php

namespace App\Http\Controllers;

use App\Models\consultaModel;
use Illuminate\Http\Request;
use App\Models\pacienteModel;
use App\Models\parametrospModel;
use App\Models\parametros_pacienteModel;
use Carbon\Carbon;


class pacienteController extends Controller
{
    function buscarPaciente(Request $req)
    {
        $paciente = pacienteModel::all();
    }

    function buscarPacienteID(Request $request)
    {
        // $paciente = new pacienteModel();
        // $paciente->fk_persona= $req->id;

        // if($request->ajax()){
        //     $paciente= $
        // }
        // return $paciente;
        // $id_persona = $req->id_persona;
        // $paciente = pacienteModel::select()->join('persona', 'paciente.fk_persona', '=', 'persona.id_persona')->where('id_persona', $id_persona);

        // return view('dashboard', compact("pacienteid"));


        if ($request->ajax()) {
            // return $request->id_persona;

            // $paciente = new pacienteModel();

            $id_persona = $request->id_persona;

            $paciente = pacienteModel::where('fk_persona', $id_persona)->join('persona', 'paciente.fk_persona', '=', 'persona.id_persona')->firstOrFail();

            return $paciente;
        }
        return view("/dashboard");
    }
    function registrarParametrosPaciente(Request $request)
    {
        $fecha_hora = Carbon::now()->format('Y-m-d H:i:s');
        $params = new parametrospModel();
        $folio_paciente = new pacienteModel();
        $paciente_params = new parametros_pacienteModel();

        if ($request->ajax()) {
            $folio = $request->folioPacienteCheck;
            // $img_parametros = $request->imagen_parametros;

            $params->temperatura = $request->temperaturaPaciente;
            $params->estatura = $request->estaturaPaciente;
            $params->peso = $request->pesoPaciente;
            $params->presion = $request->presionPaciente;
            $params->talla_medidas = $request->tallaPaciente;
            $params->respiracion = $request->respiracionPaciente;
            $params->pulso = $request->pulsoPaciente;

            // return "registrarParametrosPaciente";
        }

        if ($params->save()) {

            $folio_paciente = pacienteModel::where('no_paciente', '=', $folio)
                ->firstOrFail();
            $id_persona = $folio_paciente->id_paciente;
            $paciente_params->fk_paciente = $id_persona;
            $paciente_params->fk_parametros = $params->id;
            $paciente_params->fecha_hora = $fecha_hora;
            $paciente_params->save();

            if ($paciente_params !== "")
                return $params->id . ' ' . $id_persona;
        }
    }
    function datosConsultaPaciente(Request $request)
    {
        if ($request->ajax()) {
            $folio_consulta = $request->folio_consulta;

            $consultaPaciente = consultaModel::where('folio_consulta', '=', $folio_consulta)
                ->join('paciente', 'consulta.fk_paciente', '=', 'paciente.id_paciente')
                ->join('persona', 'paciente.fk_persona', '=', 'persona.id_persona')
                ->join('empleado', 'consulta.fk_empleado', '=', 'empleado.id_empleado')
                // ->join('persona', 'empleado.fk_persona', '=', 'persona.id_persona')
                ->join('consultorio', 'consulta.fk_consultorio', '=', 'consultorio.id_consultorio')
                ->join('turno', 'consulta.fk_turno', '=', 'turno.id_turno')
                ->join('parametros_paciente', 'consulta.fk_parametros_paciente', '=', 'parametros_paciente.id_parametros_paciente')
                ->join('encuesta_consulta', 'consulta.fk_encuesta_consulta', '=', 'encuesta_consulta.id_encuesta')
                ->firstOrFail();

            return $consultaPaciente;

            // return "datosConsultaPaciente";
        }
        return response()->json([
            'respuesta' => 500
        ]);
    }
}
