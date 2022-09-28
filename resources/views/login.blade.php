<?php
if (session('id_usuario')) {
    header('Location: dashboard');
    die();
} else {
    header('Location: login'); //Aqui lo redireccionas al lugar que quieras.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <title>Login</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
   *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-image: url('/images/logos/2.jpeg') ;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #23A2DA,
        #23A2DA
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #23A2DA,
        #23A2DA
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 520px;
    width: 400px;
    background-color: rgba(255,255,255, 0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #000000;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 5px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: black;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
button:hover {
  background: #48E9DD;
}
</style>

<body>

<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form id="inicio_sesion">
        <h3>Iniciar sesión</h3>

        <img src="{{url('/images/logos/hospital.png')}}"  style="height: 18%; margin-left: 36%;">
        <label for="username">Correo:</label>
        <input type="email" placeholder="Escribe tu correo" id="correo" required maxlength="25">

        <label for="password">Contraseña:</label>
        <input type="password" placeholder="Escribe tu contraseña" id="contrasena" required maxlength="10">
        <button style="width: 70%; margin-left: 15%;" class="btn btn-primary iniciar-sesion-boton" type="submit">Iniciar sesión</button>
        <p style="text-align: center;" class="mt-5 mb-3 text-muted">Mi Asistente de Emergencias</p>
        
    </form>
</body>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".iniciar-sesion-boton").click(function(e) {
        e.preventDefault();
        var correo = $("#correo").val();
        var contrasena = $("#contrasena").val();
        // console.log(correo)
        // console.log(contrasena)
        // console.log($("meta[name='csrf-token']").attr("content"))

        $.ajax({
            type: 'POST',
            url: "{{ route('AjaxbuscarUsuario') }}",
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                correo: correo,
                contrasena: contrasena
            },
            success: function(respuesta) {

                // alert(data.success);
                console.log(respuesta)
                if (respuesta == 'user_sucss') {
                    Swal.fire(
                        'Inicio de Sesion',
                        'Te redireccionaremos a tu panel de control.',
                        'success'
                    )

                    setTimeout(function() {
                        window.location.href = '{{url("dashboard")}}';
                    }, 2000);
                }
                if (respuesta == "pass_err" || respuesta == "wrong_email") {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: 'Verifica el usuario y contraseña.'
                    })

                    setTimeout(function() {}, 2000);
                }
            },
            error: function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: 'Verifica el usuario y contraseña.'
                })
            }
        });
    });
</script>

<script>


</script>

</html>