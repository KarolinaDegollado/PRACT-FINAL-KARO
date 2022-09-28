<?php
if (session('id_usuario')) {
    echo "";
} else {
    header('Location: errorLogin'); //Aqui lo redireccionas al lugar que quieras.
    die();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inicio</title>

    {{-- CSS  --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('js/html2canvas.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" src="{{ asset('css/app.css') }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-uuid/1.4.7/uuid.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.css" />
    <script src="https://kit.fontawesome.com/e9f5f6657f.js" crossorigin="anonymous"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->


    <!-- {{-- popper.js CSS example  --}} -->
    <style>
        #tooltip {
            background: #333;
            color: white;
            font-weight: bold;
            padding: 4px 8px;
            font-size: 13px;
            border-radius: 4px;
        }

        .card-space {
            margin-bottom: 20px;
        }

        html {
            height: 100%;
        }

        body {
            min-height: 100%;
        }

        .formConsultaMedica {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
        }

        .fullwidth {
            grid-column: span 2;
        }

        .submit {
            grid-column: 2;
            background-color: lightblue;
            padding: 10px;
        }


        .container {
            margin: 5vw 10vw;
        }

        input,
        textarea {
            padding: 5px;
        }

        * {
            padding: 0;
            margin: 0;
        }

        body {
            background: #ffffff;
        }

        .modal-content {
            border: 2px;
            border-radius: 5px;
        }

        .modal-header {
            background-color: #04bbc5;

        }

        .mr20 {
            margin-right: 20px;
        }

        .container {
            overflow: hidden;
            width: 1080px;
            padding: 40px 0;
            margin: 0 auto;
        }

        .box {
            cursor: pointer;
            display: block;
            float: left;
            width: 200px;
            margin-bottom: 50px;
        }

        .box .title {
            margin-bottom: 20px;
            font-family: Arial;
            font-size: 20px;
            font-weight: bold;
            line-height: 20px;
            color: #0E1644;
            text-align: center;
        }

        .box .svg {
            width: 180px;
            height: 180px;
            border-radius: 100%;
            margin: 0 10px;
            background: #FFF;
            box-shadow: 0 5px 5px #999;
            transition: all 0.2s linear;
        }

        .box:hover .svg {
            box-shadow: 0 5px 5px #666;
        }

        .svg g {
            transform-origin: 90px 90px;
            transition: all 0.2s linear;
        }

        .line {
            clear: both;
            width: 100%;
            height: 4px;
            margin-bottom: 20px;
            background: #04bba4;
        }

        /*Medical Square css begin*/
        #svg-medical-square .cls-1 {
            fill: none;
            stroke: #bcbec0;
            stroke-miterlimit: 10;
            stroke-width: 2px;
        }

        #svg-medical-square .cls-2 {
            fill: #bcbec0;
        }

        #svg-medical-square .cls-3 {
            fill: #414141;
        }

        #svg-medical-square .cls-4 {
            fill: #c4c4c4;
        }

        #svg-medical-square .cls-5 {
            fill: #d42d27;
        }

        #svg-medical-square .cls-6 {
            fill: #f5f5f5;
        }

        #svg-medical-square-g-01 {
            transform: rotate(30deg);
        }

        .svg:hover #svg-medical-square-g-01 {
            transform: rotate(120deg);
        }

        /*Medical Square css end*/
        /*Articles css begin*/
        #svg-articles .cls-1 {
            fill: #fbca62;
        }

        #svg-articles .cls-2 {
            fill: #ededed;
        }

        #svg-articles .cls-3 {
            fill: #dcdbdb;
        }

        #svg-articles .cls-4 {
            fill: #414141;
        }

        #svg-articles .cls-5 {
            fill: #d1d3d4;
        }

        #svg-articles .cls-6 {
            fill: #fff;
        }

        #svg-articles .cls-7 {
            fill: #f36e41;
        }

        #svg-articles .cls-8 {
            fill: #e6e5e5;
        }

        #svg-articles .cls-10,
        #svg-articles .cls-9 {
            fill: none;
            stroke-miterlimit: 10;
        }

        #svg-articles .cls-9 {
            stroke: #a7a9ac;
        }

        #svg-articles .cls-10 {
            stroke: #9cceee;
        }

        #svg-articles .cls-11 {
            fill: #5eb8e8;
        }

        #svg-articles-g-02 {
            transform: translateY(33px);
        }

        .svg:hover #svg-articles-g-02 {
            transform: translateY(-33px);
        }

        /*Articles css end*/
        /*Slide css begin*/
        #svg-slide .cls-1 {
            fill: #fff;
            stroke: #c4c4c3;
            stroke-width: 2px;
        }

        #svg-slide .cls-2 {
            fill: #263f6a;
        }

        #svg-slide .cls-3 {
            fill: #414141;
        }

        #svg-slide .cls-4 {
            fill: #546778;
        }

        #svg-slide .cls-5 {
            fill: #f26a50;
        }

        #svg-slide .cls-6 {
            fill: #9cceee;
        }

        #svg-slide .cls-7 {
            fill: #f79d87;
        }

        #svg-slide-g-01 {
            transform: scaleY(1);
        }

        #svg-slide-g-02 {
            transform: translateY(0);
        }

        #svg-slide-g-03 {
            transform: translateY(0);
        }

        #svg-slide-g-04 {
            opacity: 1;
        }

        #svg-slide-g-05 {
            transform: scale(0.6);
        }

        #svg-slide-g-06 {
            transform: translateY(0);
        }

        .svg:hover #svg-slide-g-01 {
            transform: scaleY(1.4);
        }

        .svg:hover #svg-slide-g-02 {
            transform: translateY(-11px);
        }

        .svg:hover #svg-slide-g-03 {
            transform: translateY(15px);
        }

        .svg:hover #svg-slide-g-04 {
            opacity: 0;
        }

        .svg:hover #svg-slide-g-05 {
            transform: scale(1);
        }

        .svg:hover #svg-slide-g-06 {
            transform: translateY(15px);
        }

        /*Slide css end*/
        /*FAQ css begin*/
        #svg-faq .cls-1 {
            fill: #263f6a;
        }

        #svg-faq .cls-2 {
            fill: #cccbca;
        }

        #svg-faq .cls-3 {
            fill: #fff;
            stroke: #c4c4c3;
            stroke-miterlimit: 10;
            stroke-width: 2px;
        }

        #svg-faq .cls-4 {
            fill: #7d605b;
        }

        #svg-faq .cls-5 {
            fill: #f26a50;
        }

        #svg-faq-g-01 {
            transform: scale(1) translateY(0);
        }

        #svg-faq-g-02 {
            transform: scale(1) translateX(-5px);
        }

        #svg-faq-g-03 {
            transform: scale(1);
        }

        .svg:hover #svg-faq-g-01 {
            transform: scale(0.8) translateY(30px);
        }

        .svg:hover #svg-faq-g-02 {
            transform: scale(1.3) translateX(3px);
        }

        .svg:hover #svg-faq-g-03 {
            transform: scale(1.3);
        }

        /*FAQ css end*/
        /*Guideline css begin*/
        #svg-guideline .st0 {
            fill: none;
            stroke: #F26A50;
            stroke-width: 8;
            stroke-miterlimit: 10;
        }

        #svg-guideline .st1 {
            fill: none;
            stroke: #C4C4C3;
            stroke-width: 4;
            stroke-miterlimit: 10;
        }

        #svg-guideline .st2 {
            fill: #9CCEEE;
        }

        #svg-guideline .st3 {
            fill: #BDB4AE;
        }

        #svg-guideline .st4 {
            fill: #213646;
        }

        #svg-guideline .st5 {
            fill: #263F6A;
        }

        #svg-guideline-g-01 {
            transform: scale(0.5) translateX(-60px);
        }

        #svg-guideline-g-02 {
            opacity: 1;
        }

        .svg:hover #svg-guideline-g-01 {
            transform: scale(1) translateX(0);
        }

        .svg:hover #svg-guideline-g-02 {
            opacity: 0;
        }

        /*Guideline css end*/
        /*Lilly Product css begin*/
        #svg-lilly-product .cls-1 {
            fill: #c4c4c4;
        }

        #svg-lilly-product .cls-2 {
            fill: #d42d27;
        }

        #svg-lilly-product .cls-3 {
            fill: #fff;
        }

        #svg-lilly-product .cls-4 {
            fill: #4d4d4e;
        }

        #svg-lilly-product .cls-5 {
            fill: #7d605b;
        }

        #svg-lilly-product .cls-6 {
            fill: #4d4d4d;
        }

        #svg-lilly-product-g-01 {
            transform: translateY(-15px);
        }

        #svg-lilly-product-g-02 {
            transform: translate(0, -15px) rotate(0);
        }

        #svg-lilly-product-g-03 {
            opacity: 0;
            transform: translateX(0) scale(0);
        }

        .svg:hover #svg-lilly-product-g-01 {
            transform: translateY(0px);
        }

        .svg:hover #svg-lilly-product-g-02 {
            transform: translate(-5px, -5px) rotate(-45deg);
        }

        .svg:hover #svg-lilly-product-g-03 {
            opacity: 1;
            transform: translateX(20px) scale(1);
        }

        /*Lilly Product css end*/
        /*Corporate Site css begin*/
        #svg-corporate-site .cls-1 {
            fill: #dcdbdb;
        }

        #svg-corporate-site .cls-2 {
            fill: #9cceee;
        }

        #svg-corporate-site .cls-3,
        #svg-corporate-site .cls-4 {
            fill: none;
            stroke-miterlimit: 10;
            stroke-width: 4px;
        }

        #svg-corporate-site .cls-3 {
            stroke: #9cceee;
        }

        #svg-corporate-site .cls-4 {
            stroke: #f26a50;
        }

        #svg-corporate-site-g-01 {
            transform: translate(0, 0) rotate(0) scale(1);
        }

        #svg-corporate-site-g-02 {
            transform: translate(0, 0) rotate(0);
            opacity: 1;
        }

        #svg-corporate-site-g-03 {
            transform: translate(0, 0) rotate(0);
            opacity: 0;
        }

        .svg:hover #svg-corporate-site-g-01 {
            transform: translate(-5px, 20px) rotate(-30deg) scale(0.8);
        }

        .svg:hover #svg-corporate-site-g-02 {
            transform: translate(-5px, 15px) rotate(-20deg);
            opacity: 0;
        }

        .svg:hover #svg-corporate-site-g-03 {
            transform: translate(-5px, 15px) rotate(-20deg);
            opacity: 1;
        }

        /*Corporate Site css end*/
        /*Product Information css begin*/
        #svg-product-information .cls-1 {
            fill: #f26a50;
        }

        #svg-product-information .cls-2 {
            fill: #c4c4c4;
        }

        #svg-product-information .cls-3 {
            fill: #9cceee;
        }

        #svg-product-information .cls-4 {
            fill: #7d605b;
        }

        #svg-product-information .cls-5 {
            fill: #fff;
        }

        #svg-product-information .cls-6 {
            fill: #d42d27;
            transition: all 0.2s linear;
        }

        #svg-product-information-g-01 {
            transform: translateY(0) scale(1);
        }

        #svg-product-information-g-02 {
            transform: translateY(-5px) scale(0.8);
        }

        #svg-product-information-g-02 .cls-6 {
            fill: #653E2D;
        }

        .svg:hover #svg-product-information-g-01 {
            transform: translateY(10px) scale(0.9);
        }

        .svg:hover #svg-product-information-g-02 {
            transform: translateY(0) scale(1);
        }

        .svg:hover #svg-product-information-g-02 .cls-6 {
            fill: #d42d27;
        }

        /*Product Information css end*/
        /*Digital Tool css bgin*/
        #svg-digital-tool .cls-1 {
            fill: #ffd99c;
        }

        #svg-digital-tool .cls-2 {
            fill: #555;
        }

        #svg-digital-tool .cls-3 {
            fill: #414141;
        }

        #svg-digital-tool .cls-4 {
            fill: #5eb8e8;
        }

        #svg-digital-tool .cls-5 {
            fill: #fff;
        }

        #svg-digital-tool-g-01 .cls-4 {
            fill: #F66D43;
            transition: all 0.2s linear;
        }

        #svg-digital-tool-g-02 {
            opacity: 1;
        }

        #svg-digital-tool-g-03 {
            opacity: 0;
        }

        #svg-digital-tool-g-04 {
            transform: translate(0, 0) rotate(0);
        }

        .svg:hover #svg-digital-tool-g-01 .cls-4 {
            fill: #5eb8e8;
        }

        .svg:hover #svg-digital-tool-g-02 {
            opacity: 0;
        }

        .svg:hover #svg-digital-tool-g-03 {
            opacity: 1;
        }

        .svg:hover #svg-digital-tool-g-04 {
            transform: translate(-8px, 15px) rotate(-30deg);
        }
    </style>
</head>


<body>
    <input type="text" id="clinicasesion" name="clinicasesion" value="{{session('fk_consultorio')}}" hidden>
    <!-- VERSION BLANCA -->




    <!-- @php
    if(session('tipo_usuario') == "doctor") {
    echo "
        <script>
            $('#registrarPacienteOption').attr('hidden', true);
        </script>
    ";
    } else if (session('tipo_usuario') == "admin") {
    echo "
        <script>
            console.log('admin')
            $('#registrarPacienteOption').attr('d-none');
        </script>
    ";
    } else {
    echo "NINGUN USUARIO";
    }
    @endphp -->






    <nav class="navbar navbar-expand-lg navbar-light fs-6 fw-bolder  shadow p-3 mb-5 bg-white rounded" style="background-color:#44AAEE;">

        <div class="container-fluid">
            <img src="{{url('/images/logos/hospital.png')}}" style="width: 35px;" />
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" href="#" aria-current="page" data-bs-toggle="modal" data-bs-target="#menuPacientes">Pacientes</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="#">Encuestas</a>
                    </li>-->
                    @if(session('tipo_usuario')=='doctor')
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalConsultasPacientes">Mi lista de consultas</a>
                    </li>
                    @endif
                    @if(session('tipo_usuario')=='admin')
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#modalCheckPaciente2" onclick="borrarFolioPaciente()" hidden>Iniciar encuesta(manual)</a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/lista_turnos')}}">Lista de turnos</a>
                    </li>
                    <!-- ACTIVAR ESTE AL FINAL -->
                    <!-- @if(session('tipo_usuario')=="admin") -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" href="#">Estado/Ciudades</a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink12">
                            <!-- <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalListaEstado">Lista paises</a></li>-->
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalRegistroEstado">Registro de Estados</a></li>
                            @if(session('tipo_usuario')=='')
                            <li><a href="#" class="dropdown-item" data-bs-target="#modalCuestionarioPaso2" data-bs-toggle="modal" data-bs-dismiss="modal">ENCUESTA(TEST)</a></li>
                            @endif
                            <li><a href="#" class="dropdown-item" data-bs-target="#modalRegistroCiudad" data-bs-toggle="modal" data-bs-dismiss="modal">Registro de ciudad</a></li>
                            <!--<li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-dismiss="modal" onclick="verConsultas()">Consultas en turno</a></li>-->
                        </ul>
                    </li>
                    <!-- @endif -->

                    @if(session('tipo_usuario')=="admin")
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" href="#">Empleados</a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink12">
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalRegistroDoctor">Asignar matricula</a></li>
                            <!-- <li><a class="dropdown-item" href="#" disabled>Opcion no disponible</a></li>-->
                        </ul>
                    </li>
                    @endif
                </ul>

                <span class="nav-item" style="margin: 5px 5px 5px;" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    My Emergency Assistant
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <li><a class="dropdown-item" href="#" onclick='abrirPerfil()'>Mi perfil</a></li>
                                    <li><a href="#" class="dropdown-item" onclick="systemVersion()">Sistema</a></li>
                                    <li><a href="#" class="dropdown-item" onclick="cerrarSesion()">Cerrar sesion</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </span>
            </div>
        </div>
    </nav>

    <!--ANEXOS-->

    @if(session('tipo_usuario')=='admin')
    <div class="container">
        <!-- MODAL APLICAR ENCUESTA ADMIN -->
        <div class="box mr20">
            @if(session('tipo_usuario')=='admin')

            <a onclick="avisoEncuesta()">
                <div class="title">Encuesta</div>
                <div class="svg">
                    <!-- <svg id="svg-slide" width="180" height="180" viewBox="0 0 200 200">
                        <title>Encuesta</title>
                        <g id="svg-slide-g-01">
                            <rect class="cls-1" x="55.28" y="62.44" width="90.19" height="66.13" />
                        </g>
                        <g id="svg-slide-g-02">
                            <rect class="cls-2" x="51.38" y="54.43" width="98" height="8.01" />
                        </g>
                        <g id="svg-slide-g-03">
                            <rect class="cls-4" x="99.3" y="131.89" width="2.15" height="5.53" />
                            <path class="cls-5" d="M100.37,135.87a5,5,0,1,0,5,5A5,5,0,0,0,100.37,135.87Zm0,7.91a2.87,2.87,0,1,1,2.87-2.88A2.88,2.88,0,0,1,100.37,143.78Z" />
                            <rect class="cls-2" x="51.38" y="128.57" width="98" height="3.32" />
                        </g>
                        <g id="svg-slide-g-04">
                            <rect class="cls-3" x="60.56" y="72.17" width="50" height="2" />
                            <rect class="cls-3" x="60.56" y="68.17" width="38" height="2" />
                        </g>
                        <g id="svg-slide-g-05">
                            <path class="cls-6" d="M110.58,83.14l9.55-14.2c-5.71-4.09-11.86-6.5-20.86-6.5V79.88C104.66,79.88,107.72,81.1,110.58,83.14Z" />
                            <path class="cls-7" d="M115.14,97.08a14.31,14.31,0,0,1-2.1,7.45L125.38,112a28.8,28.8,0,0,0-7.9-38.36l-8.37,11.72A14.37,14.37,0,0,1,115.14,97.08Z" />
                            <path class="cls-2" d="M113,104.53a14.38,14.38,0,0,1-12.3,6.95c-8,0-15.14-6.45-15.14-14.4s6.46-14.4,13.66-14.4V68.28c-14.4,0-28.06,12.89-28.06,28.8s13.26,28.8,29.17,28.8A29.1,29.1,0,0,0,125.19,112Z" />
                        </g>
                        <g id="svg-slide-g-06">
                            <rect class="cls-6" x="60.56" y="118.17" width="6" height="6" />
                            <rect class="cls-7" x="86.56" y="118.17" width="6" height="6" />
                            <rect class="cls-2" x="111.56" y="118.17" width="6" height="6" />
                            <rect class="cls-3" x="119.56" y="121.17" width="20" height="1" />
                            <rect class="cls-3" x="94.56" y="121.17" width="10" height="1" />
                            <rect class="cls-3" x="68.56" y="121.17" width="10" height="1" />
                        </g>
                    </svg> -->
                    <img src="{{asset('logos/encuesta.png')}}" alt="" width="90%" style="margin-left: 20px ;">
                    <!-- <img src="https://svgsilh.com/svg/1040248.svg" width="180" height="180" viewBox="0 0 200 200"> -->
                </div>
            </a>
            @endif
        </div>



        <!-- MODAL REVISION FISICA ADMIN -->
        <div class="box">
            <a data-bs-toggle="modal" data-bs-target="#modalCheckPaciente2">
                <div class="title">Revisión física</div>
                <div class="svg">
                    <img src="{{asset('logos/revision.png')}}" alt="" width="91%" style="margin-left: 10px; margin-top: 10px;">
                </div>
            </a>
        </div>

        <!-- MODAL REGISTRAR PACIENTE ADMIN -->
        <div class="box mr20">

            @if(session('tipo_usuario')=='admin')

            <div class="title">Registrar pacientes</div>

            <a onclick="registroPaciente()">
                <!-- data-bs-toggle="modal" data-bs-target="#menuPacientes" -->
                <div class="svg">
                    <img src="{{asset('logos/personas.png')}}" alt="" width="90%" style="margin-left: 8px; margin-top: 10px;">
                </div>
            </a>
            @endif
        </div>

        <!-- MODAL REGISTRO  ADMIN/DOCTOR-->
        <div class="box mr20">
            <a data-bs-toggle="modal" data-bs-target="#modalRegistroDoctor">
                <div class="title">Matriculas</div>
                <div class="svg">
                    <img src="{{asset('logos/kyc.png')}}" alt="" width="85%" style="margin-left: 25px ;">

                </div>
            </a>
        </div>

        <!-- MODAL REGISTRO DE ESTADOS  ADMIN-->
        <div class="box mr20">
            <a data-bs-toggle="modal" data-bs-target="#modalRegistroEstado">
                <div class="title">Registro Estado</div>
                <div class="svg">
                    <img src="{{asset('logos/pueblo.png')}}" alt="" width="80%" style="margin-left: 20px ;">

                </div>
            </a>
        </div>




        <!-- LINEA  -->
        <div class="line"></div>





    </div>
    @endif

    @if(session('tipo_usuario')=='doctor')
    <div class="container">
        <!-- DOCTOR -->
        <!-- MODAL MI LISTA DE CONSULTA PACIENTES  DOCTOR-->
        <div class="box mr20">
            <a data-bs-toggle="modal" data-bs-target="#modalConsultasPacientes">
                <!-- data-bs-toggle="modal" data-bs-target="#menuPacientes" -->
                <div class="title">Mi lista de consultas</div>
                <div class="svg">
                    <img src="{{asset('logos/prueba.png')}}" alt="" width="90%" style="margin-left: 10px ; margin-top: 10px;">
                </div>
            </a>
        </div>

        <!-- MODAL LISTA DE PACIENTES ADMIN/DOCTOR -->
        <div class="box mr20">
            <div class="title">Lista de pacientes</div>
            <a onclick="verListaPacientes()">
                <div class="svg">
                    <img src="{{asset('logos/personas.png')}}" alt="" width="90%" style="margin-left: 10px; margin-top:10px;">
                </div>
            </a>
        </div>

        <!-- MODAL MI PERFIL ADMIN/DOCTOR -->
        <div class="box">
            <div class="title">Mi perfil</div>
            <a onclick='abrirPerfil()'>
                <div class="svg">
                    <img src="{{asset('logos/usuario.png')}}" alt="" width="90%" style="margin-left: 10px; margin-top:10px">
                </div>
            </a>
        </div>

        <!-- VERSION DEL SISTEMA ADMIN/DOCTOR-->
        <div class="box mr20">
            <div class="title">Versión del sistema</div>
            <a onclick="systemVersion() ">
                <div class="svg">
                    <img src="{{asset('logos/system.png')}}" alt="" width="85%" style="margin-left: 16px; margin-top:11px;">
                </div>
            </a>
        </div>
        <div class="line"></div>

    </div>

    @endif





    <!--ANEXOS-->



    <!-- <hr style="height: 1px"> -->
    <div hidden>
        <p id="bodyjQuery">
            VALUES FORMULARIO REGISTRAR CONSULTA


            <!-- SE TOMARA CUANDO SE REGISTRE EL TURNO  -->
        <div>TIPO CONSULTA</div>
        <!-- 1 urgente y 2 normal -->
        <input type="text" id="tipo_consulta">
        <div>FK PACIENTE CONSULTA</div>

        <!-- CUANDO SE REGISTRE LA ENCUESTA APARECERA EL PACIENTE QUE TOMO LA ENCUESTA -->
        <input type="text" id="fk_paciente">
        <!-- EN EMPLEADO APARECERA EL DOCTOR QUE TOMO EL TURNO DE LA CONSULTA-->
        <div> EMPLEADO DOCTOR</div>

        <input type="text" id="fk_empleado">
        <!-- EL CONSULTORIO SE ASIGNARA CUANDO EL DOCTOR TOME EL TURNO -->
        <div>CONSULTORIO</div>

        <input type="text" id="fk_consultorio">
        <!-- SE ASIGNARA CUANDO SE HAYA REGISTRADO PRIMERO EL TURNO -->
        <div>FK TURNO</div>

        <input type="text" id="fk_turno">
        <!-- SE ASIGNARA CUANDO SE HAYAN TOMADO LOS PARAMETROS AL PACIENTE -->
        <div>ID PARAMETROS PACIENTE</div>

        <input type="text" id="fk_parametros_paciente">
        <!-- SE ASIGNARA CUANDO SE HAYA TERMINADO DE RESPONDER LA ENCUESTA -->
        <div>FK ENCUESTA</div>

        <input type="text" id="fk_encuesta_consulta">

        </p>
    </div>

    <!-- 25/07/2022 -->
    <div class="modal fade" id="modalListaPersonas" tabindex="-1" aria-labelledby="modalListaPersonas" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">LISTA DE PACIENTES</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="contenedor" name="contenedor" class="">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-hover responsive pacientes_table" style="width: 100%;" id="tablePersonasDatatable">
                                        <div class="table-responsive">
                                            <thead>
                                                <tr>

                                                    <th scope="col">Nombre completo</th>
                                                    <th scope="col">Edad</th>
                                                    <th scope="col">Fecha Nacimiento</th>
                                                    <th scope="col">Estatus</th>
                                                    <th scope="col">Opciones</th>
                                                    <th scople='col'>Consultar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </div>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- 25/07/2022 -->
    <!-- modalConsultarPaciente -->
    <!-- MODAL EDITAR PERSONA -->
    <div class="modal fade" id="modalDatosPersona" tabindex="-1" aria-labelledby="modalDatosPersona" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-0" style="border-radius: 0.5px; background-color: #2EA189; border: 1px solid white">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">MODIFICAR DATOS DEL PACIENTE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="form-actualizarPersona" name="form-actualizarPersona">
                        <input type="text" name="id_PersonaPaciente" id="id_PersonaPaciente" hidden>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <h6 class="col-sm-4 ms-auto">Nombre persona:
                                        <input type="text" class="form-control" id="nombrePersonaPaciente" name="nombrePersonaPaciente">
                                    </h6>

                                    <h6 class="col-sm-4 ms-auto">Apellido materno:
                                        <input type="text" class="form-control" id="apPersonaPaciente" name="apPersonaPaciente">
                                    </h6>
                                    <h6 class="col-sm-4 ms-auto">Apellido paterno:
                                        <input type="text" class="form-control" id="amPersonaPaciente" name="amPersonaPaciente">
                                    </h6>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <h6 class="col-sm-4 ms-auto">Fecha de nacimiento:
                                        <input type="date" class="form-control" id="fnacPersonaPaciente" name="fnacPersonaPaciente">
                                    </h6>

                                    <h6 class="col-sm-4 ms-auto">Edad:
                                        <input type="text" class="form-control" id="edadPersonaPaciente" name="edadPersonaPaciente">
                                    </h6>

                                    <h6 class="col-sm-4 ms-auto">Estatus de persona:

                                        <select name="estatusPersonaPaciente" id="estatusPersonaPaciente" class="form-control" name="estatusPersonaPaciente">
                                            <option>Selecciona una opción</option>
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                        <!-- <input type="text" class="form-control" id="estatusPersonaPaciente"> -->

                                    </h6>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-8 ms-auto">
                                            </div>
                                            <div class="col-sm-4 ms-auto">
                                                <button type="submit" class="btn btn-primary" style="margin-left: 34%">Guardar cambios</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- 25/07/2022 -->
    <!-- MODAL LISTA DE CONSULTAS A ATENDER -->
    <div class="modal fade" id="modalConsultasPacientes" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalConsultasPacientes" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CONSULTAS PRÓXIMAS A ATENDER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <table class="table table-bordered table-striped misConsultasMedico" style="width: 100%;" id="tablemisConsultasMedicoDatatable">
                        <thead>
                            <tr>
                                <!-- <th scope="col">Folio paciente</th> -->
                                <!-- <th scope="col">No. Paciente</th> -->
                                <th scope="col">Folio de consulta</th>
                                <th scope="col">Nombre completo</th>

                                <!-- <th scope="col">Nombre</th>
                                    <th scope="col">Apellido paterno</th>
                                    <th scope="col">Apellido materno</th> -->
                                <th scope="col">Tipo de consulta</th>
                                <th scope="col">Turno</th>
                                <th scope="col">Consultorio</th>
                                <th scope="col">Estatus turno</th>
                                <th scope="col">Opciones</th>

                                <!-- <th scope="col">Ver</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Dar de baja</th> -->
                                <!-- th scope="col">Acciones</th> -->
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- 25/07/2022 -->
    <!-- MODAL EN CONSULTA MEDICA-->
    <div class="modal fade" id="modalConsultaEnMedica" tabindex="-1" aria-labelledby="modalConsultaEnMedica" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ATENDIENDO A: &nbsp
                        <h5 class="modal-title" id="consultaMedicaNombrePac"></h5>
                        &nbsp -
                        [&nbsp
                        <h5 class="modal-title" id="consultaMedicaFolioPac">[ ]</h5>
                        &nbsp]
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="form-ActualizarConsulta" name="form-ActualizarConsulta">
                        <div class="row ">
                            <div class="col-sm-12">
                                <h6 class="col-sm-8">
                                    FOLIO DE CONSULTA
                                    <input type="text" class="form-control" name="id_folioActConsulta" id="id_folioActConsulta" readonly>
                                </h6>
                                <h6 class="col-sm-8">NUMERO DE TURNO:
                                    <input type="text" class="form-control" id="numeroTurnoEConsulta" name="numeroTurnoEConsulta" readonly>
                                </h6>
                                <h6 class="col-sm-8">FECHA & HORA DE INICIO DE CONSULTA
                                    <input type="text" class="form-control" id="fechaHInicioConsulta" name="fechaHInicioConsulta" readonly>
                                </h6>

                                <h6 class="col-sm-8">FECHA & HORA FINAL DE LA CONSULTA
                                    <input type="text" class="form-control" id="fechaHFinalConsulta" name="fechaHFinalConsulta" readonly>
                                </h6>
                                <h6 class="col-sm-8">TIPO DE CONSULTA
                                    <input type="text" class="form-control" id="tipoConsultaC" name="tipoConsultaC" readonly>
                                </h6>

                                <h6 class="ms-auto">
                                    DESCRIBE EL DIAGNOSTICO FINAL DEL PACIENTE:
                                    <textarea name="diagnosticoPacienteConsulta" id="diagnosticoPacienteConsulta" cols="5" rows="4" class="form-control"></textarea>
                                </h6>
                                <h6 class="col-sm-12 ms-auto">Resultados <br>
                                    <button class="btn btn-secondary btn-sm" style="margin-top: 5px;" id="revisionFisicaResultado">Revision fisica</button>
                                    <button class="btn btn-success btn-sm" style="margin-top: 5px;" id="revisionEncuestaResultado">Encuesta</button>

                                    <!-- <input type="text" class="form-control" id="edadPersonaPaciente" name="edadPersonaPaciente"> -->
                                </h6>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <p id="parrafoxsds"></p>
                        <button class="btn btn-warning" id="iniciarConsultaInit">Iniciar consulta</button>
                        <button class="btn btn-success" id="TerminarConsultaFin">Terminar consulta</button>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <!-- MODAL EJEMPLO -->

    <div class="modal fade " id="ModalTogglePaciente" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-fullscreen-sm">
            <div class="modal-content" style="--bs-bg-opacity: .8; border-radius: 0.5px; border: 1px solid white">
                <div class="modal-header" style="border-radius: 0.5px;">
                    <h5 class="modal-title">DATOS DEL PACIENTE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"><span class="visually-hidden">Close</span></button>
                </div>
                <div class="card-body ">

                    <!-- <img src="{{url('/images/logos/user-logo2.png')}}" class="rounded-circle" alt="" style="width: 30%"> -->

                    <h6 class="card-header" id="datosNombrePacienteModal" style="margin-bottom: 5px; margin-left: 1px; text-align: center; "></h6>
                    <div class="card-header shadow p-3 mb-5 bg-white rounded">

                        <img src="{{url('/images/logos/z.png')}}" class="card-img-top" alt="..." style="width: 39%; margin-left: 30%;">

                        <h6>PACIENTE: </h6>
                        <div class="card-text fw-semibold" id="datosNoPacienteModal"></div>
                        <h6>FECHA DE NACIMIENTO: </h6>
                        <div class="card-text fw-semibold" id="datosFnacModal"></div>
                        <h6>EDAD: </h6>
                        <div class="card-text fw-semibold" id="datosEdadModal"></div>
                        <h6>ESTATUS: </h6>
                        <p class="card-text fw-semibold" id="datosEstatusModal"></p>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>

</html>
<script>
    function cerrarModalC() {
        $("#modalConsultasPacientes").modal('hide');

    }

    $("#TerminarConsultaFin").on('click', function(e) {
        e.preventDefault()
        console.log('CLICK CONSULTA FIN')
        var diagnostico = $("#diagnosticoPacienteConsulta").val();
        var folio_consulta = $("#id_folioActConsulta").val();

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        console.log("TERMINAR CONSULTA");
        console.log()
        $.ajax({
            type: 'POST',
            url: "{{route('terminarConsultaEC')}}",
            data: {
                "diagnostico_consulta": diagnostico,
                "folio_consulta": folio_consulta
            },
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            success: function(respuesta) {
                console.log(respuesta)
                if (respuesta == 1) {
                    $("#form-ActualizarConsulta")[0].reset();
                    $("#modalConsultaEnMedica").modal('hide');
                    $("#iniciarConsultaInit").removeClass('d-none');

                    Toast.fire({
                        icon: 'success',
                        title: 'Se ha finalizado la consulta'
                    })
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Error al finalizar la consulta'
                    })
                }
            }

        })
    })


    function checkPaciente2Process() {
        var folio_paciente = $("#buscarNombreUserCE").val();
        $("#folioPacienteCheck").val(folio_paciente);

        setTimeout(function() {
            $("#buscarNombreUserCE").val('');
        }, 1000);
    }

    function borrarFolioPaciente() {
        $("#folioPacienteCheck").val('');
    }

    // 25/07/2022
    $("#iniciarConsultaInit").on('click', function(e) {
        e.preventDefault()
        $("#iniciarConsultaInit").addClass('d-none');

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        console.log("INICIAR CONSULTA INIT");
        var folio_consulta = $("#id_folioActConsulta").val();
        $.ajax({
            type: 'POST',
            url: "{{route('iniciarConsulta')}}",
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            data: {
                'folio_consulta': folio_consulta
            },

            success: function(respuesta) {
                console.log(respuesta)
                if (respuesta == 1) {
                    $("#tablemisConsultasMedicoDatatable").DataTable().ajax.reload();
                    $("#modalConsultasPacientes").modal('hide');
                    // $("#iniciarConsultaInit").attr('disabled', true);
                    // $("#TerminarConsultaFin").atter("enabled", true);
                    // $("#TerminarConsultaFin").attr('disabled', false);

                    Toast.fire({
                        icon: 'success',
                        title: 'Consulta iniciada.'
                    })

                } else {
                    $("#modalConsultasPacientes").modal('hide');

                    Toast.fire({
                        icon: 'error',
                        title: 'Error al iniciar la consulta'
                    })
                }
            }
        })

    })






    // 25/07/2022
    // PARA ACTUALIZAR TABLA DE CONSULTAS MEDICAS DE CADA DOCTOR
    timer = setInterval(function() {
        console.log("actualizando mis consultas en curso")
        $.ajax({
            type: 'POST',
            url: "{{route('miListaConsultasDoctor')}}",
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            success: function(respuesta) {
                console.log(respuesta);
                $('#tablemisConsultasMedicoDatatable').DataTable().ajax.reload();

            }

        })
    }, 5000)






    // PARA MOSTRAR LOS DATOS DATATABLE EN LA LISTA DE CONSULTA
    // 25/07/2022

    $(function() {
        const languages = {
            'es': "{{ asset('js/languageEs.json') }}"
        };
        // $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
        //     className: 'btn btn-sm'
        // })
        $.extend(true, $.fn.dataTable.defaults, {
            processing: true,
            responsive: true,
            language: {
                url: languages['es'],
                'processing': 'Estamos actualizando la lista de turnos.',
            },
            pageLength: 10,
            // dom: 'lBfrtip',
            // buttons: [{
            //         extend: 'copy',
            //         className: 'btn-light',
            //         text: 'COPIAR',
            //         exportOptions: {
            //             columns: ':visible'
            //         }
            //     },
            //     {
            //         extend: 'csv',
            //         className: 'btn-light',
            //         text: 'CSV',
            //         exportOptions: {
            //             columns: ':visible'
            //         }
            //     },
            //     {
            //         extend: 'excel',
            //         className: 'btn-light',
            //         text: 'EXCEL',
            //         exportOptions: {
            //             columns: ":visible"
            //         }
            //     },
            //     {
            //         extend: 'pdf',
            //         className: 'btn-light',
            //         text: 'PDF',
            //         exportOptions: {
            //             columns: ":visible"
            //         }
            //     },
            //     {
            //         extend: 'print',
            //         className: 'btn-light',
            //         text: 'IMPRIMIR',
            //         exportOptions: {
            //             columns: ":visible"
            //         }
            //     },
            //     {
            //         extend: 'colvis',
            //         className: 'btn-light',
            //         text: 'VISIBILIDAD DE COLUMNAS',
            //         exportOptions: {
            //             columns: ':visible'
            //         }
            //     }
            // ]
        });
    });



    $(document).ready(function() {
        $("#tablemisConsultasMedicoDatatable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            responsive: true,
            ajax: {
                url: "{{route('miListaConsultasDoctor')}}",
                type: 'POST'
            },
            columns: [{
                    data: 'folio_consulta'
                },
                {
                    data: 'nombre_completo'
                },
                {
                    data: 'tipo_consulta'
                },
                {
                    data: 'turno'
                },
                {
                    data: 'nombre_consultorio'
                },
                {
                    data: 'estatus_turno'
                },
                {
                    data: 'Opciones'
                },
            ],
        });
    })

    // $('#form-registroDoctor').on('submit', function(e) {

    //     // var data = $("#form-registroDoctor").serialize();
    //     console.log(data);
    // })

    $("#form-actualizarPersona").on('submit', function(e) {
        e.preventDefault()
        console.log('SE HA HECHO SUBMIT AL FORMULARIO')
        var datos = $(this).serialize();
        console.log(datos)

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })


        $.ajax({
            type: 'POST',
            url: "{{route('editarPersona')}}",
            data: datos,
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            success: function(respuesta) {
                console.log(respuesta.respuesta)
                if (respuesta.respuesta == 200) {
                    $("#tablePersonasDatatable").DataTable().ajax.reload();

                    Toast.fire({
                        icon: 'success',
                        title: 'Guardado correctamente.'
                    })

                    setTimeout(function() {
                        $("#modalDatosPersona").modal('hide');
                    }, 1000);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Ha ocurrido un error.'
                    })
                }
            }
        })

    })
</script>


<script>
    function verConsultas() {
        let fecha = new Date;
        let fecha_ddmmaa = String(fecha.getFullYear() + '-' + String(fecha.getMonth() + 1).padStart(2, '0') + '-' + fecha.getDate()).padStart(2, '0');

        // console.log(fecha_ddmmaa)

        $.ajax({
            type: 'POST',
            url: "{{ route('verTurnosActuales') }}",
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                'fecha_actual': fecha_ddmmaa
            },
            success: function(respuesta) {
                // console.log(respuesta)
                // console.log("LISTA DE TURNOS EN ESPERA")
                console.log(respuesta)

                // PARA RECIBIR JSON DESCOMENTAR LAS SIGUIENTES 8 LINEAS
                // data = $.parseJSON(respuesta);
                // // console.log(data);
                // $.each(JSON.parse(respuesta), function(i, item) {
                //     // alert(item.no_paciente)
                //     console.log(data[0])
                //     // console.log('ID TURNO:' + item.id_turno + ' | ' + 'NUMERO DE TURNO: ' + item.turno + ' ' + '| FECHA Y HORA DEL TURNO EN CURSO: ' + item.fecha_hora_turno)

                // })


                // var arreglo = data.map(item => {
                //     var id_turno = item.id_turno;
                //     var turno_viejo = item.turno;
                //     console.log('ID TURNO: '+id_turno+'| TURNO ACTUAL: '+(turno_viejo+1)+' | TURNO ANTERIOR: '+turno_viejo)

                //     for(var item of arreglo){
                //       var arrglo =  item.renameProperty('turno', (item.turno+1))
                //       console.log(arrglo);
                //     }
                // })

            }
        })
    }



    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            theme: "classic",
            dropdownParent: $("#modalRegistroCiudad")
        });
        // TIEMPO DE ACTUALIZACION EN LA PAGINA



        // $.ajax({
        //    RUTA NOMBRE ESTADOS
        //         type: 'POST',
        //         data: {
        //             "_token": $("meta[name='csrf-token']").attr("content"),
        //         },
        //         success: function(respuesta) {
        //             console.log(respuesta.turno_actualizado);

        //             var estado = JSON.stringify(respuesta);
        //                 console.log(paciente);


        //                 if (estado == '[]') {
        //                     console.log("vacio");

        //                 } else {
        //                     $.each(JSON.parse(estado), function(i, item) {
        //                         // alert(item.no_paciente)
        //                         console.log(item.nombre_estado)
        //                     })
        //                         // 

        //                 }

        //             // $("#exampleModalPopovers").modal("show");
        //         }
        //     })
    });

    function cerrarSesion() {

        $.ajax({
            type: 'POST',
            url: "{{ route('cerrarSesion') }}",
            data: {
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            success: function(respuesta) {
                console.log(respuesta)
                if (respuesta == "1") {
                    Swal.fire(
                        'Cerrando sesión',
                        'Te redireccionaremos al login',
                        'success'
                    )
                    setTimeout(function() {
                        window.location.href = '{{url("login")}}';
                    }, 2000);
                } else {
                    console.log("error");
                }
            }
        })
    }
</script>
<!-- 25/07/2022 -->
<div class="modal fade" id="modalEvExFisico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos de la revision fisica</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary" role="alert">
                    <h6>TEMPERATURA: </h6>
                    <p id="valueTemperaturaExFis"></p>
                    <h6>ESTATURA: </h6>
                    <p id="valueEstaturaExFis"></p>

                    <h6>PESO: </h6>
                    <p id="valuePesoExFis"></p>

                    <h6>PRESION: </h6>
                    <p id="valuePresionExFis"></p>

                    <h6>TALLA & MEDIDAS: </h6>
                    <p id="valueTallaMedidasExFis"></p>

                    <h6>RESPIRACION: </h6>
                    <p id="valueRespiracionExFis"></p>

                    <h6>PULSO: </h6>
                    <p id="valuePulsoExFis"></p>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- 25/07/2022 -->
<div class="modal fade" id="modalEvEncuesta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos de la revision fisica</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary" role="alert">
                    <h6>EVIDENCIA</h6>
                    <img src="" alt="" id="evEncuesta1" style="max-width: 80% ;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



<script>
    function irChequeoFisico(e) {
        var folio_paciente = e;

        console.log(e);

        if (folio_paciente === undefined || folio_paciente === 'undefined') {
            // $("#folioPacienteCheck").val('');
            alert('undefined')
        } else {
            $("#folioPacienteCheck").val(e);

        }
        $("#modalListaPersonas").modal('hide');
        $("#modalCheckPaciente2").modal("show");
    }




    function verPacienteCard(e) {
        var id_persona = e;
        // console.log(id_persona);
        // alert(e);

        if (e !== "") {
            $.ajax({
                url: "{{ route('buscarPacienteID') }}",
                type: 'POST',
                data: {
                    "id_persona": id_persona,
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
                success: function(e) {
                    // console.log(e);
                    $("#datosNombrePacienteModal").text(e.apaterno + ' ' + e.amaterno + ' ' + e.nombre)

                    $("#datosNoPacienteModal").text(e.no_paciente)

                    $("#datosEdadModal").text(e.edad);
                    $("#datosFnacModal").text(e.fnac);

                    if (e.estatus == 1) {
                        $("#datosEstatusModal").html('ACTIVO');
                    } else {
                        $("#datosEstatusModal").text('INACTIVO')
                    }

                    $('#ModalTogglePaciente').modal('show');

                }
            });





        } else {
            alert('no viene con datos')
        }
        // alert(e);


    }

    $(function() {
        const languages = {
            'es': "{{ asset('js/languageEs.json') }}"
        };
        $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
            className: 'btn btn-sm'
        })
        $.extend(true, $.fn.dataTable.defaults, {
            responsive: true,
            language: {
                url: languages['es']
            },
            pageLength: 25,
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'copy',
                    className: 'btn-light',
                    text: 'COPIAR',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn-light',
                    text: 'CSV',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-light',
                    text: 'EXCEL',
                    exportOptions: {
                        columns: ":visible"
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-light',
                    text: 'PDF',
                    exportOptions: {
                        columns: ":visible"
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-light',
                    text: 'IMPRIMIR',
                    exportOptions: {
                        columns: ":visible"
                    }
                },
                {
                    extend: 'colvis',
                    className: 'btn-light',
                    text: 'VISIBILIDAD DE COLUMNAS',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        });
    });

    // 25/07/2022
    //ABRE EL MODAL PARA CONSULTAR AL PACIENTE
    function consultarPaciente(e) {
        $('#modalConsultasPacientes').modal('hide');
        console.log(e);
        folio_consulta = e;

        $.ajax({
            type: 'POST',
            url: "{{route('datosConsultaPaciente')}}",
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                'folio_consulta': folio_consulta
            },
            success: function(r) {
                console.log(r)
                if (r.respuesta == 500) {
                    alert("Error al recibir los datos")
                } else {
                    if (r.estatus_turno == 1) {
                        $("#iniciarConsultaInit").addClass('d-none');
                    } else {
                        $("#iniciarConsultaInit").removeClass('d-none');


                    }
                    $("#id_folioActConsulta").val(r.folio_consulta);
                    $("#consultaMedicaNombrePac").html(r.nombre + ' ' + r.apaterno + ' ' + r.amaterno);
                    $("#fechaHInicioConsulta").val(r.fecha_hora_inicio);
                    $("#numeroTurnoEConsulta").val(r.turno)
                    $("#consultaMedicaFolioPac").html(r.no_paciente)
                    if (r.tipo_consulta == 1) {
                        $("#tipoConsultaC").val('URGENTE');
                    } else {
                        $("#tipoConsultaC").val('NORMAL');
                    }

                }

            }
        })

        $('#modalConsultaEnMedica').modal('show');
        console.log(e);
    }

    $("#revisionFisicaResultado").on('click', function(e) {
        e.preventDefault()
        console.log("#revisionFisicaResultado");
        var folio_consulta = $("#id_folioActConsulta").val();

        $.ajax({
            type: 'POST',
            url: "{{route('evidenciaExFisico')}}",
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                'folio_consulta': folio_consulta
            },
            success: function(respuesta) {
                console.log(respuesta.folio_consulta)
                if (respuesta.temperatura == null) {
                    $("#valueTemperaturaExFis").text('NINGUN VALOR CAPTURADO');
                } else {
                    $("#valueTemperaturaExFis").text(respuesta.temperatura);
                }
                if (respuesta.estatura == null) {
                    $("#valueEstaturaExFis").text('NINGUN VALOR CAPTURADO');

                } else {
                    $("#valueEstaturaExFis").text(respuesta.estatura);

                }
                if (respuesta.peso == null) {
                    $("#valuePesoExFis").text("NINGUN VALOR CAPTURADO");

                } else {
                    $("#valuePesoExFis").text(respuesta.peso);

                }
                if (respuesta.presion == null) {
                    $("#valuePresionExFis").text("NINGUN VALOR CAPTURADO");

                } else {
                    $("#valuePresionExFis").text(respuesta.presion);

                }
                if (respuesta.talla_medidas == null) {
                    $("#valueTallaMedidasExFis").text('NINGUN VALOR CAPTURADO');

                } else {
                    $("#valueTallaMedidasExFis").text(respuesta.talla_medidas);

                }
                if (respuesta.respiracion == null) {
                    $("#valueRespiracionExFis").text('NINGUN VALOR CAPTURADO');

                } else {
                    $("#valueRespiracionExFis").text(respuesta.respiracion);

                }
                if (respuesta.pulso == null) {
                    $("#valuePulsoExFis").text('NINGUN VALOR CAPTURADO');

                } else {
                    $("#valuePulsoExFis").text(respuesta.pulso);

                }


                $("#modalEvExFisico").modal('show');
            }
        })

    })

    $("#revisionEncuestaResultado").on('click', async function(e) {
        e.preventDefault()
        // captureParamPaciente

        // var canvas = await html2canvas(document.querySelector("#captureParamPaciente"))

        // var imagen = canvas.toDataURL()

        // console.log(imagen)


        var folio_consulta = $("#id_folioActConsulta").val();
        console.log("#revisionEncuestaResultado");

        $.ajax({
            type: 'POST',
            url: "{{route('evidenciaEncuestaX')}}",
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                'folio_consulta': folio_consulta
            },
            success: function(respuesta) {
                var img = respuesta.evidencia_encuesta;
                console.log(respuesta.evidencia_encuesta)
                $("#evEncuesta1").attr("src", "img/ev_encuesta/" + img);

                $("#modalEvEncuesta").modal('show');
            }
        })
    })



    $(document).ready(function() {
        var editor;
        var userid;

        $(".pacientes_table").DataTable({

            processing: true,
            serverSide: true,
            responsive: true,
            // buttons: dtButtons,
            ajax: "{{route('mostrarPacientes')}}",
            // headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            type: "POST",
            columns: [{
                    data: "nombre_completo",
                    name: "nombre_completo"
                },
                {
                    data: "edad",
                    name: "persona.edad"
                },
                {
                    data: "fnac",
                    name: "persona.fnac",
                    // searchable: false,
                    // orderable: false
                },
                {
                    data: 'estatus_persona',
                    name: 'persona.estatus_persona',
                },
                {
                    data: 'id_persona',
                    searchable: 'false'
                },
                {
                    data: 'id_paciente',
                    searchable: 'false'

                }
                // {
                //     data: 'show',
                // },
                // {
                //     data: 'edit',
                // },
                // {
                //     data: 'delete',
                // }
            ]
        });
        // new $.fn.dataTable.FixedHeader("#tablePersonasDatatable");
    })



    function opcionSeleccionEncuesta(e) {
        console.log(e)
        if (e == "nivel1") {
            // $("adviseEncuestaApply").addClass("alert-success");
            $("#respuesta_tipoencuesta").html("<div class='alert alert-success'>Encuesta nivel 1 seleccionada. <br><a class='button' href=''>APLICAR AQUI</a></div>").fadeIn();

            // $("#adviseEncuestaApply").fadeIn();
            // setTimeout(function() {
            //     $("#adviseEncuestaApply").fadeOut();
            // }, 2000);
        }
        if (e == "nivel2") {
            $("#respuesta_tipoencuesta").html("<div class='alert alert-warning'>Encuesta nivel 2 seleccionada.<br><a class='button' href=''>APLICAR AQUI</a></div>").fadeIn();
            // $("adviseEncuestaApply").addClass("alert-info");
            // $("#adviseEncuestaApply").fadeIn();
            // setTimeout(function() {
            //     $("#adviseEncuestaApply").fadeOut();
            // }, 2000);
        }
        if (e == "") {
            $("#respuesta_tipoencuesta").html("<div class='alert alert-dark'>Ninguna opcion seleccionada</div>").fadeIn();

            setTimeout(function() {
                $("#respuesta_tipoencuesta").fadeOut();
            }, 1000);

            // $("adviseEncuestaApply").addClass("alert-danger");

            // $("#adviseEncuestaApply").fadeIn();
            // setTimeout(function() {
            //     $("#adviseEncuestaApply").fadeOut();
            // }, 2000);
        }
    }

    function modificarPaciente(e) {
        var id_persona = e;
        $("#id_PersonaPaciente").val(id_persona);

        $.ajax({
            type: 'POST',
            url: "{{route('perfilPersona')}}",
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                'id_persona': id_persona
            },
            success: function(r) {
                $("#modalDatosPersona").modal("show");
                console.log(r)
                $('#nombrePersonaPaciente').val(r.nombre);
                $('#apPersonaPaciente').val(r.apaterno);
                $("#amPersonaPaciente").val(r.amaterno);
                $("#fnacPersonaPaciente").val(r.fnac);
                $("#edadPersonaPaciente").val(r.edad);
                $('#estatusPersonaPaciente').val(r.estatus_persona).find(":selected").text().val();

            }
        })


    }
</script>

<script>
    function abrirTogglePais() {
        $('.dropdown-toggle').dropdown()
    }
</script>
<!--ESTILO GENERAL DEL DASHBOARD-->
<style>
    .modal-header {
        background-color: #04bba4;

    }
</style>

<!-- Modal -->
<div class="modal fade" id="menuPacientes" tabindex="-1" aria-labelledby="menuPacientes" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menú - Pacientes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="margin-left: 3%;">
                <!-- <div class="card" style="width: 12rem;">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="container-fluid" style="margin: 0 auto;">
                    <div class="row">
                        <!-- @if(session('tipo_usuario')=="admin") -->
                        <div class="card col-md-4 ml-auto" style="width: 14rem; margin: 1% ;" id="registrarPacienteOption">
                            <img src="{{url('/images/logos/registro.png')}}" class="card-img-top" alt="..." style="width: 80%; margin: 10%">

                            <div class="card-body">
                                <h5 class="card-title">Registrar paciente</h5>
                                <p style="text-align: center;" class="card-text">Registrar nuevo paciente.</p>
                                <a style="margin-left: 15%;" href="#" class="btn btn-primary" onclick="registroPaciente()">Ir al registro</a>
                            </div>
                        </div>
                        <!-- @endif -->
                        @if(session('tipo_usuario')=='admin')
                        <div class="card col-md-4 ml-auto" style="width: 14rem; margin: 1%">
                            <img src="{{url('/images/logos/contact-form.png')}}" class="card-img-top" alt="..." style="width: 80%; margin: 10%">
                            <div class="card-body">
                                <h5 class="card-title">Aplicar encuesta</h5>
                                <p style="text-align: center;" class="card-text">Aplicar encuesta a paciente.</p>
                                <a style="margin-left: 15%;" href="#" class="btn btn-primary" onclick="avisoEncuesta()">Ir a aplicar</a>
                            </div>
                        </div>
                        @endif
                        <div class="card col-md-4 ml-auto" style="width: 14rem; margin: 1%">
                            <img src="{{url('/images/logos/list.png')}}" class="card-img-top" alt="..." style="width: 80%; margin: 10%">
                            <div class="card-body">
                                <h5 class="card-title">Lista de pacientes</h5>
                                <p style="text-align: center;" class="card-text">Ver lista de los pacientes registrados.</p>
                                <a style="margin-left: 15%;" href="#" class="btn btn-primary" onclick="verListaPacientes()">Ir a la lista</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</div>


<div class="modal fade" id="modalEncuestaPersona" tabindex="-1" aria-labelledby="modalEncuestaPersona" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Encuesta / Cuestionario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <b><label for="recipient-name" class="col-form-label">Buscar paciente registrado: </label></b>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="SOLO NUMERO DE PACIENTE" aria-label="Recipient's username" aria-describedby="button-addon2" id="buscarNombreUserCE">
                        <button class="btn btn-outline-success" type="button" id="button-addon2" disabled>Seleccionar</button>
                    </div>
                    <p id="respuestaJSONPaciente"></p>
                </div>
                <hr>
                <form>
                    <div class="mb-3">
                        <b><label for="message-text" class="col-form-label">Persona seleccionada: </label></b>
                        <!-- ID PACIENTE, PERSONA DENTRO DEL FORMULARIO -->
                        <input class="form-control" type="text" id="personaSeleccionadaCE" readonly disabled></input>
                        <input type="text" class="form-control" id="personaSeleccionadaCEIDPaciente" readonly hidden>
                        <input type="text" class="form-control" id="personaSeleccionadaCEIDPersona" readonly hidden>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary disabled" id="sigPasoEncuesta1" data-bs-target="#modalCheckPaciente2" data-bs-toggle="modal" data-bs-dismiss="modal" onclick="checkPaciente2Process()">Ir al siguiente paso</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCuestionarioPaso2" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalCuestionarioPaso2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class=" modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cuestionario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioPreguntasPaso2">
                    <div id="captureResultadosEncuesta" style="padding: 10px;">
                        <div class="alert alert" role="alert">
                            <b>1.-ESTADO ACTUAL DE LA FRECUENCIA CARDIACA:</b>
                            <select name="" class="form-control encuestaMedica" id="pregunta1">
                                <option value="">SELECCIONA UNA OPCIÓN</option>
                                <option value="0">REGULAR</option>
                                <option value="10">IRREGULAR</option>
                            </select>
                            <div id="P1-RSI"></div>
                            <br>
                            <b>2.-ESTADO ACTUAL DE LA PRESIÓN ARTERIAL/PULSO:</b>
                            <select name="" class="form-control encuestaMedica" id="pregunta2">
                                <option value="">SELECCIONA UNA OPCIÓN</option>
                                <option value="5">REGULAR</option>
                                <option value="10">IRREGULAR</option>
                            </select>
                            <div id="P2-RSI"></div>
                            <br>

                            <b>3.-¿FRECUENCIA RESPIRATORIA?</b>
                            <select name="" class="form-control encuestaMedica" id="pregunta3">
                                <option value="">SELECCIONA UNA OPCIÓN</option>
                                <option value="5">REGULAR</option>
                                <option value="10">IRREGULAR</option>
                            </select>
                            <div id="P3-RSI"></div>
                            <br>

                            <b>4.-¿TEMPERATURA?</b>
                            <select name="" class="form-control encuestaMedica" id="pregunta4">
                                <option value="">SELECCIONA UNA OPCIÓN</option>
                                <option value="10">ALTA</option>
                                <option value="0">NORMAL</option>
                                <option value="10">BAJA</option>
                            </select>
                            <div id="P4-RSI"></div>
                            <br>

                            <b>5.-EL PACIENTE. ¿ESTÁ CONSCIENTE?</b>
                            <select name="" class="form-control encuestaMedica" id="pregunta5">
                                <option value="">SELECCIONA UNA OPCIÓN</option>
                                <option value="5">SI</option>
                                <option value="10">NO</option>
                            </select>
                            <div id="P5-RSI"></div>
                            <br>

                            <b>6.-EL PACIENTE.¿ESTA SANGRANDO?</b>
                            <select name="" class="form-control encuestaMedica" id="pregunta6">
                                <option value="">SELECCIONA UNA OPCIÓN</option>
                                <option value="10">SI</option>
                                <option value="5">NO</option>
                            </select>
                            <div id="P6-RSI"></div>
                            <br>

                            <b>7.-EL PACIENTE. ¿SE PUEDE MOVER?</b>
                            <select name="" class="form-control encuestaMedica" id="pregunta7">
                                <option value="">SELECCIONA UNA OPCIÓN</option>
                                <option value="7">SI</option>
                                <option value="10">NO</option>
                            </select>
                            <div id="P7-RSI"></div>
                            <br>

                            <b>8.-¿TIENE HERIDAS O FRACTURAS ABIERTAS?</b>
                            <select name="" class="form-control encuestaMedica" id="pregunta8">
                                <option value="">SELECCIONA UNA OPCIÓN</option>
                                <option value="10">SI</option>
                                <option value="5">NO</option>
                            </select>
                            <div id="P8-RSI"></div>
                            <br>

                            <b>9.-¿PRESENTA ALERGÍAS?</b>
                            <select name="" class="form-control encuestaMedica" id="pregunta9">
                                <option value="">SELECCIONA UNA OPCIÓN</option>
                                <option value="10">SI</option>
                                <option value="5">NO</option>
                            </select>
                            <div id="P9-RSI"></div>
                            <br>

                            <b>10.-¿PADECE DE ENFERMEDADES CARDIACAS?</b>
                            <select name="" class="form-control encuestaMedica" id="pregunta10">
                                <option value="">SELECCIONA UNA OPCIÓN</option>
                                <option value="10">SI</option>
                                <option value="5">NO</option>
                            </select>

                            <div id="P10-RSI"></div>

                            <span id="respuestaScore"></span>
                        </div>
                    </div>
                    <button style="margin-left: 30%;" type="submit" class="btn btn-primary disabled" id="sigPasoEncuesta2">Evaluar mis respuestas</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary disabled modalCerrarPaso2" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRegistroPersona" tabindex="-1" aria-labelledby="modalRegistroPersona" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <b>
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Paciente</h5>
                </b>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow-y: scroll;">
                <form id="registroPaciente">
                    <div class="mb-3">
                        <b> <label for="recipient-name" class="col-form-label">Nombre de Usuario: </label></b>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nombreUsuarioPaciente" name="nombreUsuarioPaciente" aria-describedby="button-addon2" readonly>
                            <a class="btn btn-outline-info btn-sm" id="generarFolioPaciente">Generar</a>
                        </div>
                        <b> <label for="recipient-name" class="col-form-label">Nombre del paciente: </label></b>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nombre_persona" name="nombre_persona" placeholder="Nombre del paciente" aria-label="Recipient's username" aria-describedby="button-addon2">
                        </div>
                    </div>
                    <div class="mb-3">
                        <b> <label for="message-text" class="col-form-label">Apellido paterno: </label></b>
                        <input class="form-control" type="text" id="apaterno" name="apaterno" placeholder="Apellido paterno del paciente"></input>
                    </div>
                    <div class="mb-3">
                        <b><label for="message-text" class="col-form-label">Apellido materno: </label></b>
                        <input class="form-control" type="text" id="amaterno" name="amaterno" placeholder="Apellido materno del paciente"></input>
                    </div>
                    <div class="mb-3">
                        <b><label for="message-text" class="col-form-label">Fecha de nacimiento: </label></b>
                        <input class="form-control" type="date" id="fnac" name="fnac"></input>
                    </div>
                    <div class="mb-3">
                        <b><label for="message-text" class="col-form-label">Edad: </label></b>
                        <input class="form-control" type="number" id="edad" name="edad" placeholder="Edad del paciente"></input>
                    </div>

                    <button style="margin-left: 34%;" type="submit" class="btn btn-primary" id="registrarPaciente">Registrar Paciente</button>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCheckPaciente2" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalCheckPaciente2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 0.5px; background-color: #2EA189;">
                <b>
                    <h5 class="modal-title" id="exampleModalLabel">REVISIÓN FISICA</h5>
                </b>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="borrarFolioPaciente()"></button>
            </div>
            <div class="modal-body">
                <form id="parametrosPaciente">
                    <div id="captureParamPaciente">

                        <b><label class="col-form-label">FOLIO DE PACIENTE:</label></b>
                        <input type="text" class="form-control" id="folioPacienteCheck" name="folioPacienteCheck" placeholder="" aria-describedby="button-addon2" readonly>

                        <div class="mb-3">
                            <b> <label for="recipient-name" class="col-form-label">La respiración es:</label></b>
                            <div class="input-group mb-3">
                                <select id="respiracionPaciente" name="respiracionPaciente" class="form-control">
                                    <option value="">Selecciona una opción</option>
                                    <option value="Eficiente">Eficiente</option>
                                    <option value="Deficiente">Deficiente</option>
                                    <option value="No estable">No estable</option>
                                </select>
                            </div>
                            <b><label for="recipient-name" class="col-form-label">Tallas:</label></b>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="tallaPaciente" name="tallaPaciente" aria-describedby="button-addon2" placeholder="Registra una talla" required>
                            </div>
                            <b><label for="recipient-name" class="col-form-label">Temperatura: </label></b>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="temperaturaPaciente" name="temperaturaPaciente" placeholder="Registra una Temperatura" aria-label="" aria-describedby="button-addon2" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <b> <label for="message-text" class="col-form-label">Peso: </label></b>
                            <input class="form-control" type="number" id="pesoPaciente" name="pesoPaciente" placeholder="Registre un peso" required></input>
                        </div>
                        <div class="mb-3">
                            <b> <label for="message-text" class="col-form-label">Presion Arterial: </label></b>
                            <input class="form-control" type="text" id="presionPaciente" name="presionPaciente" placeholder="Registre la presion arterial" required></input>
                        </div>
                        <div class="mb-3">
                            <b> <label for="message-text" class="col-form-label">Pulso: </label></b>
                            <input type="text" id="pulsoPaciente" name="pulsoPaciente" placeholder="Indique el pulso" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <b> <label for="message-text" class="col-form-label">Estatura: </label></b>
                            <input class="form-control" type="text" id="estaturaPaciente" name="estaturaPaciente" placeholder="Registre la estatura" required></input>
                        </div>
                    </div>

                    <button style="margin-left: 55%;" type="submit" class="btn btn-primary" id="checkPacientePaso3">Siguiente paso(Encuesta)</button>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRegistroEstado" tabindex="-1" aria-labelledby="modalRegistroEstado" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de nuevo estado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-RegistroEstado">
                    <div class="mb-3">
                        <b> <label for="recipient-name" class="col-form-label">Ingresa el nombre del estado: </label></b>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nombre del estado" aria-describedby="button-addon2" name="nombre_estado" id="nombre_pais">

                            <button class="btn btn-outline-success btn-submit-restado" type="submit" id="boton-estado">Guardar</button>
                        </div>
                    </div>
                    <div class="alert alert-success" role="alert" id="adviseStatusCountry" style="display: none;">
                        Se ha guardado el estado correctamente.
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Ir al siguiente paso</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRegistroDoctor" tabindex="-1" aria-labelledby="modalRegistroDoctor" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Matriculación y registro de empleados<h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-registroDoctor" name="form-registroDoctor">
                    <div class="alert alert-info" role="alert"> <b>Para generar una matricula solo da clic sobre el campo de matricula.</b> </div>
                    <div class="mb-3">
                        <label for="" class="col-form-label"><b> Tipo de empleado:</b></label>
                        <select name="tipo_empleadoRegistroDoctor" id="tipo_empleadoRegistroDoctor" class="form-control">
                            <option value="">SELECCIONA TIPO DE EMPLEADO</option>
                            <option value="admin">Administrador</option>
                            <option value="doctor">Doctor</option>
                        </select>
                    </div>
                    <div class="mb-12">
                        <label for="recipient-name" class="col-form-label"><b>Ingresa los datos de la persona:</b> </label>
                        <div class="input-group sm-12">
                            <input type="text" class="form-control" placeholder="Matricula" aria-describedby="button-addon2" name="matricula_empleado" id="matricula_empleado" readonly></input>
                            <!-- <select name="personasListEmpleados" id="personasListEmpleados" class="js-example-basic-single">
                                <option value="">SELECCIONE UNA OPCION</option>

                            </select> -->

                            <input class="form-control" list="datalistPersonas" id="inputDatalistPersona" name="inputDatalistPersona" placeholder="Buscar persona">
                            <datalist id="datalistPersonas" name="datalistPersonas">
                                <option value="">SELECCIONA UNA PERSONA</option>
                            </datalist>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="recipient-mail" class="col-form-label"> <b>Ingresa un correo y una contraseña:</b> </label>
                        <div class="input-group mb-3">
                            <input type="email" id="correoNuevoEmpleado" name="correoNuevoEmpleado" class="form-control" placeholder="Escribe un correo">
                            <input type="password" id="password1NuevoEmpleado" name="password1NuevoEmpleado" class="form-control" placeholder="Escribe tu contraseña">
                        </div>
                    </div>
                    <button type="submit" style="margin-left: 82%;" class="btn btn-outline-success" id="botonRdoctorxd" name="botonRdoctorxd">Guardar</button>

                </form>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>








<div class="modal fade" id="modalRegistroCiudad" aria-labelledby="modalRegistroCiudad" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de nueva ciudad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-RegistroCiudad">
                    <div class="mb-3">
                        <b><label for="recipient-name" class="col-form-label">Ingresa el nombre de la ciudad: </label></b>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nombre de la ciudad" aria-describedby="button-addon2" name="nombre_ciudad" id="nombre_ciudad">
                            <select name="fk_estado" id="fk_estado" class="form-control">
                                <option value="">Selecciona un Estado</option>
                                @php
                                use App\Models\estadoModel;

                                $estados = estadoModel::all();

                                @endphp
                                @foreach($estados as $nombreEstado)
                                <option value="{{$nombreEstado->id_estado}}">{{$nombreEstado->nombre_estado}}</option>
                                @endforeach
                            </select>


                            <button class="btn btn-outline-success btn-submit-rciudad" type="submit" id="boton-ciudad">Guardar</button>
                        </div>
                    </div>
                    <div class="alert alert-success" role="alert" id="adviseStatusCity" style="display: none;">
                        Se ha guardado la ciudad correctamente.
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Ir al siguiente paso</button> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal PERFIL-->
<div class="modal fade" id="modalPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mis datos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="perfilPersonaForm" name="perfilPersonaForm" class="form-control">
                    <h5><b>MI PERFIL</b></h5>
                    <img src="{{url('/images/logos/z.png')}}" class="card-img-top" alt="..." style="width: 35%; margin-left: 30%;">

                    <input type="text" id="id_personainput" value="{{session('id_persona')}}" hidden name="id_personainput">
                    <b>
                        <div>NOMBRE: </div>
                    </b>
                    <input type="text" id="nombrePersonaPerfil" name="nombrePersonaPerfil" class="form-control">
                    <b>
                        <div>APELLIDO PATERNO: </div>
                    </b>
                    <input type="text" id="apPersonaPerfil" name="apPersonaPerfil" class="form-control">
                    <b>
                        <div>APELLIDO MATERNO: </div>
                    </b>
                    <input type="text" id="amPersonaPerfil" name="amPersonaPerfil" class="form-control">
                    <b>
                        <div>FECHA DE NACIMIENTO: </div>
                    </b>
                    <input type="date" id="fnacPersonaPerfil" name="fnacPersonaPerfil" class="form-control">
                    <b>
                        <div>EDAD: </div>
                    </b>
                    <input type="text" id="edadPersonaPerfil" name="edadPersonaPerfil" class="form-control">
                    <br>
                    <input type="text" id="estatusPersonaPerfil" name="estatusPersonaPerfil" class="form-control" hidden>
                    <button type="submit" class="btn btn-primary" id="actualizarDatosPersona">Actualizar datos</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>
<!-- -->
<div class="modal fade" id="modalClinicaSelect" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">SELECCIONA CONSULTORIO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" disabled></button>
            </div>
            <div class="modal-body">
                <input type="text" id="fk_empleadoS" name="fk_empleadoS" value="{{session('fk_empleado')}}" hidden>
                <select name="selectClinica" id="selectClinica" class="form-control">
                    <option value="">SELECCIONA UN CONSULTORIO</option>
                    @foreach($clinicas as $clinica)
                    <option value="{{$clinica->id_consultorio_doctor}}">{{$clinica->fk_consultorio}}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" disabled>CERRAR</button>
                <button type="button" class="btn btn-primary" onclick="selectClinica()">GUARDAR CAMBIOS</button>
            </div>
        </div>
    </div>
</div>
<input type="text" id="tipo_usuario" name="tipo_usuario" value="{{session('tipo_usuario')}}" hidden>


<script>
    $(document).ready(function() {
        $("#form-registroDoctor").on('submit', function(e) {
            e.preventDefault()
            // var idValue = $('#datalistPersonas').prop("data-value")

            // $("input[name=inputDatalistPersona]").change(function() {
            //     alert($("input[name=inputDatalistPersona]").val());
            // })
            // $("#inputDatalistPersona").change(function() {
            //     var dataval = $("#inputDatalistPersona").data('value');
            //     console.log(dataval)
            // })
            // var dataval = $("#inputDatalistPersona").data('data-value');

            console.log('botonRdoctorxd');
        })
    })
    $("#inputDatalistPersona").on('input', function() {
        var value = $(this).val();

        console.log(value)
        // alert($('#datalistPersonas [value="' + value + '"]').data('value'));

    })
</script>

<script>
    var id = Math.floor(Math.random() * 99999999) + 1000;

    $("#parametrosPaciente").on("submit", async function(e) {
        e.preventDefault()



        console.log("hiciste submit el formulario")
        //  + '&imagen_parametros=' + imagen
        // PONER LO DE ARRIBA DESPUES DEL SERIALIZE() EN CASO QUE EL FORMULARIO ESTE SERIALIZADO
        var datos = $("#parametrosPaciente").serialize();
        console.log(datos)
        $("#checkPacientePaso3").attr('disabled', true);

        $.ajax({
            type: 'post',
            url: '{{route("registrarParametrosPaciente")}}',
            data: datos,
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            success: function(respuesta) {
                console.log(respuesta)
                const data = respuesta;
                const splt = data.split(" ");
                var id_paciente = splt[1];
                var id_parametro = splt[0];
                $("#fk_paciente").val(id_paciente);
                $("#fk_parametros_paciente").val(id_parametro);
                console.log("Paciente: " + id_paciente + " ID Parametros: " + id_parametro);
                $("#parametrosPaciente")[0].reset();
                $("#checkPacientePaso3").attr('disabled', false);
                $("#modalCheckPaciente2").modal("hide");

                setTimeout(function() {
                    $("#modalCuestionarioPaso2").modal("show");
                }, 1000);

            }
        })

    })

    function verListaPacientes() {
        $("#modalListaPersonas").modal("show");
        $("#menuPacientes").modal("hide");
    }


    $("#inputDatalistPersona").on('change keyup paste', function() {
        var personaFind = this.value;
        console.log(personaFind)
        $.ajax({
            type: 'post',
            url: '{{route("buscarPersonaEmp")}}',
            data: {
                "personaFind": personaFind
            },
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            success: function(respuesta) {
                console.log(respuesta)
                // console.log('Respuesta: ' + respuesta);
                var listitems = '';

                $.each(respuesta, function(i, item) {
                    console.log(item.nombre)
                    listitems += '<option data-value="' + item.id_persona + '">' + item.nombre + ' ' + item.apaterno + ' ' + item.amaterno + '</option>'
                });
                // $("#datalistPersonas").append($('<option></option>').val(item.id_persona).html(item.nombre))
                $("#datalistPersonas").html(listitems);

                // REVISAR
                var dataP = $("#inputDatalistPersona").val();
                var valueDtlstSelect = document.querySelector("#datalistPersonas option[value='" + dataP + "']").dataset.value;
                console.log(valueDtlstSelects)
            }
        })
    })

    function registrarNuevoEmpleado(e) {
        var idValue = $('#datalistPersonas').prop("data-value");

        console.log(idValue);

    }





    $("#form-RegistroCiudad").on("submit", function(e) {
        e.preventDefault()
        var datos = $("#form-RegistroCiudad").serialize()
        console.log(datos)

        if ($("#nombre_ciudad").val() == "") {
            alert("El campo ciudad esta vacio");

        } else if ($("#fk_estado").val() == "") {
            alert("Selecciona un estado.")
        } else {
            $.ajax({
                type: 'POST',
                url: "{{route('registrarCiudad')}}",
                data: datos,
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function(respuesta) {
                    console.log(respuesta)

                    if (respuesta == 1) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Guardado correctamente.'
                        })
                        setTimeout(function() {
                            $("#modalRegistroCiudad").modal("hide");
                        }, 2000);
                    } else {
                        Swal.fire({
                            title: 'Error',
                            html: 'Ha ocurrido un error al guardar.',
                            icon: 'error',
                            timer: 2000,
                            timerProgressBar: true,
                        })

                    }
                }
            })
        }

    })



    var _token = $("meta[name='csrf-token']").attr("content")

    // SI FUNCIONA - SI JALA
    $("#actualizarDatosPersona").on('click', function(e) {
        e.preventDefault()
        console.log("se oprimio el actualizar datos")
        var datos = $('#perfilPersonaForm').serialize()
        // console.log(_token)
        console.log(datos)

        $.ajax({
            type: 'POST',
            url: "{{route('actualizarPerfilPersona')}}",
            data: datos,
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            success: function(respuesta) {
                console.log(respuesta.respuesta)
                // r = JSON.stringify(respuesta)
                // console.log(r.respuesta)

                if (respuesta.respuesta == 200) {
                    Swal.fire({
                        title: 'ACTUALIZADO',
                        html: 'Se han actualizado tus datos.',
                        icon: 'success',
                        timer: 2000,
                        timerProgressBar: true,

                    })
                    setTimeout(function() {
                        $("#modalPerfil").modal("hide")
                    }, 2000);
                } else {
                    Swal.fire({
                        title: 'Error',
                        html: 'Ha ocurrido un error, verifica los datos e intentalo nuevamente.',
                        icon: 'info',
                    })
                }

            }
        })
    })


    var id_persona = $("#id_personainput").val();

    function abrirPerfil(e) {

        console.log(id_persona)
        // SI FUNCIONA - SI JALA
        $.ajax({
            type: 'POST',
            url: "{{route('perfilPersona')}}",
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                "id_persona": id_persona
            },
            success: function(respuesta) {
                console.log(respuesta)
                $('#nombrePersonaPerfil').val(respuesta.nombre);
                $('#apPersonaPerfil').val(respuesta.apaterno);
                $("#amPersonaPerfil").val(respuesta.amaterno);
                $("#fnacPersonaPerfil").val(respuesta.fnac);
                $("#edadPersonaPerfil").val(respuesta.edad);
                $("#estatusPersonaPerfil").val(respuesta.estatus_persona);
            }
        })
        $("#modalPerfil").modal("show");
    }

    // ABRIR MODAL SELECCION DE CLINICA
    // FK CLINICA
    var clinica = $("#clinicasesion").val();
    var tipo_usuario = $("#tipo_usuario").val();

    if (clinica == "") {
        $(document).ready(function() {
            if (tipo_usuario == "doctor") {
                $("#modalClinicaSelect").modal("show");
            }
            console.log(clinica)
        })
    }

    // CONSULTORIO
    function selectClinica() {
        var consultorio = $("#selectClinica").val();
        var fk_persona = $("#id_personainput").val();
        var fk_empleado = $("#fk_empleadoS").val();
        // console.log(clinica)
        // console.log(fk_persona)

        $.ajax({
            type: 'POST',
            url: "{{route('seleccionarClinica')}}",
            data: {
                "consultorio": consultorio,
                "fk_persona": fk_persona,
                "fk_empleado": fk_empleado,
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            success: function(r) {
                console.log(r)
                if (r.respuesta == 200) {
                    $("#modalClinicaSelect").modal('hide');

                }
            }
        })
    }

    // $("#perfilPersonaForm").submit(function(e) {
    //     e.preventDefault()
    //     var _token = $("meta[name='csrf-token']").attr("content")
    //     var formData = $('#perfilPersonaForm').serialize()
    //     console.log(formData)
    //     $.ajax({
    //         type: 'POST',
    //         url: "{{route('actualizarPerfilPersona')}}",
    //         data: $("#pefilPersonaForm").serialize(),
    //         processData: false,
    //         contentType: false,
    //         dataType: "JSON",
    //         headers: {
    //             "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
    //         }
    //     })
    // })


    // $(document).on('change', '#pregunta1', function() {
    //     var $puntos = 0;
    //     var $p1SI = $(
    //         '<h1>RESPONDISTE SI</h1>'
    //     )

    //     var seleccion = $(this).val();
    //     $('#P1-RSI').html('');

    //     switch (seleccion) {
    //         case '10':
    //             console.log("SE RESPONDIO SI")
    //             $("#P1-RSI").append($p1SI).fadeIn();
    //             break;

    //         default:
    //             break;
    //     }
    // })





    $('.encuestaMedica').change(function(e) {
        var incompletos = false;
        var puntaje = 0;

        $('.encuestaMedica').find("option:selected").each(function() {
            if ($(this).val().trim() == '') {
                incompletos = true;
            }
        });
        if (incompletos == false) {
            // alert("ya no hay incompletos");
            $("#sigPasoEncuesta2").removeClass('disabled')

            // $("#pregunta1").val($("#pregunta1").val() + "\n"+ $('#'))
        } else {
            // alert("aun quedan campos vacios")
            $("#sigPasoEncuesta2").addClass('disabled')

            console.log('aun quedan campos vacios')

        }
        console.log('Exitoso!');
    })

    // if (incompletos) {
    //     return "";
    // }
    $(document).ready(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        $("#sigPasoEncuesta2").on('click', async function(e) {

            e.preventDefault();

            var canvas = await html2canvas(document.querySelector("#captureResultadosEncuesta"))

            var imagen = canvas.toDataURL()

            console.log(imagen)


            console.log("se hizo submit")
            const puntaje1 = parseInt($("#pregunta1").val())
            const puntaje2 = parseInt($("#pregunta2").val())
            const puntaje3 = parseInt($("#pregunta3").val())
            const puntaje4 = parseInt($("#pregunta4").val())
            const puntaje5 = parseInt($("#pregunta5").val())
            const puntaje6 = parseInt($("#pregunta6").val())
            const puntaje7 = parseInt($("#pregunta7").val())
            const puntaje8 = parseInt($("#pregunta8").val())
            const puntaje9 = parseInt($("#pregunta9").val())
            const puntaje10 = parseInt($("#pregunta10").val())
            const puntaje = (puntaje1 + puntaje2 + puntaje3 + puntaje4 + puntaje5 + puntaje6 + puntaje7 + puntaje8 + puntaje9 + puntaje10);
            const id = Math.floor(Math.random() * 99999999) + 1000;
            console.log(puntaje)
            // PUNTAJE TOTAL 100 - MINIMO 55 / DISTANCIA A 100(45) / PARA ENTRAR EN TURNO URGENTE ES ES 55+22.5= 77.5
            // 
            //PRIMERO SE DEBE DE METER EN UN IF LAS PRIMERAS 3 PREGUNTAS COMO PRIORIDAD CON UN OR COMO CONDICIONAL SI NO ES LA PREGUNTA 1 = A 10 o LA PREGUNTA 2 = A 10 o LA PREGUNTA 3 = A 10 que se brinque al else
            if ((puntaje1 || puntaje2 || puntaje3) == 10) {
                // alert("Turno urgente por situacion: \n" + "Tu folio es:" + id + "\nTu puntaje es: " + puntaje)

                Toast.fire({
                    icon: 'info',
                    title: 'Turno urgente por situación medica, por favor estar al pendiente de su turno.'
                })
                const tipo_consulta = 1;
                // Toast.fire({
                //     icon: 'info',
                //     title: 'Turno de prioridad urgente, por favor estar al pendiente de su turno.'
                // })

                ajaxGuardarEncuesta(id, puntaje, tipo_consulta, imagen)
                $("#formularioPreguntasPaso2")[0].reset();


            } else {
                if (puntaje > 76) {
                    const tipo_consulta = 1;

                    // alert("Turno urgente por puntaje: \n" + "Tu folio es:" + id + "\nTu puntaje es: " + puntaje)
                    $("#modalCuestionarioPaso2").modal('hide');


                    Toast.fire({
                        icon: 'info',
                        title: 'Turno en urgente, por favor estar al pendiente de su turno.'
                    })
                    ajaxGuardarEncuesta(id, puntaje, tipo_consulta, imagen)
                    $("#formularioPreguntasPaso2")[0].reset();

                    // Toast.fire({
                    //     icon: 'info',
                    //     title: 'Turno de prioridad urgente, por favor estar al pendiente de su turno.'
                    // })

                } else if (puntaje < 76) {
                    const tipo_consulta = 2;
                    $("#modalCuestionarioPaso2").modal('hide');


                    // alert('Turno es "EN ESPERA" por tener puntaje menor a 76: \n' + "Tu folio es:" + id + "\nTu puntaje es: " + puntaje)

                    Toast.fire({
                        icon: 'info',
                        title: 'Turno en espera, por favor estar al pendiente de su turno.'
                    })
                    ajaxGuardarEncuesta(id, puntaje, tipo_consulta, imagen)
                    $("#formularioPreguntasPaso2")[0].reset();


                }
            }

            //CON UN ELSE SE DEBE DE METER LA PRIORIDAD POR PUNTAJE


            $(".modalCerrarPaso2").removeClass('disabled');

            // var id = Math.random().toString(7).slice(2);
            // console.log(id);
            console.log(id)
            // DESCOMENTAR LA LINEA DE RESET formularioPreguntasPaso2
            $("#modalCuestionarioPaso2").modal('hide');
            $("#sigPasoEncuesta2").addClass('disabled');


        })
    })

    async function ajaxGuardarEncuesta(id, puntaje, tipo_consulta, imagen) {
        console.log(imagen)
        console.log('AJAX GUARDAR ENCUESTA')
        console.log('ID: ' + id);
        console.log('PUNTAJE: ' + puntaje)
        console.log('TIPO_CONSULTA: ' + tipo_consulta)

        var imagenEncuesta = imagen;


        // console.log("ID - PUNTAJE");
        // console.log(id, puntaje)
        var folio_encuesta = id;
        var puntaje_encuesta = puntaje;
        var tc = tipo_consulta;
        var folioConsulta = Math.floor(Math.random() * 99999999) + 1000;
        var fk_paciente = $("#fk_paciente").val();
        var fk_parametros_paciente = $("#fk_parametros_paciente").val();
        $.ajax({
            type: 'POST',
            url: "{{route('ajaxGuardarEncuesta')}}",
            data: {
                'folio_consulta': folioConsulta,
                "fk_paciente": fk_paciente,
                "fk_parametros_paciente": fk_parametros_paciente,
                "folio_encuesta": folio_encuesta,
                'tipo_consulta': tc,
                "puntaje_encuesta": puntaje_encuesta,
                "imagenEncuesta": imagenEncuesta
            },
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            success: function(r) {
                console.log("AJAX GUARDAR ENCUESTA")
                console.log(r);
                // $("#fk_encuesta_consulta").val(r);
                $("#tipo_consulta").val(tc);
            }
        })
    }

    // function evaluarScore() {
    //     var total = 0;

    //     $(".encuestaMedica").each(function() {
    //         if (isNaN(parseFloat($(this).val()))) {
    //             total += 0;
    //         } else {
    //             total += parseFloat($(this).val());
    //         }
    //     });
    //     console.log(total);
    //     $("#respuestaScore").text('El valor es: '+total);

    // }
</script>
<script>
    $(document).ready(function() {
        $("#buscarNombreUserCE").on('change keyup paste', function() {
            var nombreCompleto = this.value;
            // console.log(nombreCompleto);

            // $("#personaSeleccionadaCE").val(nombreCompleto);

            $.ajax({
                type: 'POST',
                url: "{{route('buscarPersonaEncuesta')}}",
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    "no_paciente": nombreCompleto
                },
                success: function(respuesta) {
                    var paciente = JSON.stringify(respuesta);
                    console.log(paciente);


                    if (paciente == '[]') {
                        $("#sigPasoEncuesta1").addClass('disabled');
                        console.log("vacio");
                        $("#personaSeleccionadaCE").val('');
                        $("#personaSeleccionadaCEIDPaciente").val('');
                        $("#personaSeleccionadaCEIDPersona").val('');

                    } else {
                        $.each(JSON.parse(paciente), function(i, item) {
                            // alert(item.no_paciente)
                            $("#personaSeleccionadaCE").val(item.nombre + ' ' + item.apaterno + ' ' + item.amaterno + ' - ' + item.no_paciente)
                            $("#personaSeleccionadaCEIDPaciente").val(item.id_paciente);
                            $("#personaSeleccionadaCEIDPersona").val(item.id_persona)
                        })
                        $("#sigPasoEncuesta1").removeClass('disabled');


                    }




                }
            })
        })
    })
</script>


<script>
    // SCRIPT PARA GENERAR FOLIOS EN DISTINTOS INPUTS
    $("#generarFolioPaciente, #matricula_empleado").click(function(e) {
        e.preventDefault()
        var id = Math.floor(Math.random() * 99999999) + 1000;;
        var nombreUsuario = $("#nombreUsuarioPaciente");
        var matricula_empleado = $("#matricula_empleado");


        if (this.id == "generarFolioPaciente") {
            nombreUsuario.val(id);
        } else if (this.id == "matricula_empleado") {
            matricula_empleado.val(id);
        }
    })

    // SUBMIT FORMULARIO REGISTRAR PACIENTE
    $("#registrarPaciente").click(function(e) {
        e.preventDefault();
        var nombreUsuarioPaciente = $("#nombreUsuarioPaciente").val();
        var nombre_persona = $("#nombre_persona").val();
        var apaterno = $("#apaterno").val();
        var amaterno = $("#amaterno").val();
        var fnac = $("#fnac").val();
        var edad = $("#edad").val();

        console.log(nombreUsuarioPaciente, nombre_persona, apaterno, amaterno, fnac, edad)

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })


        if (nombreUsuarioPaciente == "" || nombreUsuarioPaciente < 5) {
            Toast.fire({
                icon: 'error',
                title: 'El nombre de usuario esta vacio o es demasiado corto.'
            })
        } else if (nombre_persona == "" || nombre_persona < 1) {

            Toast.fire({
                icon: 'error',
                title: 'El nombre del paciente esta vacio o es demasiado corto.'
            })

        } else if (apaterno == "" || apaterno < 1) {

            Toast.fire({
                icon: 'error',
                title: 'El apellido paterno esta vacio o es demasiado corto.'
            })
        } else if (fnac == "" || fnac < 1) {

            Toast.fire({
                icon: 'error',
                title: 'La fecha de nacimiento esta vacia o es demasiada corta.'
            })
        } else if (edad == "" || edad < 0) {

            Toast.fire({
                icon: 'error',
                title: 'La edad esta vacia o no es valida.'
            })

        } else {
            $.ajax({
                type: 'POST',
                url: "{{ route('ajaxGuardarPersona') }}",
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    "nombre_persona": nombre_persona,
                    "apaterno": apaterno,
                    "amaterno": amaterno,
                    "edad": edad,
                    "fnac": fnac,
                    "nombreUsuarioPaciente": nombreUsuarioPaciente
                },
                success: function(respuesta) {
                    console.log(respuesta);
                    if (respuesta > 0) {
                        console.log(respuesta);
                        // alert("Se ha guardado la persona");
                        $("#registroPaciente")[0].reset();
                        $('#tablePersonasDatatable').DataTable().ajax.reload();

                        // alert("Paciente No. " + respuesta + '\n Se ha registrado exitosamente.')

                        Toast.fire({
                            icon: 'success',
                            title: 'Se ha registrado exitosamente el paciente.\nTu ID de paciente es: ' + respuesta
                        })

                        $("#folioPacienteCheck").val(respuesta);
                        $("#modalRegistroPersona").modal('hide');
                        setTimeout(function() {
                            $("#modalCheckPaciente2").modal("show");

                        }, 1500);

                        checkPacientePaso3
                    } else {
                        alert("Ha ocurrido un error al guardar la persona");
                    }
                }
            })
        }

    })
</script>



<script>
    function avisoEncuesta() {
        Swal.fire({
            title: 'AVISO IMPORTANTE',
            html: 'Antes de encuestar a algun paciente, asegurate de que este se encuentre registrado.',
            icon: 'info',
            timer: 3000,
            timerProgressBar: true,

        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {

                $("#menuPacientes").modal('hide');

                setTimeout(function() {
                    return formularioEncuesta()
                }, 777);

            }
        })
    }

    // function generarUsuario() {
    //     function getRandomNumber(minRange, maxRange) {
    //         return Math.floor(Math.random() * (maxRange + 1) + minRange);
    //     }
    //     const rand = getRandomNumber(0, 100);
    //     $('#nombreUsuario').html(rand);

    // }

    function formularioEncuesta() {
        // jQuery.noConflict();
        $('#modalEncuestaPersona').modal('show');

        // $("#").modal("show")
    }

    function buscarPacienteAjax() {

    }

    function registroPaciente() {
        $("#menuPacientes").modal('hide');

        setTimeout(function() {
            $("#modalRegistroPersona").modal("show");
        }, 777);
    }

    function systemVersion() {
        Swal.fire({
            title: 'Versión del sistema',
            text: 'Version estable 3',
            imageUrl: "{{url('/images/logos/llave.png')}}",
            imageWidth: 200,
            imageHeight: 200,
            imageAlt: '',
        })
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // INSERCION/GUARDAR ESTADO AJAX
    $(".btn-submit-restado").click(function(e) {
        e.preventDefault();
        var nombre_estado = $("input[name=nombre_estado]").prop('required', true).val();
        console.log($("meta[name='csrf-token']").attr("content"))

        $.ajax({
            type: 'POST',
            url: "{{ route('ajaxGuardar.estado') }}",
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                'nombre_estado': nombre_estado
            },
            success: function(respuesta) {
                // alert(data.success);
                if (respuesta == 1) {
                    // Swal.fire({
                    //     title: 'Guardado!',
                    //     html: 'Se ha guardado el pais.',
                    //     icon: 'success',
                    //     timer: 1300,
                    //     timerProgressBar: true,

                    // })
                    $("#form-RegistroEstado")[0].reset();
                    $("#adviseStatusCountry").fadeIn();
                    setTimeout(function() {
                        $("#adviseStatusCountry").fadeOut();
                    }, 2000);

                } else {
                    Swal.fire({
                        title: 'AVISO IMPORTANTE',
                        html: 'Ha ocurrido un error, verifica las conexiones.',
                        icon: 'error',
                        timer: 1300,
                        timerProgressBar: true,

                    })
                }
            }
        });
    });
</script>


<!-- <script>
    $(function() {
   
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
            }
        })

 });
</script> -->






































<!-- <script>

    var myModal = document.getElementById('exampleModal');
    document.onreadystatechange = function() {

        myModal.show();
    }
</script> -->
<!-- <script>
    $(document).ready(function() {
        alert("El jQuery funciona correctamente!!");
    });
</script> -->


<!-- {{--  Test Bootstrap css  --}}
<div class="alert alert-success mt-5" role="alert">
    Boostrap 5 is working using laravel 8 mix!
</div>

{{--  popper.js HTML example  --}}
<button id="button" aria-describedby="tooltip">My button</button><br><br>
<div id="tooltip" role="tooltip">My tooltip</div>

{{--    Load compiled Javascript    --}}
<script src="{{ asset('js/app.js') }}"></script>
<script>
    //Test jQuery
    $(document).ready(function () {
        console.log('jQuery works!');

        //Test bootstrap Javascript
        console.log(bootstrap.Tooltip.VERSION);
    });

    //Test popper.js
    const button = document.querySelector('#button');
    const tooltip = document.querySelector('#tooltip');
    const popperInstance = Popper.createPopper(button, tooltip);
</script> -->