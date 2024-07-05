<?php
include "../../clases/conexion.php";

// Verificar si se recibieron datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCementerio = $_POST['idCementerio_editar'];
    $cementerio = $_POST['cementerio_editar'];
    
    // Realizar la actualización en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Verificar si el cementerio ya existe
    $sql_cementerio_existente = "SELECT COUNT(*) as count FROM cementerios WHERE cementerio = ?";
    $query_cementerio_existente = $conn->prepare($sql_cementerio_existente);
    $query_cementerio_existente->bind_param('s', $cementerio);
    $query_cementerio_existente->execute();
    $resultado_cementerio_existente = $query_cementerio_existente->get_result()->fetch_assoc();

    if ($resultado_cementerio_existente['count'] > 0) {
        // cementerio ya está en uso
        header("Location: cementerios.php?mensaje=cementerio_existente");
        exit();
    }

    $sql = "UPDATE cementerios SET cementerio=? WHERE idCementerio=?";
    //Sentencia Preparada (prepared statement)
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ss", $cementerio, $idCementerio);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("location: cementerios.php?editado=true");
    } else {
        echo "Error al actualizar el cementerio: " . $stmt->error;
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
}

?>