<?php
include "../../clases/conexion.php";

// Verificar si se recibieron datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idBarrio = $_POST['id_editar'];
    $codBarrio = $_POST['codBarrio_editar'];
    $barrio = $_POST['nomBarrio_editar'];
    $tipoBarrio = $_POST['tipoBarrio_editar'];
    $distrito = $_POST['nomDistrito_editar'];
    
    // Realizar la actualización en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->conectar();
    $sql = "UPDATE barrios SET codBarrio=?, barrio=?, tipoBarrio=?, distrito=? WHERE idBarrio=?";
    //Sentencia Preparada (prepared statement)
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssssi", $codBarrio, $barrio, $tipoBarrio, $distrito, $idBarrio);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("location: barrios.php?editado=true");
    } else {
        echo "Error al actualizar el barrio: " . $stmt->error;
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
}
?>
