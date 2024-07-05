<?php
include "../../clases/conexion.php";

if (isset($_GET['id']) && isset($_GET['codCatastral'])) {
    $id = $_GET['id'];
    $codCatastral = $_GET['codCatastral'];
    $codCatastralconB = $codCatastral . '-B';  // Concatenar '-B' a $codCatastral

    $conexion = new Conexion();
    $conn = $conexion->conectar();

    $sql = "UPDATE tributos SET codEntidad=? WHERE codEntidad = ? AND identificacion = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {  
        // Error al preparar la declaración
        header("Location: losPropietarios.php?codCatastral=$codCatastral&mensaje=error_preparar");
        exit();
    }

    $stmt->bind_param("sss", $codCatastralconB, $codCatastral, $id);
    
    if ($stmt->execute()) {
        // Redirigir a la página de losPropietarios con un mensaje de éxito
        header("Location: losPropietarios.php?codCatastral=$codCatastral&mensaje=contribuyente_debaja");
    } else {
        // Redirigir a la página de losPropietarios con un mensaje de error
        header("Location: losPropietarios.php?codCatastral=$codCatastral&mensaje=error_bajacontribuyente");
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirigir a la página de losPropietarios con un mensaje de error
    header("Location: losPropietarios.php?mensaje=error_parametros");
    exit();
}
?>


