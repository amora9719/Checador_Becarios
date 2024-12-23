<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Horas</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            padding-top: 20px;
        }

        .container {
            background-color: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(255, 255, 255, 0.1);
            padding: 30px;
            margin-top: 20px;
        }

        h2 {
            color: #61dafb;
        }

        #tablaRegistros,
        #resumenBecarios {
            width: 100%;
            margin-top: 20px;
        }

        #resumenBecarios .card {
            background-color: #333333;
            color: #ffffff;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="mb-4">Registros de Horas</h2>

        <!-- Resumen de Horas por Becario -->
        <div id="resumenBecarios" class="row">
            <!-- Aquí se mostrará el resumen de horas por becario -->
        </div>


        <!-- Tabla de Registros -->
        <table id="tablaRegistros" class="table table-dark">
            <thead>
                <tr>
                    <th>Nombre del Becario</th>
                    <th>Fecha</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Salida</th>
                    <th>Acciones</th> <!-- Nueva columna para el botón de editar -->
                </tr>
            </thead>
        </table>

        <!-- Modal para editar registro -->
        <div class="modal fade" id="modalEditarRegistro" tabindex="-1" aria-labelledby="modalEditarRegistroLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarRegistroLabel">Editar Registro de Hora</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Contenido del formulario de edición -->
                        <form id="formEditarRegistro">
                            <div class="mb-3">
                                <label for="nombreEditar" class="form-label">Nombre del Becario:</label>
                                <input type="text" class="form-control" id="nombreEditar" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="fechaEditar" class="form-label">Fecha:</label>
                                <input type="text" class="form-control" id="fechaEditar" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="horaEntradaEditar" class="form-label">Hora de Entrada:</label>
                                <input type="time" class="form-control" id="horaEntradaEditar">
                            </div>
                            <div class="mb-3">
                                <label for="horaSalidaEditar" class="form-label">Hora de Salida:</label>
                                <input type="time" class="form-control" id="horaSalidaEditar">
                            </div>
                            <button type="button" class="btn btn-primary" onclick="guardarEdicion()">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Bootstrap JS y Popper.js (Necesarios para Bootstrap) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


        <script>
            $(document).ready(function() {
                // DataTable para la tabla de registros
                $('#tablaRegistros').DataTable({
                    "ajax": "obtener_registros.php",
                    "columns": [{
                            "data": "nombre_becario"
                        },
                        {
                            "data": "fecha"
                        },
                        {
                            "data": "hora_entrada"
                        },
                        {
                            "data": "hora_salida"
                        },
                        {
                            // Columna para el botón de editar
                            "data": null,
                            "render": function(data, type, row) {
                                return '<button type="button" class="btn btn-warning" onclick="editarRegistro(\'' + row.nombre_becario + '\', \'' + row.fecha + '\', \'' + row.hora_entrada + '\', \'' + row.hora_salida + '\')">Editar</button>';
                            }
                        }
                    ],
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "Todos"]
                    ],
                    "language": {
                        "search": "Filtrar:",
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "zeroRecords": "No se encontraron registros",
                        "info": "Mostrando página _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(filtrados de un total de _MAX_ registros)"
                    }
                });

                // Cargar resumen de horas por becario
                cargarResumenBecarios();
            });

            // Función para abrir el modal de edición con los datos actuales
            function editarRegistro(nombre, fecha, horaEntrada, horaSalida) {
                // Rellenar el formulario del modal con los datos actuales
                $('#nombreEditar').val(nombre);
                $('#fechaEditar').val(fecha);
                $('#horaEntradaEditar').val(horaEntrada);
                $('#horaSalidaEditar').val(horaSalida);

                // Mostrar el modal
                $('#modalEditarRegistro').modal('show');
            }

            // Función para guardar los cambios realizados en el modal
            function guardarEdicion() {
                // Obtener los datos del formulario
                var nombre = $('#nombreEditar').val();
                var fecha = $('#fechaEditar').val();
                var horaEntrada = $('#horaEntradaEditar').val();
                var horaSalida = $('#horaSalidaEditar').val();

                // Realizar la llamada AJAX para actualizar el registro en la base de datos
                $.ajax({
                    url: 'editar_registro.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        nombre: nombre,
                        fecha: fecha,
                        horaEntrada: horaEntrada,
                        horaSalida: horaSalida
                    },
                    success: function(response) {
                        if (response.success) {
                            // Actualizar la tabla de registros después de editar
                            $('#tablaRegistros').DataTable().ajax.reload();
                            // Cerrar el modal
                            $('#modalEditarRegistro').modal('hide');
                        } else {
                            alert('Error al editar el registro: ' + response.message);
                        }
                    }
                });
            }

            function cargarResumenBecarios() {
                $.ajax({
                    url: 'resumen_becarios.php',
                    dataType: 'json',
                    success: function(data) {
                        // Construir el HTML para mostrar el resumen de horas por becario
                        var html = '';
                        for (var i = 0; i < data.length; i++) {
                            html += '<div class="col-md-6">';
                            html += '<div class="card">';
                            html += '<div class="card-body">';
                            html += '<h5 class="card-title">' + data[i].nombre + '</h5>';
                            html += '<p class="card-text">Horas registradas: ' + data[i].total_horas + '</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                        }

                        // Insertar el HTML en el contenedor
                        $('#resumenBecarios').html(html);
                    }
                });
            }
        </script>

</body>

</html>