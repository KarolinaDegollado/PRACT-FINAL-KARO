<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intento de ingreso</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
</body>

</html>

<script>
    // setTimeout(function() {
    //     window.location.href = '{{url("login")}}';

    // }, 5000);

    // Swal.fire({
    //     title: '<strong>No has iniciado sesion!!</strong>',
    //     icon: 'info',

    //     showCloseButton: true,
    //     focusConfirm: false,
    //     confirmButtonText: '<a class="fa fa-thumbs-up" href="/login">Ir al login</a> ',
    //     confirmButtonAriaLabel: 'Thumbs up, great!',
    // })


    let timerInterval
    Swal.fire({
        title: 'No has iniciado sesion.',
        html: 'Te redirigiremos al login en <b></b> segundos.',
        allowOutsideClick: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
                b.textContent = (Swal.getTimerLeft() / 1000).toFixed(0)
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
        }
    })
    setTimeout(function() {
        window.location.href = '{{url("login")}}';
    }, 5000);
</script>