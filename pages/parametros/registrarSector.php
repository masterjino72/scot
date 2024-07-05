<?php
     include "../../clases/Conexion.php";

     $sector = $_POST['sector'];
     
     $conexion = new Conexion();
     $conexion = $conexion->conectar();


     // Verificar si el sector  ya existe
     $sql_sector_existente = "SELECT COUNT(*) as count FROM sectores WHERE sector = ?";
     $query_sector_existente = $conexion->prepare($sql_sector_existente);
     $query_sector_existente->bind_param('s', $sector);
     $query_sector_existente->execute();
     $resultado_sector_existente = $query_sector_existente->get_result()->fetch_assoc();

     if ($resultado_sector_existente['count'] > 0) {
          // sector ya está en uso
          header("Location: sectores.php?mensaje=sector_existente");
          exit();
     }

     $sql = "INSERT INTO sectores (sector) VALUES (?)";  
     $query = $conexion->prepare($sql);
     $query->bind_param('s', $sector);
     if ($query->execute()) {
          header("Location: sectores.php?mensaje=sector_registrado");
     } else {
          header("Location: sectores.php?mensaje=sector_noregistrado");
     }

?>
