<?php include '../../templates/header_menu.php'; ?>
<?php 
    include "../../clases/conexion.php";  
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Obtener el valor de id desde el parámetro GET y escapar para evitar SQL injection
    $codCatastral = isset($_GET['codCatastral']) ? mysqli_real_escape_string($conn, $_GET['codCatastral']) : '';
    
    // Consulta para obtener los dueños del codCatastral
    $sql = sprintf("SELECT * FROM ibi WHERE codCatastral = '%s'", $codCatastral);
    $resultado = mysqli_query($conn, $sql);
    $ibis = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $ibis[] = $row;
        }
    }

    $sql = sprintf("SELECT * FROM tributos T JOIN usuarios U ON T.identificacion = U.identificacion WHERE T.tipoEntidad = 'IBI' AND T.codEntidad = '%s'", $codCatastral);
    $resultado = mysqli_query($conn, $sql);
    $contribuyentes = [];
    $numRows = 0;
    if ($resultado) {
        $numRows = mysqli_num_rows($resultado);  // Contar el número de filas
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
            <h4 class="mb-0">PROPIETARIOS REGISTRADOS EN:</h4>
            <button type="button" class="btn btn-success" onclick="window.history.back();">
                <i class="bi bi-arrow-left"></i> Retroceder
            </button>
        </div>
        <div class="d-flex flex-column flex-sm-row">
            <p class="me-3 mb-0"><strong>IBI:</strong> <?php echo htmlspecialchars($ibi['codCatastral']); ?></p>
            <p class="me-3 mb-0"><strong>Ubicación:</strong> <?php echo htmlspecialchars($ibi['ubicacion']); ?></p>
            <p class="me-3 mb-0"><strong>Construcción:</strong> <?php echo htmlspecialchars($ibi['construccion']); ?></p>
            <p class="mb-0"><strong>Tipo:</strong> <?php echo htmlspecialchars($ibi['tipoIBI']); ?></p>
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
                            <th>Identificacion</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Celular</th>
                            <th>Direccion</th>  
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
                                <a href="bajaPropietarios.php?id=<?php echo htmlspecialchars($contribuyente['identificacion']); ?>&codCatastral=<?php echo htmlspecialchars($codCatastral); ?>" class="btn btn-outline-danger bi bi-trash <?php echo $numRows == 1 ? 'disabled' : ''; ?>" onclick="return confirm('¿Estás seguro de que deseas dar de baja a este propietario?');"> Baja</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        fetch('/bajaPropietarios/{{expIBI}}/{{noExpediente}}/{{id}}')
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    document.getElementById('mensajeAdvertencia').style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error al obtener la respuesta del servidor:', error);
            });
    });
</script>
