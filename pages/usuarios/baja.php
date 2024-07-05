<?php
include "../../clases/conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conexion = new Conexion();
    $conn = $conexion->conectar();
    
    $sql = "UPDATE usuarios SET estado='B'  WHERE identificacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    
    if ($stmt->execute()) {
        // Redirigir a la página de usuarios con un mensaje de éxito (opcional)
        header("Location: usuarios.php?mensaje=usuario_eliminado");
    } else {
        // Redirigir a la página de usuarios con un mensaje de error (opcional)
        header("Location: usuarios.php?mensaje=error_eliminar_usuario");
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirigir a la página de usuarios con un mensaje de error (opcional)
    header("Location: usuarios.php?mensaje=error_parametros");
}
?>

