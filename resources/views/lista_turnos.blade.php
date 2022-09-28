<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Turnos</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" src="{{ asset('css/app.css') }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-uuid/1.4.7/uuid.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.css" />
</head>
<style>
    .dataTables_wrapper .dataTables_processing {

        position: absolute;
        top: 50% !important;
        background: 'gold';
        border: 1px solid black;
        border-radius: 3px;
        font-weight: bold;
    }
</style>

<body>
    <div>
        <div class="card">
            <h4 class="card-header">CONSULTAS</h4>
            <div hidden> REVISAR LA TABLA, YA QUE LOS VALORES NULOS DE FK EMPLEADO Y FK CONSULTORIO NO MUESTRAN ESOS REGISTROS EN LA TABLA HASTA QUE ESOS MISMOS REGISTROS SE LLENEN CON INFORMACION</div>
            <div class="card-body">
                <table class="table table-bordered table-striped consultas_table" style="width: 100%;" id="tableConsultaDatatable">
                    <thead>
                        <tr>
                            <!-- <th scope="col">Folio paciente</th> -->
                            <!-- <th scope="col">No. Paciente</th> -->
                            <th scope="col">FECHA & HORA TURNO</th>
                            <th scope="col">FOLIO DE CONSULTA</th>
                            <!-- <th scope="col">Nombre</th>
                                    <th scope="col">Apellido paterno</th>
                                    <th scope="col">Apellido materno</th> -->
                            <th scope="col">TIPO DE CONSULTA</th>
                            <th scope="col">TURNO</th>
                            <th scope="col">NOMBRE COMPLETO</th>
                            <th scope="col">CONSULTORIO</th>
                            <th scope="col">ESTATUS TURNO</th>

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

</body>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.js"></script>

<script>
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

        $(".consultas_table").DataTable({
            // false en processing para quitar el procesando
            // "columnDefs": [{
            //         "width": "5%",
            //         "targets": [0]
            //     },
            //     {
            //         "className": "text-center custom-middle-align",
            //         "targets": [2, 3, 4, 5, 6]
            //     },
            // ],

            "columnDefs": [{
                "targets": ('fk_empleado', 'fk_consultorio'),
                "defaultContent": ""
            }],
            processing: false,
            serverSide: true,
            responsive: true,
            ajax: "{{route('verConsultasTurno')}}",
            dataType: 'json',
            type: 'POST',

            columns: [{
                    data: 'fecha_hora_turno',
                    name: 'fecha_hora_turno'
                },
                {
                    data: "folio_consulta",
                    name: "folio_consulta"
                },
                {
                    data: 'tipo_consulta',
                    name: 'tipo_consulta'
                },
                {
                    data: "turno",
                    name: 'turno'
                },

                {
                    data: 'nombre_completo',
                    name: 'nombre_completo'
                },
                {
                    data: 'numero_consultorio',
                    name: 'numero_consultorio'

                },
                {
                    data: 'estatus_turno',
                    data: 'estatus_turno'
                }
            ]
        });


    })

    timer = setInterval(function() {

        console.log("ACTUALIZACION CADA 10 SEGUNDOS")

        $.ajax({
            url: "{{route('verificarActTurno')}}",
            type: 'POST',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
            },
            success: function(respuesta) {
                console.log(respuesta)
                var turno = JSON.stringify(respuesta);
                if (turno == '[]') {
                    console.log("vacio");


                } else {
                    $.each(JSON.parse(turno), function(i, item) {
                        // alert(item.no_paciente)
                        console.log(item.turno_actualizado)
                        var turno_actualizado = item.turno_actualizado;

                        if (turno_actualizado == 1) {
                            // FOLIO DE CONSULTA
                            // TURNO
                            // CONSULTORIO
                            // ESTATUS TURNO
                            console.log("Se ejecutara una consulta para sacar los datos de la tabla turnos");
                            $('#tableConsultaDatatable').DataTable().ajax.reload();

                        } else {
                            console.log("No hay novedades.")
                        }
                    })


                }

                // $("#exampleModalPopovers").modal("show");
            }
        })
    }, 3000);
</script>

</html>