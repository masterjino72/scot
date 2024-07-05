<?php
include "../../clases/conexion.php";

// Verificar si se recibieron datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idSector = $_POST['idSector_editar'];
    $sector = $_POST['sector_editar'];
    
    // Realizar la actualización en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Verificar si el sector ya existe
    $sql_sector_existente = "SELECT COUNT(*) as count FROM sectores WHERE sector = ?";
    $query_sector_existente = $conn->prepare($sql_sector_existente);
    $query_sector_existente->bind_param('s', $sector);
    $query_sector_existente->execute();
    $resultado_sector_existente = $query_sector_existente->get_result()->fetch_assoc();

    if ($resultado_sector_existente['count'] > 0) {
        // sector ya está en uso
        header("Location: sectores.php?mensaje=sector_existente");
        exit();
    }

    $sql = "UPDATE sectores SET sector=? WHERE idSector=?";
    //Sentencia Preparada (prepared statement)
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ss", $sector, $idSector);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("location: sectores.php?editado=true");
    } else {
        echo "Error al actualizar la sector: " . $stmt->error;
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
}

?>