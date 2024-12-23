<?php
include 'conexion.php';

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$horaEntrada = $_POST['horaEntrada'];
$horaSalida = $_POST['horaSalida'];

// Realizar la actualización en la base de datos
$actualizarQuery = "UPDATE registros_horas SET hora_entrada = '$horaEntrada', hora_salida = '$horaSalida' WHERE nombre_becario = '$nombre' AND fecha = '$fecha'";
$resultado = $conn->query($actualizarQuery);

if ($resultado) {
    $response = array("success" => true, "message" => "Registro actualizado correctamente");
} else {
    $response = array("success" => false, "message" => "Error al actualizar el registro: " . $conn->error);
}

echo json_encode($response);

$conn->close();
