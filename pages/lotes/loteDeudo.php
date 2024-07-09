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

    // Consulta para ver lotes del contribuyente
    $sqlTributos = sprintf("SELECT T.identificacion, T.codEntidad, D.cedula, D.nomDeudo, D.fecDefuncion
        FROM tributos T
        INNER JOIN deudos D ON D.codLote = T.codEntidad
        WHERE T.tipoEntidad = 'LOTE' AND T.identificacion = '%s'", $id);
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
        <h4>REGISTRO DE DEUDOS EN LOTES DE CONTRIBUYENTE</h4>
        <form action="registrarDeudo.php" method="POST">
            <?php
            // Mostrar mensajes de error
            if (isset($_GET['mensaje'])) {
                if ($_GET['mensaje'] == 'cedula_existente') {
                    echo '<p id="Message" class="text-danger fw-bold">CEDULA YA REGISTRADA.</p>';
                } elseif ($_GET['mensaje'] == 'deudo_registrado') {
                    echo '<p id="Message" class="text-danger fw-bold">¡¡DEUDO REGISTRADO EXITOSAMENTE!!.</p>';
                } elseif ($_GET['mensaje'] == 'deudo_noregistrado') {
                    echo '<p id="Message" class="text-danger fw-bold">DEUDO NO FUE REGISTRADO</p>';
                }
            }
            ?>
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

            <!-- Tabla para mostrar registros de Lotes -->
            <hr>
            <h4 class="text-center">Lotes registrados al Contribuyente</h4>
            <table class="mt-2 mb-0 table table-primary table-striped">
                <thead>
                    <tr>
                        <th>Código de Lote</th>
                        <th>Cédula</th>
                        <th>Deudo</th>
                        <th>F. Defunción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tributos as $tributo): ?>
                        <tr>
                            <td id="cLote"><?php echo htmlspecialchars($tributo['codEntidad']); ?></td>
                            <td id="cedula"><?php echo htmlspecialchars($tributo['cedula']); ?></td>
                            <td id="nomDeudo"><?php echo htmlspecialchars($tributo['nomDeudo']); ?></td>
                            <td id="fecDefuncion"><?php echo htmlspecialchars($tributo['fecDefuncion']); ?></td>
                            <td>
                                <button type="button" class="btnEditar btn btn-outline-success bi bi-person-plus" data-bs-toggle="modal" data-bs-target="#modalDeudos" data-lote="<?php echo htmlspecialchars($tributo['codEntidad']); ?>" data-identificacion="<?php echo htmlspecialchars($tributo['identificacion']); ?>"> Agregar Deudo</button>
                                <!--<a href="baja.php?cLote=<?php echo urlencode($tributo['codEntidad']); ?>&id=<?php echo urlencode($tributo['identificacion']); ?>" class="btn btn-outline-danger bi bi-trash" onclick="return confirm('¿Estás seguro de que deseas dar de baja este lote?');">Baja</a>-->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </div> <!--- shadow -->
</div> <!--- container -->

<!-- Modal para registro de deudos -->
<div class="modal fade" id="modalDeudos" tabindex="-1" aria-labelledby="modalDeudo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos del Deudo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form style="width: 100%" id="registerForm" action="registrarDeudo.php" method="POST">
                    <input type="hidden" id="codEntidad" name="codEntidad">
                    <input type="hidden" id="identificacion" name="identificacion" value="<?php echo htmlspecialchars($id); ?>">
                    <div class="form-group row mb-3">
                        <label for="cedula" class="col-sm-2 col-form-label">Cedula:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="# Cédula" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="nombreDeudo" class="col-sm-2 col-form-label">Deudo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombreDeudo" name="nombreDeudo" placeholder="Nombre del Deudo" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="sexo" class="col-sm-2 col-form-label">Sexo:</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="sexo" name="sexo" required>
                                <option value="" selected disabled>Elija Sexo</option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                        </div>
                        <label for="fecDefuncion" class="col-sm-3 col-form-label">F. Defunción:</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="fecDefuncion" name="fecDefuncion" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="document.getElementById('registerForm').submit();">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btnEditar').forEach(button => {
        button.addEventListener('click', function() {
            var lote = this.getAttribute('data-lote');
            var identificacion = this.getAttribute('data-identificacion');
            document.querySelector('#exampleModalLabel').textContent = 'Datos del Deudo - Lote: ' + lote;
            document.getElementById('codEntidad').value = lote;
            document.getElementById('identificacion').value = identificacion;
        });
    });

    // Ocultar el mensaje después de 4 segundos
    setTimeout(function() {
        var Message = document.getElementById('Message');
        if (Message) {
            Message.style.display = 'none';
        }
    }, 4000);
</script>
