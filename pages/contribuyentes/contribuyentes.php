<?php include '../../templates/header_menu.php';  ?>
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
            <h4>Datos de Contribuyentes</h4>
            <!-- Tabla para mostrar registros de usuarios -->
            <table id="tablax" class="mt-2 mb-0 table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Rol</th>
                        <th>Celular</th>
                        <th>Estado</th>
                        <th>Usuario</th>
                        <th class="w-25">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contribuyentes as $contribuyente): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($contribuyente['identificacion']); ?></td>
                        <td><?php echo htmlspecialchars($contribuyente['nombre1']); ?></td>
                        <td><?php echo htmlspecialchars($contribuyente['apellido1']); ?></td>
                        <td><?php echo htmlspecialchars($contribuyente['rol']); ?></td>
                        <td><?php echo htmlspecialchars($contribuyente['celular']); ?></td>
                        <td><?php echo htmlspecialchars($contribuyente['estado']); ?></td>
                        <td><?php echo htmlspecialchars($contribuyente['usuario']); ?></td>
                        <td>
                            <a class="btn btn-outline-success bi bi-bank2" href="tributos.php?id=<?php echo htmlspecialchars($contribuyente['identificacion']); ?>">Tributos</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> <!-- col main -->
    </div> <!-- row main -->
</div> <!-- container main -->
