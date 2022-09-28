<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\personaModel;
use App\Models\pacienteModel;
use Illuminate\Support\Facades\DB;
// use Yajra\DataTables\DataTables;
use Yajra\DataTables\Facades\DataTables as DataTables;

class personaController extends Controller
{

    public function ajaxRequestPersona()
    {
        return view("/dashboard");
    }
    public function ajaxGuardarPersona(Request $req)
    {
        $persona = new personaModel();

        $persona->nombre = $req->nombre_persona;
        $persona->apaterno = $req->apaterno;
        $persona->amaterno = $req->amaterno;
        $persona->edad = $req->edad;
        $persona->fnac = $req->fnac;
        $persona->estatus_persona = 1;
        $persona->estatus_cuenta = 0;
        $persona->save();
        $lastIdPersona = personaModel::orderBy("id_persona", 'desc')->take(1)->first();
        $personaID = $lastIdPersona['id_persona'];


        if (($persona->save()) == TRUE) {

            $paciente = new pacienteModel();
            $paciente->no_paciente = $req->nombreUsuarioPaciente;
            $paciente->estatus = 1;
            $paciente->fk_persona = $personaID;

            if (($paciente->save()) == TRUE) {
                return $req->nombreUsuarioPaciente;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    public function mostrarPacientes(Request $request)
    {

        if ($request->ajax()) {
            // $personas = pacienteModel::select()->join('persona', 'paciente.fk_persona', '=', 'persona.id_persona')->get();
            $personas = pacienteModel::join('persona', 'paciente.fk_persona', '=', 'persona.id_persona')
                ->select('persona.*', 'paciente.*');

            return DataTables::of($personas)->addColumn('nombre_completo', function ($persona) {
                return $persona->nombre . ' ' . $persona->apaterno . ' ' . $persona->amaterno;
            })
                ->filterColumn('nombre_completo', function ($query, $keyword) {
                    $sql = "CONCAT(persona.nombre,' ',persona.apaterno,' ',persona.amaterno) like? ";
                    $query->whereRaw($sql, ["%$keyword%"]);
                })
                ->editColumn('estatus_persona', function ($query) {
                    return $query->estatus_persona == 1 ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-danger">Inactivo</span>';
                    // return $query->id_persona !== "" ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-success">Activo</span>';
                })
                ->editColumn('id_persona', function ($query) {
                    return "<button class='btn' onclick='verPacienteCard($query->id_persona)' style='background-color:#44AAEE; margin-left: 5%'><i class='fa-solid fa-address-book'></i><h8>&nbspDatos</h8></button> " . '<br> <br>' . "<button class='btn btn-warning' onclick='modificarPaciente($query->id_persona)' style='margin-left: 5%'> <i class='fa-solid fa-user-pen'></i><h8>Editar</h8></button>";
                })
                ->editColumn('id_paciente', function ($query) {
                    return "<button class='btn' onclick='irChequeoFisico($query->no_paciente)' style='background-color:#27AE60; margin-left: 5%'><i class='fa-solid fa-address-book'></i><h8>Consultar</h8></button>";
                })
                // ->addColumns("show",  '<a href="{{route(\'paciente.mostrarID\', $id)}}" class="btn btn-info btn-sm" onclick="enviarID()">'.('Ver').'</a>')
                // ->addColumns("edit",  '<a href="{{route(\'paciente.editID\', $id)}}" class="btn btn-info btn-sm" onclick="enviarID()">'.('Editar').'</a>')
                // ->addColumns("delete",  '<a href="{{route(\'paciente.mostrarID\', $id)}}" class="btn btn-info btn-sm" onclick="enviarID()">'.('Baja').'</a>')
                // ->rawColumns(['estatus_persona', 'show', 'edit', 'delete']);
                ->rawColumns(['estatus_persona', 'id_persona', 'id_paciente'])
                ->make(true);
        }
        // $personas = pacienteModel::select()->join('persona','paciente.fk_persona', '=', 'persona.id_persona')->get();
        // return view("/dashboard", compact("personas"));
        return view("/dashboard");
    }
    public function perfilPersona(Request $req)
    {
        if ($req->ajax()) {
            $persona = new personaModel();
            $id_persona = $req->id_persona;

            $persona = personaModel::where('id_persona', '=', $id_persona)
                ->firstOrFail();
            return $persona;
        }
    }

    public function actualizarPerfilPersona(Request $req)
    {
        if ($req->ajax()) {

            $actualizar = personaModel::where('id_persona', $req->id_personainput)
                ->update([
                    "nombre" => $req->nombrePersonaPerfil,
                    "apaterno" => $req->apPersonaPerfil,
                    "amaterno" => $req->amPersonaPerfil,
                    "fnac" => $req->fnacPersonaPerfil,
                    "edad" => $req->edadPersonaPerfil,
                    "estatus_persona" => $req->estatusPersonaPerfil
                ]);
            if ($actualizar) {
                return response()->json([
                    'respuesta' => 200
                ]);
            }
        }
        return response()->json([
            'respuesta' => 500 //INTERNAL SERVER ERROR;
        ]);
    }

    public function buscarPersonaEmp(Request $request)
    {
        if ($request->ajax()) {
            // $persona = $request->personaFind;
            // $consulta = personaModel::where('nombre', $persona)
            //     ->orWhere('apaterno', 'like', '%' . $persona . '%') ->get();
            // return $consulta;
            $persona = new personaModel();
            $nombreCompleto = $request->personaFind;
            $persona = personaModel::where(
                'nombre',
                'like',
                '%' . $nombreCompleto . '%'
            )->orWhere(
                'apaterno',
                'like',
                '%' . $nombreCompleto . '%'
            )->orWhere(
                'amaterno',
                'like',
                '%' . $nombreCompleto . '%'
            )->get();

            return $persona;
        }
    }

    public function editarPersona(Request $req)
    {
        if ($req->ajax()) {

            $actualizar = personaModel::where('id_persona', $req->id_PersonaPaciente)
                ->update([
                    "nombre" => $req->nombrePersonaPaciente,
                    "apaterno" => $req->apPersonaPaciente,
                    "amaterno" => $req->amPersonaPaciente,
                    "fnac" => $req->fnacPersonaPaciente,
                    "edad" => $req->edadPersonaPaciente,
                    "estatus_persona" => $req->estatusPersonaPaciente,
                ]);
            if ($actualizar) {
                return response()->json([
                    'respuesta' => 200
                ]);
            }
        }
        return response()->json([
            'respuesta' => 500 //INTERNAL SERVER ERROR;
        ]);
    }
}
