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
}
</script>
