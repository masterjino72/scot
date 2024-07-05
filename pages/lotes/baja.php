<?php
include "../../clases/conexion.php";

if (isset($_GET['id']) && isset($_GET['cLote'])) {
    $id = $_GET['id'];
    $cLote = $_GET['cLote'];
    $cLoteConB = $cLote . '-B';  // Concatenar '-B' a cLote
    $conexion = new Conexion();
    $conn = $conexion->conectar();
    
    $sqlLote = "UPDATE lotes SET estadoLote = 'LIBRE' WHERE codLote = ?";
    $stmt = $conn->prepare($sqlLote);
    if ($stmt === false) {
        // Redirigir a la página de loteContribuyente con un mensaje de error de preparación
        header("Location: loteContribuyente.php?mensaje=error_preparacion");
        exit;
    }
    $stmt->bind_param("s", $cLote);
    $stmt->execute();

    $sqlTributos = "UPDATE tributos SET codEntidad = ? WHERE identificacion = ? AND codEntidad = ?";
    $stmt = $conn->prepare($sqlTributos);
    if ($stmt === false) {
        // Redirigir a la página de loteContribuyente con un mensaje de error de preparación
        header("Location: loteContribuyente.php?mensaje=error_preparacion");
        exit;
    }
    $stmt->bind_param("sss", $cLoteConB, $id, $cLote);
    
    if ($stmt->execute()) {
        // Redirigir a la página de loteContribuyente con un mensaje de éxito
        header("Location: loteContribuyente.php?id=" . urlencode($id) . "&mensaje=tributoBaja");
    } else {
        // Redirigir a la página de loteContribuyente con un mensaje de error en la ejecución
        header("Location: loteContribuyente.php?mensaje=error_tributoBaja");
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirigir a la página de loteContribuyente con un mensaje de error en los parámetros
    header("Location: loteContribuyente.php?mensaje=error_parametros");
}
?>
