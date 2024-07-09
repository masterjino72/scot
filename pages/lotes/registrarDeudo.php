<?php
     include "../../clases/Conexion.php";

     $codEntidad = $_POST['codEntidad'];
     $cedula = $_POST['cedula'];
     $nombreDeudo = $_POST['nombreDeudo'];
     $sexo = $_POST['sexo'];
     $fecDefuncion = $_POST['fecDefuncion'];
     $id = $_POST['identificacion'];
     
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

     // Verificar si la cedula ya existe
     $sql_cedula_existente = "SELECT COUNT(*) as count FROM deudos WHERE cedula = ?";
     $query_cedula_existente = $conexion->prepare($sql_cedula_existente);
     $query_cedula_existente->bind_param('s', $cedula);
     $query_cedula_existente->execute();
     $resultado_cedula_existente = $query_cedula_existente->get_result()->fetch_assoc();

     if ($resultado_cedula_existente['count'] > 0) {
          // Cedula ya registrada
          header("Location: loteDeudo.php?id=$id&mensaje=cedula_existente");
          exit();
     }

     // Antes de la ejecución de la consulta INSERT
     error_log("Intentando insertar: cedula=$cedula, nombreDeudo=$nombreDeudo, sexo=$sexo, fecDefuncion=$fecDefuncion, codEntidad=$codEntidad");

     // Si todo está bien, procedemos con la inserción
     $sql = "INSERT INTO deudos (cedula, nomDeudo, sexo, fecDefuncion, codLote) VALUES (?, ?, ?, ?, ?)";  
     $query = $conexion->prepare($sql);
     $query->bind_param('sssss', $cedula, $nombreDeudo, $sexo, $fecDefuncion, $codEntidad);
     if ($query->execute()) {
          header("Location: loteDeudo.php?id=$id&mensaje=deudo_registrado");
     } else {
          header("Location: loteDeudo.php?id=$id&mensaje=deudo_noregistrado");
     }

?>
