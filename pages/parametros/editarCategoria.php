<?php
include "../../clases/conexion.php";

// Verificar si se recibieron datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCategoria = $_POST['idCategoria_editar'];
    $categoria = $_POST['categoria_editar'];
    
    // Realizar la actualización en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Verificar si la categoria ya existe
    $sql_categoria_existente = "SELECT COUNT(*) as count FROM categorias WHERE categoria = ?";
    $query_categoria_existente = $conn->prepare($sql_categoria_existente);
    $query_categoria_existente->bind_param('s', $categoria);
    $query_categoria_existente->execute();
    $resultado_categoria_existente = $query_categoria_existente->get_result()->fetch_assoc();

    if ($resultado_categoria_existente['count'] > 0) {
        // Categoria ya está en uso
        header("Location: categorias.php?mensaje=categoria_existente");
        exit();
    }

    $sql = "UPDATE categorias SET categoria=? WHERE idCategoria=?";
    //Sentencia Preparada (prepared statement)
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ss", $categoria, $idCategoria);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("location: categorias.php?editado=true");
    } else {
        echo "Error al actualizar la categoria: " . $stmt->error;
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
}

?>