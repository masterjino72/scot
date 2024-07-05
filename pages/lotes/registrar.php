<?php
     include "../../clases/Conexion.php";

     // Función para sanitizar entradas
     function sanitizarEntrada($data) {
          return htmlspecialchars(strip_tags(trim($data)));
     }

     $codLote = sanitizarEntrada($_POST['codLote']);
     $cementerio = sanitizarEntrada($_POST['cementerio']);
     $sector = sanitizarEntrada($_POST['sector']);
     $categoria = sanitizarEntrada($_POST['categoria']);
     $fechaRegistro = sanitizarEntrada($_POST['fechaRegistro']);
     $medidas = sanitizarEntrada($_POST['medidas']);
     $linderoNorte = sanitizarEntrada($_POST['linderoNorte']);
     $linderoSur = sanitizarEntrada($_POST['linderoSur']);
     $linderoEste = sanitizarEntrada($_POST['linderoEste']);
     $linderoOeste = sanitizarEntrada($_POST['linderoOeste']);
     $estado = 'LIBRE';

     try {
          $conexion = new Conexion();
          $conexion = $conexion->conectar();
          // Verificar conexión
          if ($conexion->connect_error) {
               throw new Exception("Error de conexión: " . $conexion->connect_error);
          }
          // Verificar si el codigo de lote ya existe
          $sql_codLote_existente = "SELECT COUNT(*) as count FROM lotes WHERE codLote = ?";
          $query_codLote_existente = $conexion->prepare($sql_codLote_existente);
          if (!$query_codLote_existente) { // Verificar si la preparación fue exitosa
               throw new Exception("Error en la preparación de la consulta (codLote_existente): " . $conexion->error);
          }
          $query_codLote_existente->bind_param('s', $codLote);
          $query_codLote_existente->execute();
          $resultado_codLote_existente = $query_codLote_existente->get_result()->fetch_assoc();

          if ($resultado_codLote_existente['count'] > 0) {
               // El codigo de lote ya está en uso
               header("Location: lotes.php?mensaje=codLote_existente");
               exit();
          }

          // Si todo está bien, procedemos con la inserción
          $sql = "INSERT INTO lotes (codLote, cementerio, sector, categoria, fecRegistro, medidas, lindeNorte, lindeSur, lindeEste, lindeOeste, estadoLote) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $query = $conexion->prepare($sql);
          if (!$query) { // Verificar si la preparación fue exitosa
               throw new Exception("Error en la preparación de la consulta (inserción): " . $conexion->error);
          }
          $query->bind_param('sssssssssss', $codLote, $cementerio, $sector, $categoria, $fechaRegistro, $medidas, $linderoNorte, $linderoSur, $linderoEste, $linderoOeste, $estado);
          if ($query->execute()) {
               header("Location: lotes.php?mensaje=lote_registrado");
          } else {
               throw new Exception("Error en la ejecución de la inserción: " . $query->error);
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
