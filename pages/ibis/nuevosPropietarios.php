<?php include '../../templates/header_menu.php'; ?>
<?php 
    include "../../clases/conexion.php";  
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Obtener el valor de id desde el parámetro GET y escapar para evitar SQL injection
    $codCatastral = isset($_GET['codCatastral']) ? mysqli_real_escape_string($conn, $_GET['codCatastral']) : '';
    $identificacion = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
    
    // Consulta para obtener los detalles del IBI
    $sql = sprintf("SELECT * FROM ibi WHERE codCatastral = '%s'", $codCatastral);
    $resultado = mysqli_query($conn, $sql);
    $ibis = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $ibis[] = $row;
        }
    }

    // Consulta para obtener los contribuyentes que no son dueños del IBI
    $sql = sprintf("SELECT U.identificacion, U.nombre1, U.apellido1, U.celular, U.direccion, U.estado 
                    FROM usuarios U LEFT JOIN tributos T ON U.identificacion = T.identificacion 
                    AND T.tipoEntidad = 'IBI' AND T.codEntidad = '%s' 
                    WHERE U.rol = 'CONTRIBUYENTE' AND T.identificacion IS NULL", $codCatastral);
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
    <?php foreach ($ibis as $ibi): ?>    
        <div class="bg-light p-3 rounded">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">REGISTRO DE NUEVOS PROPIETARIOS PARA:</h4>
                <button type="button" class="btn btn-success" onclick="window.history.back();">
                    <i class="bi bi-arrow-left"></i> Retroceder
                </button>
            </div>
            <div class="d-flex flex-column flex-sm-row">
                <p class="me-3 mb-0"><strong>IBI:</strong> <?php echo htmlspecialchars($ibi['codCatastral']); ?></p>
                <p class="me-3 mb-0"><strong>Ubicación:</strong> <?php echo htmlspecialchars($ibi['ubicacion']); ?></p>
                <p class="me-3 mb-0"><strong>Construcción:</strong> <?php echo htmlspecialchars($ibi['construccion']); ?></p>
                <p class="mb-0"><strong>Tipo IBI:</strong> <?php echo htmlspecialchars($ibi['tipoIBI']); ?></p>
                <p class="mb-0"><strong>Identificación:</strong> <?php echo htmlspecialchars($identificacion); ?></p>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="row justify-content-center">
        <div class="container">
            <div class="p-2 col-md-12 shadow-lg pb-3 mt-4 bg-white rounded" style="margin-top: 20px;">
                <br>
                <table id='tablax' class="mt-2 mb-0 table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Identificación</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Celular</th>
                            <th>Dirección</th>  
                            <th>Estado</th>  
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
                            <td><?php echo htmlspecialchars($contribuyente['estado']); ?></td> 
                            <td>
                                <a href="sumarPropietarios.php?id1=<?php echo htmlspecialchars($identificacion); ?>&id=<?php echo htmlspecialchars($contribuyente['identificacion']); ?>&codCatastral=<?php echo htmlspecialchars($codCatastral); ?>" class="btn btn-outline-warning">
                                    <i class="bi bi-person-plus"></i> Nuevo Propietario
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
