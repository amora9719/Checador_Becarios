<?php
include 'conexion.php';

$consulta = "SELECT nombre_becario AS nombre, SUM(IFNULL(TIME_TO_SEC(hora_salida), 0) - IFNULL(TIME_TO_SEC(hora_entrada), 0)) / 3600 AS total_horas FROM registros_horas GROUP BY nombre_becario";
$resultado = $conn->query($consulta);

$resumen = array();

while ($fila = $resultado->fetch_assoc()) {
    $resumen[] = $fila;
}

echo json_encode($resumen);

$conn->close();
