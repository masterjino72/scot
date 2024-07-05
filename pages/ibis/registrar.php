<?php
     include "../../clases/Conexion.php";

     // Función para sanitizar entradas
     function sanitizarEntrada($data) {
          return htmlspecialchars(strip_tags(trim($data)));
     }

     var_dump($_POST);

     $id = sanitizarEntrada($_POST['id']);
     $codCatastral = sanitizarEntrada($_POST['codCatastral']);
     $ubicacion = sanitizarEntrada($_POST['ubicacion']);
     $construccion = sanitizarEntrada($_POST['construccion']);
     $tipoIBI = sanitizarEntrada($_POST['tipoIBI']);
     $usoIBI = sanitizarEntrada($_POST['usoIBI']);
     $valorCatastral = sanitizarEntrada($_POST['valorCatastral']);
     $finca = sanitizarEntrada($_POST['finca']);
     $folio = sanitizarEntrada($_POST['tomo']);
     $tomo = sanitizarEntrada($_POST['folio']);
     $asiento = sanitizarEntrada($_POST['asiento']);
     $tAseo = isset($_POST['tAseo']) ? 'S' : 'N'; // Verificar si está marcado o no
     $barrido = isset($_POST['barrido']) ? 'S' : 'N'; // Verificar si está marcado o no
     $estadoIBI = 'ACTIVO';

     try {
          $conexion = new Conexion();
          $conexion = $conexion->conectar();
          // Verificar conexión
          if ($conexion->connect_error) {
               throw new Exception("Error de conexión: " . $conexion->connect_error);
          }
          // Verificar si el codigo de finca ya existe
          $sql_codCatastral_existente = "SELECT COUNT(*) as count FROM ibi WHERE codCatastral = ?";
          $query_codCatastral_existente = $conexion->prepare($sql_codCatastral_existente);
          if (!$query_codCatastral_existente) { // Verificar si la preparación fue exitosa
               throw new Exception("Error en la preparación de la consulta (codCatastral_existente): " . $conexion->error);
          }
          $query_codCatastral_existente->bind_param('s', $codCatastral);
          $query_codCatastral_existente->execute();
          $resultado_codCatastral_existente = $query_codCatastral_existente->get_result()->fetch_assoc();

          if ($resultado_codCatastral_existente['count'] > 0) {
               // El codigo de Catastral ya está en uso
               header("Location: ibi.php?id=" . urlencode($id) . "&mensaje=codCatastral_existente");
               exit();
          }

          // Si todo está bien, procedemos con la inserción
          $sql = "INSERT INTO ibi (codCatastral, ubicacion, construccion, tipoIBI, uso, TA, barrido, valorCatastral, finca, folio, tomo, asiento, estadoIBI) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $query = $conexion->prepare($sql);
          if (!$query) { // Verificar si la preparación fue exitosa
               throw new Exception("Error en la preparación de la consulta (inserción): " . $conexion->error);
               exit();
          }
          $query->bind_param('sssssssssssss', $codCatastral, $ubicacion, $construccion, $tipoIBI, $usoIBI, $tAseo, $barrido, $valorCatastral, $finca, $folio, $tomo, $asiento, $estadoIBI);
          if ($query->execute()) {
               $sql = "INSERT INTO tributos (identificacion, tipoEntidad, codEntidad) VALUES (?, 'IBI', ?)";
               $query = $conexion->prepare($sql);
               $query->bind_param('ss', $id, $codCatastral);
               $query->execute();
               $sql = "INSERT INTO tributos (identificacion, tipoEntidad, codEntidad) VALUES (?, 'TA', ?)";
               $query = $conexion->prepare($sql);
               $query->bind_param('ss', $id, $codCatastral);
               $query->execute();
               header("Location: ibi.php?id=" . urlencode($id) . "&mensaje=ibi_registrado");
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
