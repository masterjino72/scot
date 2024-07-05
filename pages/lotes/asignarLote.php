<?php
     include "../../clases/Conexion.php";

     $codLote = $_POST['codLote'];
     $id = $_POST['id'];
     
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

     // Verificar si el codigo de lote e id ya existe
     $sql_codLote_existente = "SELECT COUNT(*) as count FROM tributos WHERE identificacion = ? AND codEntidad = ?";
     $query_codLote_existente = $conexion->prepare($sql_codLote_existente);
     $query_codLote_existente->bind_param('ss', $id, $codLote);
     $query_codLote_existente->execute();
     $resultado_codLote_existente = $query_codLote_existente->get_result()->fetch_assoc();

     if ($resultado_codLote_existente['count'] > 0) {
          // El codigo de Lote e Identificacion ya está en uso
          header("Location: loteContribuyente.php?id=" . urlencode($id) . "&mensaje=codLote_existente");
          exit();
     }

    $sqlLote = "UPDATE lotes SET estadoLote = 'OCUPADO' WHERE codLote = ?";
    $stmt = $conexion->prepare($sqlLote);
    if ($stmt === false) {
        // Redirigir a la página de loteContribuyente con un mensaje de error de preparación
        header("Location: loteContribuyente.php?id=" . urlencode($id) . "&mensaje=error_preparacion");
        exit;
    }
    $stmt->bind_param("s", $codLote);
    $stmt->execute();

     // Si todo está bien, procedemos con la inserción
     $sql = "INSERT INTO tributos (identificacion, tipoEntidad, codEntidad) VALUES (?, ?, ?)";  
     $query = $conexion->prepare($sql);
     $loteLiteral = 'LOTE';
     $query->bind_param('sss', $id, $loteLiteral, $codLote);
     if ($query->execute()) {
          header("Location: loteContribuyente.php?id=" . urlencode($id) . "&mensaje=codLote_registrado");
     } else {
          header("Location: loteContribuyente.php?id=" . urlencode($id) . "&mensaje=codLote_noregistrado");
     }

?>
