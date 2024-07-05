<?php
include "../../clases/conexion.php";

if (isset($_GET['id1']) && isset($_GET['id']) && isset($_GET['codCatastral'])) {
    $id1 = $_GET['id1'];
    $id = $_GET['id'];
    $codCatastral = $_GET['codCatastral'];

    $conexion = new Conexion();
    $conn = $conexion->conectar();

    $sql = "INSERT INTO tributos (identificacion, tipoEntidad, codEntidad) VALUES (?, 'IBI', ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {  
        // Error al preparar la declaración
        header("Location: nuevosPropietarios.php?codCatastral=$codCatastral&id=$id1&mensaje=error_preparar");
        exit();
    }

    $stmt->bind_param("ss", $id, $codCatastral);
    
    if ($stmt->execute()) {
        // Redirigir a la página de IBIS con un mensaje de éxito
        $sql = "INSERT INTO tributos (identificacion, tipoEntidad, codEntidad) VALUES (?, 'TA', ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $id, $codCatastral);
        $stmt->execute();
        header("Location: ibi.php?id=$id1&mensaje=nuevoCntribuyente_agregado");
    } else {
        // Redirigir a la página de IBIS con un mensaje de error
        header("Location: ibi.php?id=$id1&mensaje=error_nuevoContribuyente");
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirigir a la página de losPropietarios con un mensaje de error
    header("Location: ibi.php?id=$id1&mensaje=error_parametros");
    exit();
}
?>


