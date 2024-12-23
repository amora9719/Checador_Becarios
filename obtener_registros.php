<?php
include 'conexion.php';

$consulta = "SELECT nombre_becario, fecha, hora_entrada, hora_salida FROM registros_horas";
$resultado = $conn->query($consulta);

$registros = array();

while ($fila = $resultado->fetch_assoc()) {
    $registros[] = $fila;
}

echo json_encode(array("data" => $registros));

$conn->close();
