<?php
include "../../clases/conexion.php";

// Verificar si se recibieron datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parametro = $_POST['parametro_editar'];
    $fecha1 = $_POST['fecha1_editar'];
    $fecha2 = $_POST['fecha2_editar'];
    $porcentaje = $_POST['porcentaje_editar'];
    
    // Realizar la actualización en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->conectar();
    $sql = "UPDATE parametros SET fecha1=?, fecha2=?, porcentaje=? WHERE parametro=?";
    //Sentencia Preparada (prepared statement)
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssds", $fecha1, $fecha2, $porcentaje, $parametro);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("location: parametros.php?editado=true");
    } else {
        echo "Error al actualizar el parametro: " . $stmt->error;
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
}

?>