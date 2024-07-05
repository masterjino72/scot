<?php
include "../../clases/conexion.php";

if (isset($_GET['id']) && isset($_GET['codFinca'])) {
    $id = $_GET['id'];
    $cFinca = $_GET['codFinca'];
    $conexion = new Conexion();
    $conn = $conexion->conectar();
    
    $sqlFinca = "UPDATE fierros SET estadoFierro = 'ACTIVO' WHERE codFinca = ?";
    $stmt = $conn->prepare($sqlFinca);
    if ($stmt === false) {
        // Redirigir a la página de fierros con un mensaje de error de preparación
        header("Location: fierros.php?mensaje=error_preparacion");
        exit;
    }
    $stmt->bind_param("s", $cFinca);
        
    if ($stmt->execute()) {
        // Redirigir a la página de fierros con un mensaje de éxito
        header("Location: fierros.php?id=" . urlencode($id) . "&mensaje=tributoBaja");
    } else {
        // Redirigir a la página de fierros con un mensaje de error en la ejecución
        header("Location: fierros.php?mensaje=error_tributoBaja");
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirigir a la página de fierros con un mensaje de error en los parámetros
    header("Location: fierros.php?mensaje=error_parametros");
}
?>

