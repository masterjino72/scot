<?php
     include "../../clases/Conexion.php";

     $categoria = $_POST['categoria'];
     
     $conexion = new Conexion();
     $conexion = $conexion->conectar();


     // Verificar si la categoria ya existe
     $sql_categoria_existente = "SELECT COUNT(*) as count FROM categorias WHERE categoria = ?";
     $query_categoria_existente = $conexion->prepare($sql_categoria_existente);
     $query_categoria_existente->bind_param('s', $categoria);
     $query_categoria_existente->execute();
     $resultado_categoria_existente = $query_categoria_existente->get_result()->fetch_assoc();

     if ($resultado_categoria_existente['count'] > 0) {
          // Categoria ya está en uso
          header("Location: categorias.php?mensaje=categoria_existente");
          exit();
     }

     $sql = "INSERT INTO categorias (categoria) VALUES (?)";  
     $query = $conexion->prepare($sql);
     $query->bind_param('s', $categoria);
     if ($query->execute()) {
          header("Location: categorias.php?mensaje=categoria_registrada");
     } else {
          header("Location: categorias.php?mensaje=categoria_noregistrada");
     }

?>
