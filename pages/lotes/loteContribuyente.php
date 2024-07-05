<?php include '../../templates/header_menu.php'; ?>
<?php 
    include "../../clases/conexion.php";  
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Obtener el valor de id desde el parámetro GET y escapar para evitar SQL injection
    $id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
    
    // Consulta para obtener los contribuyentes de usuarios   
    $sql = sprintf("SELECT * FROM usuarios WHERE rol = 'contribuyente' AND identificacion = '%s'", $id);
    $resultado = mysqli_query($conn, $sql);
    $contribuyentes = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $contribuyentes[] = $row;
        }
    }

    // Consulta para obtener los lotes
    $sqlLotes = "SELECT * FROM lotes WHERE estadoLote = 'LIBRE'"; 
    $resultadoLotes = mysqli_query($conn, $sqlLotes);
    $lotes = [];
    if ($resultadoLotes) {
        while ($row = mysqli_fetch_assoc($resultadoLotes)) {
            $lotes[] = $row;
        }
    }

    // Consulta para asignar lote al contribuyente
    $sqlTributos = sprintf("SELECT * FROM tributos WHERE tipoEntidad = 'LOTE' AND identificacion = '%s'", $id);
    $resultadoTributos = mysqli_query($conn, $sqlTributos);
    $tributos = [];
    if ($resultadoTributos) {
        while ($row = mysqli_fetch_assoc($resultadoTributos)) {
            $tributos[] = $row;
        }
    }

    $conn->close();
?>

<div class="container d-flex justify-content-center align-items-center full-height mt-2">
    <div class="col-md-8 shadow-lg bg-white rounded">
    <h4>ASIGNACIÓN DE LOTE DE CEMENTERIO A CONTRIBUYENTE</h4>
    <form action="asignarLote.php" method="POST">
        <!-- Tabla con datos del contribuyente -->
        <table class="mt-2 mb-0 table table-dark table-striped">
            <thead>
                <tr>
                    <th>Identificacion</th>
                    <th>Nombre Completo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contribuyentes as $contribuyente): ?>
                <tr>
                    <td id="ident"><?php echo htmlspecialchars($contribuyente['identificacion']); ?></td>
                    <td><?php echo htmlspecialchars($contribuyente['nombre1']); ?> <?php echo htmlspecialchars($contribuyente['apellido1']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <hr><h4 class="text-center">Seleccionar Lote a Asignar
            <button type="button" class="btnEditar btn btn-outline-success bi bi-search" data-bs-toggle="modal" data-bs-target="#modalLotes"> Buscar</button>
            <hr>
        </h4>
        <!-- Tabla de Asignación del Impuesto de Lote  -->
        <h4 class="text-center">Lote y Expediente Seleccionado</h4>
        <table class="mt-2 mb-0 table table-dark table-striped">
            <tbody>
                <tr>
                    <th>Codigo de Lote</th>
                    <th>Identificacion</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <td><input id="codLote" name="codLote" type="text" class="form-control" placeholder="Código Lote" readonly></td>
                    <td><input id="id" name="id" type="text" class="form-control" placeholder="#Identificación"></td>
                    <td><a id="enlaceLimpiar" class="btn btn-outline-danger bi bi-trash">Limpiar</a></td>
                </tr>
            </tbody>
        </table>
        <button id="btnAsignarLote" type="submit" class="w-100 btn btn-guardar btn-lg d-none"> <i class="bi bi-save"></i> Asignar Lote </button>
    </form>
    <!--Tabla para mostrar registros de Lotes -->
    <hr><h4 class="text-center">Lotes registrados al Contribuyente</h4>
    <table class="mt-2 mb-0 table table-primary table-striped">
        <thead>
            <tr>
                <th>Identificacion</th>
                <th>Código de Lote</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tributos as $tributo): ?>
            <tr>
                <td id="id"><?php echo htmlspecialchars($tributo['identificacion']); ?></td>
                <td id="cLote"><?php echo htmlspecialchars($tributo['codEntidad']); ?></td>
                <td>
                    <a href="baja.php?cLote=<?php echo urlencode($tributo['codEntidad']); ?>&id=<?php echo urlencode($tributo['identificacion']); ?>" class="btn btn-outline-danger bi bi-trash" onclick="return confirm('¿Estás seguro de que deseas dar de baja este lote?');">Baja</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div> <!--- shadow -->
</div> <!--- container -->


<!-- modal para buscar lotes -->
<div id="modalLotes" class="modal fade" tabindex="-1" aria-labelledby="modalLote" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ejemplo"> Seleccionar Lote a Asignar</h5>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            <div class="modal-body">
                <table id="tablax" class="mt-2 mb-0 table table-primary table-striped">
                    <thead  style="display:none" class="thead-dark">
                        <tr>
                            <th>Lote</th>
                            <th>Cementerio</th>
                            <th>Sector</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tr class="thead-dark">
                            <th>Lote</th>
                            <th>Cementerio</th>
                            <th>Sector</th>
                            <th>Acciones</th>
                    </tr>
                    <tbody>
                        <?php foreach ($lotes as $lote): ?>
                        <tr>
                            <td id="cLote"><?php echo htmlspecialchars($lote['codLote']); ?></td>
                            <td id="cementerio"><?php echo htmlspecialchars($lote['cementerio']); ?></td>
                            <td id="sector"><?php echo htmlspecialchars($lote['sector']); ?></td>
                            <td>
                                <button type="submit" class="btn btn-outline-success bi bi-check modificar-contrib" data-bs-dismiss="modal" onclick="asigna('<?php echo htmlspecialchars($lote['codLote']); ?>')">Seleccionar</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div> <!--- modal-body-->
        </div> <!--- modal-content-->
    </div> <!--- modal-dialog-->
</div> <!--- modal -->

<script>
    // Obtener el valor de la celda td
    var valorid = document.getElementById("ident").innerText;
    
    // Asignar el valor de la celda al input
    document.getElementById("id").value = valorid;
    document.getElementById("ide").value = valorid;
    //document.getElementById("codLote").value = valorcL;
</script>

<script>
  function handleBaja(codLote, noExpCem) {
    var ide = document.getElementById('ide').value;
    window.location.href = "baja.php" + codLote + "/" + "/" + ide;
  }
</script>

<script>
    // Función para asignar el valor de cLote al input codLote
    function asigna(codigoLote) {
        document.getElementById("codLote").value = codigoLote;
        document.getElementById("btnAsignarLote").classList.remove("d-none");
    }
</script>

<script>
     var valorid = document.getElementById("ident").innerText;
     
    document.getElementById("enlaceLimpiar").href = "loteContribuyente.php?id=" + valorid;
</script>








