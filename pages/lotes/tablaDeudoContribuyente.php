<?php include '../../templates/header_menu.php'; ?>
<?php 
    include "../../clases/conexion.php";  
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Consulta para obtener los contribuyentes de usuarios
    $sql = "SELECT * FROM usuarios WHERE rol = 'contribuyente'";
    $resultado = mysqli_query($conn, $sql);
    $contribuyentes = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $contribuyentes[] = $row;
        }
    }
    $conn->close();
?>

<div class="container mt-5 fondoEspecial">
    <div class="row justify-content-center">
        <div class="col-md-12 shadow-lg pb-3 mb-4 bg-body rounded">
            <h4>SELECCIONAR CONTRIBUYENTE PARA REGISTRO DE DEUDOS</h4>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 shadow-lg pb-3 mb-4 bg-white rounded">
                        <table id='tablax' class="mt-2 mb-0 table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th>Identificacion</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Celular</th>
                                    <th>Direccion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($contribuyentes as $contribuyente): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($contribuyente['identificacion']); ?></td>
                                    <td><?php echo htmlspecialchars($contribuyente['nombre1']); ?></td>
                                    <td><?php echo htmlspecialchars($contribuyente['apellido1']); ?></td>
                                    <td><?php echo htmlspecialchars($contribuyente['celular']); ?></td>
                                    <td><?php echo htmlspecialchars($contribuyente['direccion']); ?></td>
                                    <td>
                                        <a href="loteDeudo.php?id=<?php echo urlencode($contribuyente['identificacion']); ?>" class="btn btn-outline-success bi bi-check"> Seleccionar</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> <!--- shadow -->
                </div> <!--- row -->
            </div> <!--- container-->
        </div>
    </div>
</div>
