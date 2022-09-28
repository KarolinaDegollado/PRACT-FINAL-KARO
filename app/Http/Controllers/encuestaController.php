<?php

namespace App\Http\Controllers;

use App\Models\consultaModel;
use App\Models\consultorio_doctorModel;
use Illuminate\Http\Request;
use App\Models\encuestaModel;
use App\Models\pacienteModel;
use App\Models\turnoModel;
use App\Models\consultorioModel;
use App\Models\parametrospModel;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;





class encuestaController extends Controller
{
    function inicializarEncuesta(Request $request)
    {

        // PRIMERA FORMA CON WHERE Y = , VA DIRECTO A LA BUSQUEDA
        if ($request->ajax()) {
            $paciente = new pacienteModel();
            $no_paciente =  $paciente = $request->no_paciente;
            $paciente = pacienteModel::where(
                'no_paciente',
                '=',
                $no_paciente
            )
                ->join('persona', 'paciente.fk_persona', '=', 'persona.id_persona')
                ->get();
            return $paciente;
        }

        // SEGUNDA FORMA, CON LIKE, BUSCA MAS A DETALLE, PERO PASA POR VARIOS DATOS
        // if ($request->ajax()) {
        //     $paciente = new pacienteModel();
        //     $no_paciente =  $paciente = $request->no_paciente;
        //     $paciente = pacienteModel::where(
        //         'no_paciente',
        //         'like',
        //         '%' . $no_paciente . '%'
        //     )
        //         ->join('persona', 'paciente.fk_persona', '=', 'persona.id_persona')
        //         ->get();
        //     return $paciente;
        // }


        return view("dashboard");
    }
    //YA JALA, NO MOVER XD
    function ajaxGuardarEncuesta(Request $request)
    {
        if ($request->ajax()) {

            $fecha_hora = Carbon::now()->format('Y-m-d H:i:s');

            $encuesta = new encuestaModel();
            $consultorios = new consultorioModel();
            $encuesta->folio_encuesta = $request->folio_encuesta;
            $encuesta->fecha_hora_encuesta = $fecha_hora;
            $encuesta->resultado_encuesta = $request->puntaje_encuesta;
            $tipo_consulta = $request->tipo_consulta;
            $imagenEncuesta = $request->imagenEncuesta;

            $folderPath = "img/ev_encuesta/"; //PATH IMG
            // $imagenEncuesta = str_replace('data:image/png;base64,','', $imagenEncuesta);
            // $imagenEncuesta = str_replace(' ', '+', $imagenEncuesta);
            // $nombreImagen = Str::random(10).'.'.'png';
            $image_parts = explode(";base64,", $imagenEncuesta);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $uniqid = uniqid();
            $file = $folderPath . $uniqid . '.' . $image_type;
            $nombreImgEncuesta = $uniqid . '.' . $image_type;
            $encuesta->evidencia_encuesta = $nombreImgEncuesta;
            // Storage::disk('public/img/ev_encuesta')->put($nombreImagen, base64_decode($nombreImagen));
            $consulta = new consultaModel();



            // VARIABLES TABLA CONSULTA
            $folio_consulta = $request->folio_consulta;
            // $tipo_consulta1 = 1;
            // $tipo_consulta2 = 2;
            $fk_paciente = $request->fk_paciente;
            // $fk_empleado = $request->fk_empleado;

            $fk_parametros_paciente = $request->fk_parametros_paciente;
            $fk_encuesta_consulta = $request->fk_encuesta_consulta;


            // $consulta->fk_consultorio;
            // $consulta->fk_parametros_paciente;
            // $consulta->diagnostico_id_diagnostico;
            // $consulta->fk_encuesta_consulta;



            //SIGNIFICADO DE CADA NUMERO PARA TIPO DE CONSULTA
            //1 = URGENTE
            //2 = NORMAL - NO URGENTE


            // SIGNIFICADO PARA CADA NUMERO DEL TIPO TURNO
            // 1 = EN CONSULTA
            // 2 = EN ESPERA
            // 3 = EN PROCESO DE CONSULTA

            //PRIMERO CONSULTAR SI HAY O NO TURNOS ANTES DE INSERTAR UN NUEVO REGISTRO, ESTO ES POR SI NO HAY NINGUN REGISTRO O TURNO ANTERIOR LE ASIGNE EL VALOR
            // DE 1, OSEASE EL PRIMER TURNO

            $turno = new turnoModel();
            $fecha_actualServer = Carbon::now()->format('Y-m-d');

            $turno = turnoModel::where('turno.fecha_hora_turno', 'like', "%$fecha_actualServer%")
                ->first();
            $encuesta->save();
            file_put_contents($file, $image_base64);

            $idEncuesta = $encuesta->id;
            $fecha_hora = Carbon::now()->format('Y-m-d H:i:s');
            //PRIMERO: GUARDAR LOS RESULTADOS DE LA ENCUESTA
            //SEGUNDO: REVISAR LOS TURNOS
            //TERCERO: GUARDAR LOS TURNOS SEGUN EL ORDEN
            //CUARTO: REVISAR LOS CONSULTORIOS DISPONIBLES PARA CONSULTA EN EL ESTATUS_CONSULTA EN LA TABLA CONSULTORIO Y SACAR EL ID
            //QUINTO: SELECCIONAR EL CONSULTORIO Y EMPLEADO DE LA TABLA consultorio_doctor COMPARANDO CON EL CONSULTORIO DISPONIBLE
            //SEXTO: AL REGISTRAR 

            if ($turno == NULL) { //SI NO HAY TURNOS ANTES DE ESTE
                // return "NO hay turnos actualmente antes de este";

                // SI NO HAY TURNOS, SE DEBERA DE INICIALIZAR LOS TURNOS EN NUMERO 1
                // AQUI SERAN LOS MISMOS COMANDOS SOLO QUE A LA VARIABLE DE TURNO SE LE PONDRA 1 POR DEFAULT
                if ($tipo_consulta == 1) { // CUANDO LA CONSULTA ES URGENTE Y NO HAY TURNOS ANTES DE ESTE
                    //AQUI SE INSERTARA EL TURNO EN TURNO 1
                    $turno = new turnoModel();
                    $turno->folio_agenda_turno = $folio_consulta;
                    $turno->turno = 1;
                    $turno->fecha_hora_turno = $fecha_hora;
                    $turno->estatus_turno = 3;

                    if ($turno->save() == TRUE) {
                        //BUSCAR CONSULTORIOS QUE ESTEN EN SERVICIO

                        $consultorios_disponibles = new consultorio_doctorModel();

                        // IGUAL A 1 ES QUE ESTAN EN SERVICIO Y 0 ES QUE NO TIENE SERVICIO
                        //SACAR REGISTROS EN ORDEN RANDOM 
                        $consultorios_disponibles = consultorio_doctorModel::inRandomOrder()->where("ocupado", '1')->first();
                        // return $consultorios_disponibles->fk_consultorio;

                        $fk_paciente = $request->fk_paciente;
                        $folio_consulta = $request->folio_consulta;
                        $fk_parametros_paciente = $request->fk_parametros_paciente;
                        $fk_encuesta_consulta1 = $request->fk_encuesta_consulta;


                        if ($consultorios_disponibles == NULL) {
                            // BUSCAR EL CONSULTORIO Y EL ESTATUS QUE ESTE DISPONIBLE

                            $consulta->folio_consulta = $folio_consulta;

                            $consulta->tipo_consulta = 1;
                            $consulta->fk_paciente = (int)$fk_paciente;
                            $consulta->fk_turno = $turno->id;
                            $consulta->fk_parametros_paciente = (int) $fk_parametros_paciente;
                            $consulta->fk_encuesta_consulta = $idEncuesta;


                            if ($consulta->save() == TRUE) {
                                return $consulta->folio_consulta;
                            } else {
                                return "error";
                            }
                        } else {
                            //PARA GUARDAR LAS CONSULTAS QUE NO TIENEN CONSULTORIOS DISPONIBLES Y PASARLOS SIN DATOS DE EMPLEADO Y CONSULTORIO
                            $consulta->folio_consulta = $folio_consulta;

                            $consulta->tipo_consulta = 1;
                            $consulta->fk_paciente = (int)$fk_paciente;
                            $consulta->fk_empleado = $consultorios_disponibles->fk_empleado;
                            $consulta->fk_consultorio = $consultorios_disponibles->fk_consultorio;
                            $consulta->fk_turno = $turno->id;
                            $consulta->fk_parametros_paciente = (int) $fk_parametros_paciente;
                            $consulta->fk_encuesta_consulta = $idEncuesta;


                            if ($consulta->save() == TRUE) {
                                return $consulta->folio_consulta;
                            } else {
                                return "error";
                            }
                        }

                        // else {
                        //     // GUARDAR E INSERTAR EL REGISTRO EN PROCESO DE CONSULTA Y ESPERA

                        // }


                        // BUSCAR QUE EL CONSULTORIO TOMADO ESTE DISPONIBLE PARA CONSULTA





                        // PARAMETROS PARA GUARDAR CONSULTA
                        // $fk_encuesta = $encuesta->id;
                        // $id_turno = $turno->id;
                        // $consulta = new consultaModel();
                        // $consulta->folio_consulta = $folio_consulta;
                        // $consulta->tipo_consulta = 1;
                        // $consulta->fk_paciente = $fk_paciente;
                        // $consulta->fk_empleado = $fk_empleado;
                        // $consulta->fk_turno = $id_turno;
                        // $consulta->fk_parametros_paciente = $fk_parametros_paciente;
                        // $consulta->fk_encuesta_consulta = $fk_encuesta;
                    }
                } else if ($tipo_consulta == 2) {
                    // SI JALA 22/07/22
                    // CUANDO LA CONSULTA NO ES URGENTE Y NO HAY TURNOS ANTES DE ESTE
                    $turno = new turnoModel();
                    $turno->folio_agenda_turno = $folio_consulta;
                    $turno->turno = 1;
                    $turno->fecha_hora_turno = $fecha_hora;
                    $turno->estatus_turno = 2;

                    if ($turno->save() == TRUE) {

                        ///////////////////////////////////////////////////////
                        $consultorios_disponibles = new consultorio_doctorModel();
                        $consultorios_disponibles = consultorio_doctorModel::inRandomOrder()->where("ocupado", '1')->first();

                        if ($consultorios_disponibles == NULL) {

                            $consulta->folio_consulta = $folio_consulta;
                            $consulta->tipo_consulta = 2;
                            $consulta->fk_paciente = (int)$fk_paciente;
                            $consulta->fk_turno = $turno->id;
                            $consulta->fk_parametros_paciente = (int) $fk_parametros_paciente;
                            $consulta->fk_encuesta_consulta = $idEncuesta;

                            if ($consulta->save() == TRUE) {
                                return  $consulta->folio_consulta;
                            } else {
                                return "error2";
                            }
                        } else {
                            return "ErrorSturno";
                        }
                    }
                }
            } else if ($turno !== NULL) {
                // AQUI SERAN LOS MISMOS COMANDOS SOLO QUE A LA VARIABLE DE TURNO SE LE PONDRA EL TURNO SEGUN SU PRIORIDAD
                // SI HAY TURNOS SE DEBERA SEGUIR EL REGISTRO NORMALMENTE SEGUN LA PRIORIDAD
                // return "no hay turnos actualmente";
                $turnorec = new turnoModel();
                $t3 = new turnoModel();


                // 1 SI HAY TURNOS VERIFICAR QUE EL TURNO SI ES 1 O 2



                if ($tipo_consulta == 1) {
                    // return "SI HAY TURNOS EN CURSO ";

                    // CUANDO LA CONSULTA ES URGENTE Y SI HAY TURNOS ANTES DE ESTE.
                    $fecha = Carbon::now()->format('Y-m-d');
                    // return $fecha;

                    // EN CASO QUE HAYA TURNOS EN ESTATUS 2 SE VERIFICARA Y SE LE AUMENTARAN MAS 1

                    $turno2v = turnoModel::where('fecha_hora_turno', 'like', "$fecha%")
                        ->where('estatus_turno', '=', 2)
                        ->orderBy("turno", 'ASC')
                        ->first();

                    //VERIFICA QUE HAYA TURNOS EN ESTATUS 2, Y SI NO HAY QUIERE DECIR QUE HAY UN TURNO EN ESTATUS 3
                    $turnorec = turnoModel::where('fecha_hora_turno', 'like', "$fecha%")
                        ->where('estatus_turno', '=', 2)
                        ->increment('turno', 1);

                    if ($turnorec == 0) {
                        // return 'No registro ninguna consulta con estatus en espera';
                        $t3 = turnoModel::where('fecha_hora_turno', 'like', "$fecha%")
                            ->where('estatus_turno', '=', 3)
                            ->orderBy('turno', 'DESC')
                            ->first();

                        $registrots3 = new turnoModel();
                        $registrots3->folio_agenda_turno = $folio_consulta;
                        $registrots3->turno = $t3->turno + 1;
                        $registrots3->fecha_hora_turno = $fecha_hora;
                        $registrots3->estatus_turno = 3;

                        if ($registrots3->save()) {
                            $fkturno = $registrots3->id;

                            // return "Registro exitoso de consulta en ESTADO 3";
                            // AQUI SE GUARDA LA CONSULTA MEDICA

                            $consultorios_disponibles = new consultorio_doctorModel();
                            $consultorios_disponibles = consultorio_doctorModel::inRandomOrder()->where("ocupado", '1')->first();

                            if ($consultorios_disponibles == NULL) {

                                $consulta->folio_consulta = $folio_consulta;
                                $consulta->tipo_consulta = 1;
                                $consulta->fk_paciente = (int)$fk_paciente;
                                $consulta->fk_turno = $fkturno;
                                $consulta->fk_parametros_paciente = (int) $fk_parametros_paciente;
                                $consulta->fk_encuesta_consulta = $idEncuesta;

                                if ($consulta->save()) {
                                    return  $consulta->folio_consulta;
                                }
                            } else {
                                // CONSULTA CON CONSULTORIO EN ESTATUS PRIORITARIO Y EN PROCESO DE CONSULTA
                                $consulta->folio_consulta = $folio_consulta;
                                $consulta->tipo_consulta = 1;
                                $consulta->fk_paciente = (int)$fk_paciente;
                                $consulta->fk_empleado = $consultorios_disponibles->fk_empleado;
                                $consulta->fk_consultorio = $consultorios_disponibles->fk_consultorio;
                                $consulta->fk_turno = $fkturno;
                                $consulta->fk_parametros_paciente = (int) $fk_parametros_paciente;
                                $consulta->fk_encuesta_consulta = $idEncuesta;

                                if ($consulta->save()) {
                                    return  $consulta->folio_consulta;
                                }
                            }
                        }
                    } else {
                        // AQUI SE INCREMENTARON LOS NUMEROS, OSEA ENCONTRO UN 2
                        //TURNO DESPUES DEL PRIMER 2 A TURNO URGENTE
                        $nuevo_turno_actual = $turno2v->turno;

                        //REGISTRO DE VARIABLES PARA LA TABLA TURNO
                        $registrots3 = new turnoModel();
                        $registrots3->folio_agenda_turno = $folio_consulta;
                        $registrots3->turno = $nuevo_turno_actual;
                        $registrots3->fecha_hora_turno = $fecha_hora;
                        $registrots3->estatus_turno = 3;

                        if ($registrots3->save() == TRUE) {

                            //AQUI SE GUARDA LA CONSULTA MEDICA
                            $consultorios_disponibles = new consultorio_doctorModel();
                            $consultorios_disponibles = consultorio_doctorModel::inRandomOrder()->where("ocupado", '1')->first();

                            $consulta = new consultaModel();
                            if ($consultorios_disponibles == NULL) {

                                // return "SIN CONSULTORIOS DISPONIBLES";
                                $consulta->folio_consulta = $folio_consulta;
                                $consulta->tipo_consulta = 1;
                                $consulta->fk_paciente = (int)$fk_paciente;
                                $consulta->fk_turno = $nuevo_turno_actual;
                                $consulta->fk_parametros_paciente = (int) $fk_parametros_paciente;
                                $consulta->fk_encuesta_consulta = $idEncuesta;
                                $consulta->save();
                                // return $consulta;
                                if ($consulta !== "") {
                                    return $consulta->folio_consulta;
                                } else {
                                    return "no se guardo";
                                }
                            } else {
                                // return "CON CONSULTORIOS DISPONIBLES";

                                $consulta->folio_consulta = $folio_consulta;
                                $consulta->tipo_consulta = 1;
                                $consulta->fk_paciente = (int)$fk_paciente;
                                $consulta->fk_empleado = $consultorios_disponibles->fk_empleado;
                                $consulta->fk_consultorio = $consultorios_disponibles->fk_consultorio;
                                $consulta->fk_turno = $registrots3->id;
                                $consulta->fk_parametros_paciente = (int) $fk_parametros_paciente;
                                $consulta->fk_encuesta_consulta = $idEncuesta;

                                // return $consulta;
                                $consulta->save();
                                if ($consulta !== "") {
                                    return $consulta->folio_consulta;
                                } {
                                    return "No se guardo";
                                }
                            }
                        }
                    }
                } else if ($tipo_consulta == 2) {
                    // return "CONSULTA TIPO 2 CON TURNOS";
                    // CUANDO LA CONSULTA NO ES URGENTE Y NO HAY TURNOS ANTES DE ESTE.

                    // 
                    $turnorec = new turnoModel();
                    $turnorec = turnoModel::where('fecha_hora_turno', 'like', "$fecha_actualServer%")
                        ->orderBy('turno', 'DESC')
                        ->first();

                    $id_ultimoTurno2 = $turnorec->id_turno;
                    $turno_ultimoturno2 = $turnorec->turno;
                    // return $turnorec;
                    if ($turnorec == null) {
                        return "vacio";
                    } else {
                        $turnoFinal = new turnoModel();
                        $turnoFinal->folio_agenda_turno = $folio_consulta;
                        $turnoFinal->turno = $turno_ultimoturno2 + 1;
                        $turnoFinal->fecha_hora_turno = $fecha_hora;
                        $turnoFinal->estatus_turno = 2;

                        if ($turnoFinal->save()) {

                            $consultorios_disponibles = new consultorio_doctorModel();
                            $consultorios_disponibles = consultorio_doctorModel::inRandomOrder()->where("ocupado", '1')->first();

                            if ($consultorios_disponibles == NULL) {
                                $consulta->folio_consulta = $folio_consulta;
                                $consulta->tipo_consulta = 2;
                                $consulta->fk_paciente = (int)$fk_paciente;
                                $consulta->fk_turno = $turnoFinal->id;
                                $consulta->fk_parametros_paciente = (int) $fk_parametros_paciente;
                                $consulta->fk_encuesta_consulta = $idEncuesta;

                                if ($consulta->save()) {
                                    return $consulta->folio_consulta;
                                }
                            } else {
                                $consulta->folio_consulta = $folio_consulta;
                                $consulta->tipo_consulta = 2;
                                $consulta->fk_paciente = (int)$fk_paciente;
                                $consulta->fk_empleado = $consultorios_disponibles->fk_empleado;
                                $consulta->fk_consultorio = $consultorios_disponibles->fk_consultorio;
                                $consulta->fk_turno = $turnoFinal->id;
                                $consulta->fk_parametros_paciente = (int) $fk_parametros_paciente;
                                $consulta->fk_encuesta_consulta = $idEncuesta;

                                if ($consulta->save()) {
                                    return $consulta->folio_consulta;
                                }
                            }
                        } else {
                            return "errorTurno2";
                        }
                    }
                }
            }

            //     //ESTATUS CONSULTORIO 1=CONSULTORIO DISPONIBLE CON DOCTOR EN CONSULTA 0=CONSULTORIO NO DISPONIBLE CON NINGUN DOCTOR EN EL
            //     // ESTATUS CONSULTA 0 = CONSULTORIO SIN NINGUNA CONSULTA EN CURSO 1= CONSULTORIO CON UNA CONSULTA ACTUAL EN CURSO.

            //     $consultorios = consultorioModel::where("estatus_consulta", '=', 0)->where('estado_consultorio', '=', 1)->firstOrFail();
            //     return $consultorios;


        }
    }
    function verConsultoriosDisp()
    {
        return "verconsultoriosDisp";
    }
    function evidenciaExFisico(Request $request)
    {
        if ($request->ajax()) {
            $folio_consulta = $request->folio_consulta;
            $parametros = new consultaModel();
            $parametros = consultaModel::join('parametros_paciente', 'consulta.fk_parametros_paciente', 'parametros_paciente.id_parametros_paciente')
                ->where('consulta.folio_consulta', '=', $folio_consulta)
                ->first();

            return $parametros;
        }
    }
    function evidenciaEncuestaX(Request $request)
    {
        if ($request->ajax()) {
            $folio_consulta = $request->folio_consulta;
            $evidencia = new consultaModel();
            $evidencia = consultaModel::join('encuesta_consulta', 'consulta.fk_encuesta_consulta', 'encuesta_consulta.id_encuesta')
                ->where('consulta.folio_consulta', '=', $folio_consulta)
                ->first();
            return $evidencia;
        }
    }
}
