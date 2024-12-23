<?php
include 'conexion.php';

date_default_timezone_set('America/Mexico_City'); // Cambia 'America/Mexico_City' a tu zona horaria deseada

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreBecario = $_POST["nombre"];
    $tipo = $_POST["tipo"];

    $fecha = date("Y-m-d");
    $hora = date("H:i:s");

    // Verificar si ya existe un registro para este becario en la misma fecha
    $consulta = "SELECT * FROM registros_horas WHERE nombre_becario = '$nombreBecario' AND fecha = '$fecha'";
    $resultado = $conn->query($consulta);

    if ($resultado->num_rows > 0) {
        // Registro existente, actualizar la hora de entrada o salida según el tipo
        $registro = $resultado->fetch_assoc();

        if ($tipo === 'entrada' && $registro['hora_entrada'] === null) {
            $sql = "UPDATE registros_horas SET hora_entrada = '$hora' WHERE id = " . $registro['id'];
        } elseif ($tipo === 'salida' && $registro['hora_salida'] === null) {
            $sql = "UPDATE registros_horas SET hora_salida = '$hora' WHERE id = " . $registro['id'];
        } else {
            $response = array("success" => false, "message" => "Ya existe un registro para este becario en la fecha actual.");
            echo json_encode($response);
            $conn->close();
            exit;
        }
    } else {
        // Nuevo registro
        $sql = "INSERT INTO registros_horas (nombre_becario, fecha, hora_entrada, hora_salida)
                VALUES ('$nombreBecario', '$fecha', " . ($tipo === 'entrada' ? "'$hora'" : "NULL") . ", " . ($tipo === 'salida' ? "'$hora'" : "NULL") . ")";
    }

    if ($conn->query($sql) === TRUE) {
        $response = array("success" => true, "message" => "Registro de hora realizado correctamente.");
    } else {
        $response = array("success" => false, "message" => "Error al registrar la hora: " . $conn->error);
    }

    echo json_encode($response);

    $conn->close();
}
