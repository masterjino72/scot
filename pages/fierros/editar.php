<?php
include "../../clases/conexion.php";

// Verificar si se recibieron datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['identificacion'];
    $codFinca = $_POST['codFinca_editar'];
    $comunidad = $_POST['comunidad_editar'];
    $fecRegistro = $_POST['fecRegistro_editar'];
    
    // Realizar la actualización en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->conectar();
    $sql = "UPDATE fierros SET comunidad=?, fecRegistro=? WHERE codFinca=?";
    //Sentencia Preparada (prepared statement)
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sss", $comunidad, $fecRegistro, $codFinca);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: fierros.php?id=" . urlencode($id));
    } else {
        echo "Error al actualizar el fierro: " . $stmt->error;
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
}
?>