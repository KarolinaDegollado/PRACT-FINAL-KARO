<?php

use App\Http\Controllers\actualizacion_turno;
use App\Http\Controllers\ciudadController;
use App\Http\Controllers\clinicaController;
use App\Http\Controllers\consultaController;
use App\Http\Controllers\empleadoController;
use App\Http\Controllers\encuestaController;
use App\Http\Controllers\pacienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\paisController;
use App\Http\Controllers\personaController;
use App\Http\Controllers\usuarioController;
use App\Http\Controllers\estadoController;
use App\Http\Controllers\turnoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name("login.usuario");

Route::get('/dashboard', function () {
    return view('dashboard');
})->name("usuario.dashboard");

Route::get('/lista_turnos', function () {
    return view('lista_turnos');
})->name("lista.turnos");

Route::get('/lista_turnos', function(){
    return view('lista_turnos');
})->name('listaTurnos');


// RUTA PARA TOMAR Y PUBLICAR INSERCION EN MYSQL , ES OBLIGATORIO USAR GET Y POST.
Route::get('guardarPais', [paisController::class, 'ajaxRequestPais']);
Route::post('guardarEstado', [estadoController::class, 'guardarEstado'])->name("ajaxGuardar.estado");

// RUTA PARA TOMAR Y PUBLICAR INSERCION EN MYSQL DE PERSONA, USUARIO Y PACIENTE.
// Route::get("guardarUsuario", [pacienteController::class, ''])



// RUTAS PARA USUARIO
Route::get("/buscarUsuario", [usuarioController::class, 'ajaxRequestUsuario']);
Route::post('AjaxbuscarUsuario', [usuarioController::class, 'AjaxbuscarUsuario'])->name("AjaxbuscarUsuario");
Route::post('cerrarSesion', [usuarioController::class, 'cerrarSesion'])->name('cerrarSesion');

// RUTAS PARA GUARDAR PERSONA -> PACIENTE 
Route::get("/ajaxRequestPersona", [personaController::class, "ajaxRequestPersona"]);
Route::post('/guardarPersona', [personaController::class, 'ajaxGuardarPersona'])->name("ajaxGuardarPersona");
Route::get("/mostrarPacientes", [personaController::class, 'mostrarPacientes'])->name('mostrarPacientes');
// Route::


// RUTAS PARA BUSCAR PACIENTES
Route::post("pacienteInfo", [pacienteController::class, 'buscarPacienteID'])->name('buscarPacienteID');


// RUTAS PARA ENCUESTAS
Route::post("inicializarEncuesta", [encuestaController::class, 'inicializarEncuesta'])->name('buscarPersonaEncuesta');




// RUTA PARA SABER SI SE ACTUALIZO LA TABLA DE ACTUALIZACION_TURNO
route::post('verificarActTurno', [actualizacion_turno::class, 'verificarActTurno'])->name("verificarActTurno");
// PARA SABER LOS TURNOS ACTUALES EN LA TABLA DE TURNOS
route::post("verTurnosActuales", [turnoController::class, 'verTurnosActuales'])->name('verTurnosActuales');

// NOMBRE DE LOS ESTADOS
// route::get("dashboard", [estadoController::class, "nombreEstados"])->name("nombreEstados");

// BUSCAR CONSULTAS 
Route::get("lista_turnos", [consultaController::class, "verConsultasTurno"])->name('verConsultasTurno');

// ROUTE ERROR PAGE
Route::get("/errorLogin", function () {
    return view('errorLogin');
})->name('error.login');

// RUTA PARA VER PERFIL DE LA PERSONA
Route::post("/perfilPersona", [personaController::class, 'perfilPersona'])->name('perfilPersona');
// RUTA PARA ACTUALIZAR PERFIL DE LA PERSONA
Route::post("/actualizarPerfilPersona", [personaController::class, 'actualizarPerfilPersona'])->name('actualizarPerfilPersona');


// CONSULTAR CLINICAS
Route::get("/dashboard", [clinicaController::class, 'consultarClinicas'])->name("consultarClinicas");
Route::post("/seleccionarClinica", [clinicaController::class, 'seleccionarClinica'])->name("seleccionarClinica");



// GUARDAR CIUDAD 
Route::post("/registrarCiudad", [ciudadController::class, 'registrarCiudad'])->name('registrarCiudad');


// BUSCAR PERSONA 
Route::post("/buscarPersonaEmp", [personaController::class, 'buscarPersonaEmp'])->name("buscarPersonaEmp");


// REGISTRAR PARAMETROS DEL PACIENTE
Route::post("/registrarParametrosPaciente", [pacienteController::class, 'registrarParametrosPaciente'])->name("registrarParametrosPaciente");


Route::post("/ajaxGuardarEncuesta", [encuestaController::class, 'ajaxGuardarEncuesta'])->name("ajaxGuardarEncuesta");

// 25/07/2022

// RUTA PARA EDITAR PACIENTE
Route::post("/editarPersona", [personaController::class, 'editarPersona'])->name("editarPersona");

Route::post("miListaConsultasDoctor", [empleadoController::class, 'miListaConsultasDoctor'])->name('miListaConsultasDoctor');

// RUTA PARA CONSULTAR DATOS DE UNA CONSULTA
Route::post("/datosConsultaPaciente", [pacienteController::class, 'datosConsultaPaciente'])->name('datosConsultaPaciente');


Route::post("iniciarConsulta", [consultaController::class, 'iniciarConsulta'])->name('iniciarConsulta');

// RUTA PARA TERMINAR CONSULTA EN CURSO
Route::post('terminarConsultaEC', [consultaController::class, 'terminarConsultaEC'])->name('terminarConsultaEC');


// RUTA PARA VER LA EVIDENCIA DE LOS PARAMETROS TOMADOS
Route::post('evidenciaExFisico', [encuestaController::class, 'evidenciaExFisico'])->name('evidenciaExFisico');

// RUTA PARA VER LA EVIDENCIA DE LA ENCUESTA
Route::post('evidenciaEncuestaX', [encuestaController::class, 'evidenciaEncuestaX'])->name('evidenciaEncuestaX');
