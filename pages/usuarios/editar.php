<?php
include "../../clases/conexion.php";

// Verificar si se recibieron datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identificacion = $_POST['identificacion_editar'];
    $nombre1 = $_POST['nombre1_editar'];
    $nombre2 = $_POST['nombre2_editar'];
    $apellido1 = $_POST['apellido1_editar'];
    $apellido2 = $_POST['apellido2_editar'];
    $email = $_POST['email_editar'];
    $celular = $_POST['celular_editar'];
    $direccion = $_POST['direccion_editar'];
    $estado = $_POST['estado_editar'];

    // Realizar la actualización en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->conectar();
    $sql = "UPDATE usuarios SET nombre1=?, nombre2=?, apellido1=?, apellido2=?, email=?, celular=?, direccion=?, estado=? WHERE identificacion=?";
    //Sentencia Preparada (prepared statement)
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sssssssss", $nombre1, $nombre2, $apellido1, $apellido2, $email, $celular, $direccion, $estado, $identificacion);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("location: usuarios.php?editado=true");
    } else {
        echo "Error al actualizar el usuario: " . $stmt->error;
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
}
?>


?>