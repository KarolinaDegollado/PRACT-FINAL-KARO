<?php

namespace App\Http\Controllers;

use App\Models\consultorio_doctorModel;
use App\Models\empleadoModel;
use Illuminate\Http\Request;
use App\Models\usuarioModel;

class usuarioController extends Controller
{
    public function ajaxRequestUsuario()
    {
        return view("/login");
    }

    // 25/07/2022
    public function AjaxbuscarUsuario(Request $req)
    {
        $usuario = new usuarioModel();
        $empleado = new empleadoModel();

        $u = $usuario->correo = $req->correo;
        $c = $usuario->contrasena = $req->contrasena;
        $resultado_query = usuarioModel::where('correo', '=', $u)
            ->where('contrasena', '=', $c)->join('persona', 'usuario.fk_persona', '=', 'persona.id_persona')->first()->toArray();
        $id_usuario = $resultado_query['id_usuario'];
        $correo = $resultado_query['correo'];
        $contrasena = $resultado_query['contrasena'];
        $mod = $resultado_query['tipo_usuario'];
        // if($resultado_query == NULL){
        //     return "vacio";
        $persona = $resultado_query['id_persona'];
        $empleado = empleadoModel::where('fk_persona', '=', $persona)->first();
        $empleadof = $empleado['id_empleado'];
        // }else{
        //     return "registro valores";
        // }

        // return $resultado_query;
        if ($u == $correo) {
            if ($c === $contrasena) {
                // $value = $req->session()->get('key');
                $req->session()->put('id_usuario', $resultado_query['id_usuario']);
                $req->session()->put('nombre', $resultado_query['nombre']);
                $req->session()->put('id_persona', $resultado_query['id_persona']);
                $req->session()->put('correo', $resultado_query['correo']);
                $req->session()->put('tipo_usuario', $resultado_query['tipo_usuario']);
                $req->session()->put('fk_empleado', $empleadof);
                // ESTADO 1 - USUARIO Y CONTRASENA EXITOSO
                if ($mod == "admin") {
                    return "user_sucss";
                }
                if ($mod == "doctor") {
                    return "user_sucss";
                }
            } else {
                // ERROR 3 - CONTRASEÑA INCORRECTA
                return "pass_err";
            }
        } else {
            // CEI = CORREO ELECTRONICO INEXISTENTE
            return "wrong_email";
        }
    }

    // 25/07/2022
    public function cerrarSesion(Request $request)
    {
        if ($request->ajax()) {
            $emp = $request->session()->get('fk_empleado');
            $cons = $request->session()->get('fk_consultorio');

            $actCons = new consultorio_doctorModel();
            $actCons = consultorio_doctorModel::where('fk_consultorio', '=', $cons)
                ->update(
                    [
                        "fk_empleado" => NULL,
                        "ocupado" => 0
                    ]
                );
            if ($actCons !== "") {
                session()->pull('id_usuario');
                session()->pull('nombre');
                session()->pull('correo');
                session()->pull('fk_consultorio');
                session()->pull('tipo_usuario');
                session()->pull('id_persona');
                session()->pull('fk_empleado');
                return "1";
            } else {
                session()->pull('id_usuario');
                session()->pull('nombre');
                session()->pull('correo');
                session()->pull('fk_consultorio');
                session()->pull('tipo_usuario');
                session()->pull('id_persona');
                return "1";
            }
        }
    }
}
