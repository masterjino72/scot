<?php
     include "../../clases/Conexion.php";

     // Función para sanitizar entradas
     function sanitizarEntrada($data) {
          return htmlspecialchars(strip_tags(trim($data)));
     }

     $id = sanitizarEntrada($_POST['id']);
     $codFinca = sanitizarEntrada($_POST['codFinca']);
     $comunidad = sanitizarEntrada($_POST['comunidad']);
     $fecRegistro = sanitizarEntrada($_POST['fecRegistro']);
     $estadoFierro = 'ACTIVO';

     try {
          $conexion = new Conexion();
          $conexion = $conexion->conectar();
          // Verificar conexión
          if ($conexion->connect_error) {
               throw new Exception("Error de conexión: " . $conexion->connect_error);
          }
          // Verificar si el codigo de finca ya existe
          $sql_codFinca_existente = "SELECT COUNT(*) as count FROM fierros WHERE codFinca = ?";
          $query_codFinca_existente = $conexion->prepare($sql_codFinca_existente);
          if (!$query_codFinca_existente) { // Verificar si la preparación fue exitosa
               throw new Exception("Error en la preparación de la consulta (codFinca_existente): " . $conexion->error);
          }
          $query_codFinca_existente->bind_param('s', $codFinca);
          $query_codFinca_existente->execute();
          $resultado_codFinca_existente = $query_codFinca_existente->get_result()->fetch_assoc();

          if ($resultado_codFinca_existente['count'] > 0) {
               // El codigo de finca ya está en uso
               header("Location: fierros.php?id=" . urlencode($id) . "&mensaje=codFinca_existente");
               exit();
          }

          // Si todo está bien, procedemos con la inserción
          $sql = "INSERT INTO fierros (codFinca, comunidad, fecRegistro, estadoFierro) VALUES (?, ?, ?, ?)";
          $query = $conexion->prepare($sql);
          if (!$query) { // Verificar si la preparación fue exitosa
               throw new Exception("Error en la preparación de la consulta (inserción): " . $conexion->error);
               exit();
          }
          $query->bind_param('ssss', $codFinca, $comunidad, $fecRegistro, $estadoFierro);
          if ($query->execute()) {
               $sql = "INSERT INTO tributos (identificacion, tipoEntidad, codEntidad) VALUES (?, 'FIERRO', ?)";
               $query = $conexion->prepare($sql);
               $query->bind_param('ss', $id, $codFinca);
               $query->execute();
               header("Location: fierros.php?id=" . urlencode($id) . "&mensaje=fierro_registrado");
          } else {
               throw new Exception("Error en la ejecución de la inserción: " . $query->error);
               exit();
          }

          // Cerrar declaración y conexión
          $query_codLote_existente->close();
          $query->close();
          $conexion->close();
     } catch (Exception $e) {
          // Manejo de errores
          echo "Error: " . $e->getMessage();
          exit();
     }
?>
