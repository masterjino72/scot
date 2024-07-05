<?php
     include "../../clases/Conexion.php";

     $cementerio = $_POST['cementerio'];
     
     $conexion = new Conexion();
     $conexion = $conexion->conectar();


     // Verificar si el cementerio  ya existe
     $sql_cementerio_existente = "SELECT COUNT(*) as count FROM cementerios WHERE cementerio = ?";
     $query_cementerio_existente = $conexion->prepare($sql_cementerio_existente);
     $query_cementerio_existente->bind_param('s', $cementerio);
     $query_cementerio_existente->execute();
     $resultado_cementerio_existente = $query_cementerio_existente->get_result()->fetch_assoc();

     if ($resultado_cementerio_existente['count'] > 0) {
          // cementerio ya está en uso
          header("Location: cementerios.php?mensaje=cementerio_existente");
          exit();
     }

     $sql = "INSERT INTO cementerios (cementerio) VALUES (?)";  
     $query = $conexion->prepare($sql);
     $query->bind_param('s', $cementerio);
     if ($query->execute()) {
          header("Location: cementerios.php?mensaje=cementerio_registrado");
     } else {
          header("Location: cementerios.php?mensaje=cementerio_noregistrado");
     }

?>
