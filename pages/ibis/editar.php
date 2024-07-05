<?php
include "../../clases/conexion.php";

// Verificar si se recibieron datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['identificacion'];
    $codCatastral = $_POST['codCatastral_editar'];
    $ubicacion = $_POST['ubicacion_editar'];
    $construccion = $_POST['construccion_editar'];
    $tipoIBI = $_POST['tipoIBI_editar'];
    $usoIBI = $_POST['usoIBI_editar'];
    $valorCatastral = $_POST['valorCatastral_editar'];
    $finca = $_POST['finca_editar'];
    $folio = $_POST['folio_editar'];
    $tomo = $_POST['tomo_editar'];
    $asiento = $_POST['asiento_editar'];
    $tAseo = $_POST['tAseo_editar'];
    $barrido = $_POST['barrido_editar'];
    $estadoIBI = "ACTIVO";
    
    // Realizar la actualización en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->conectar();
    $sql = "UPDATE ibi SET ubicacion=?, construccion=?, tipoIBI=?, uso=?, valorCatastral=?, finca=?, folio=?, tomo=?, asiento=?, TA=?, barrido=?, estadoIBI=? WHERE codCatastral=?";
    //Sentencia Preparada (prepared statement)
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sssssssssssss", $ubicacion, $construccion, $tipoIBI, $usoIBI, $valorCatastral, $finca, $folio, $tomo, $asiento, $tAseo, $barrido, $estadoIBI, $codCatastral);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: ibi.php?id=" . urlencode($id));
    } else {
        echo "Error al actualizar el IBI: " . $stmt->error;
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
}
?>