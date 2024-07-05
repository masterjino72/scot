<?php
     include "../../clases/Conexion.php";

     $codBarrio = $_POST['codBarrio'];
     $nomBarrio = $_POST['nomBarrio'];
     $tipoBarrio = $_POST['tipoBarrio'];
     $distrito = $_POST['nomDistrito'];
     
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

     // Verificar si el codigo de barrio ya existe
     $sql_codBarrio_existente = "SELECT COUNT(*) as count FROM barrios WHERE codBarrio = ?";
     $query_codBarrio_existente = $conexion->prepare($sql_codBarrio_existente);
     $query_codBarrio_existente->bind_param('s', $codBarrio);
     $query_codBarrio_existente->execute();
     $resultado_codBarrio_existente = $query_codBarrio_existente->get_result()->fetch_assoc();

     if ($resultado_codBarrio_existente['count'] > 0) {
          // El codigo de barrio ya está en uso
          header("Location: barrios.php?mensaje=codBarrio_existente");
          exit();
     }

     // Verificar si la barrio y distrito ya existe
     $sql_barrioDistrito_existente = "SELECT COUNT(*) as count FROM barrios WHERE barrio = ? AND distrito = ?";
     $query_barrioDistrito_existente = $conexion->prepare($sql_barrioDistrito_existente);
     $query_barrioDistrito_existente->bind_param('ss', $nomBarrio, $distrito);
     $query_barrioDistrito_existente->execute();
     $resultado_barrioDistrito_existente = $query_barrioDistrito_existente->get_result()->fetch_assoc();

     if ($resultado_barrioDistrito_existente['count'] > 0) {
          // La barrio y distrito ya está en uso
          header("Location: barrios.php?mensaje=barrioDistrito_existente");
          exit();
     }

     // Si todo está bien, procedemos con la inserción
     $sql = "INSERT INTO barrios (codBarrio, barrio, tipoBarrio, distrito) VALUES (?, ?, ?, ?)";  
     $query = $conexion->prepare($sql);
     $query->bind_param('ssss', $codBarrio, $nomBarrio, $tipoBarrio, $distrito);
     if ($query->execute()) {
          header("Location: barrios.php?mensaje=barrio_registrado");
     } else {
          header("Location: barrios.php?mensaje=barrio_noregistrado");
     }

?>
