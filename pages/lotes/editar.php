<?php
include "../../clases/conexion.php";

// Verificar si se recibieron datos del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codLote = $_POST['codLote_editar'];
    $cementerio = $_POST['cementerio_editar'];
    $sector = $_POST['sector_editar'];
    $categoria = $_POST['categoria_editar'];
    $fechaRegistro = $_POST['fechaRegistro_editar'];
    $medidas = $_POST['medidas_editar'];
    $linderoNorte = $_POST['linderoNorte_editar'];
    $linderoSur = $_POST['linderoSur_editar'];
    $linderoEste = $_POST['linderoEste_editar'];
    $linderoOeste = $_POST['linderoOeste_editar'];
    
    // Realizar la actualización en la base de datos
    $conexion = new Conexion();
    $conn = $conexion->conectar();
    $sql = "UPDATE lotes SET codLote=?, cementerio=?, sector=?, categoria=?, fecRegistro=?, medidas=?, lindeNorte=?, lindeSur=?, lindeEste=?, lindeOeste=?  WHERE codLote=?";
    //Sentencia Preparada (prepared statement)
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sssssssssss", $codLote, $cementerio, $sector, $categoria, $fechaRegistro, $medidas, $linderoNorte, $linderoSur, $linderoEste, $linderoOeste, $codLote);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("location: lotes.php?editado=true");
    } else {
        echo "Error al actualizar el lote: " . $stmt->error;
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
}
?>