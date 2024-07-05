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

    // Consulta para obtener los fierros del contribuyente
    $sqlTributo = sprintf("SELECT F.* FROM Fierros F JOIN Tributos T ON F.codFinca = T.codEntidad WHERE  identificacion = '%s'", $id);
    $resultado = mysqli_query($conn, $sqlTributo);
    $tributos = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $tributos[] = $row;
        }
    }

    // Consulta para obtener las comunidades
    $sqlComunidad = sprintf("SELECT * FROM barrios WHERE tipoBarrio = 'COMUNIDAD'", $id);
    $resultado = mysqli_query($conn, $sqlComunidad);
    $comunidades = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $comunidades[] = $row;
        }
    }

    $conn->close();
?>
    
<div class="container d-flex justify-content-center align-items-center full-height mt-2">
    <div class="col-md-8 shadow-lg bg-white rounded"> 
    <h4>ASIGNACION DE FIERRO A CONTRIBUYENTE</h4>
    <form action="registrar.php" method="POST">
        <?php
            // Mostrar mensajes de error
            if (isset($_GET['mensaje'])) {
                if ($_GET['mensaje'] == 'codFinca_existente') {
                    echo '<p id="Message" class="text-danger fw-bold">CODIGO DE FINCA EN USO.</p>';
                } elseif ($_GET['mensaje'] == 'fierro_registrado') {
                    echo '<p id="Message" class="text-danger fw-bold">¡¡FIERRO REGISTRADO EXITOSAMENTE!!</p>';
                } elseif ($_GET['mensaje'] == 'fierro_noregistrado') {
                    echo '<p id="Message" class="text-danger fw-bold">FIERRO NO FUE REGISTRADO</p>';
                } 
            }
        ?>
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
        <!-- FORMULARIO DE REGISTRO DE FIERRO-->
        <hr><h4 class="text-center">Datos del Fierro a Registrar</h4>
        <table class="mt-2 mb-0 table table-dark table-striped">
            <tbody>
                <tr>
                    
                    <th class="col-md-3">Codigo de Finca</th>
                    <th class="col-md-6">Comunidad</th>
                    <th class="col-md-6">Fecha de Registro</th>
                </tr>
                <tr>
                    
                    <td class="col-md-1"><input id="codFinca" name="codFinca" type="text" class="form-control" placeholder="Código de Finca" required></td>
                    <td class="col-md-1">
                        <select id="comunidad" name="comunidad" class="form-control">
                            <?php foreach ($comunidades as $comunidad): ?>
                                <option value="" hidden>Comunidad</option>
                                <option value="<?php echo htmlspecialchars($comunidad['barrio']); ?>"><?php echo htmlspecialchars($comunidad['barrio']); ?></option>
                            <?php endforeach; ?>     
                        </select>
                    </td>
                    <td class="col-md-4"><input id="fecRegistro" name="fecRegistro" type="date" class="form-control" placeholder="Fecha de Registro"></td>
                    <td><input id="id" name="id" type="text" class="form-control" hidden></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="w-100 btn btn-guardar btn-lg"> <i class="bi bi-save"></i> Registrar Fierro </button>
    </form>
    <!--Tabla para mostrar Fierros registrados  -->
    <hr><h4 class="text-center">Fierros registrados al Contribuyente</h4>
    <table class="mt-2 mb-0 table table-primary table-striped">
        <thead>
            <tr>
                <th class="col-md-1">C.Finca</th>
                <th class="col-md-1">Comunidad</th>
                <th class="col-md-1">F.Registro</th>
                <th class="col-md-1">Estado</th>
                <th class="col-md-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tributos as $tributo): ?>
            <tr>
                <td id="cFinca"><?php echo htmlspecialchars($tributo['codFinca']); ?></td>
                <td id="cFinca"><?php echo htmlspecialchars($tributo['comunidad']); ?></td>
                <td id="cFinca"><?php echo htmlspecialchars($tributo['fecRegistro']); ?></td>
                <td id="cFinca"><?php echo htmlspecialchars($tributo['estadoFierro']); ?></td>
                <td class="col-md-3">
                    <a href="baja.php?codFinca=<?php echo htmlspecialchars($tributo['codFinca']); ?>&id=<?php echo htmlspecialchars($contribuyente['identificacion']); ?>" class="btn btn-outline-danger bi bi-trash" onclick="return confirm('¿Estás seguro de que deseas dar de baja este fierro?');"> Baja</a>
                    <button type="button" class="btnEditar btn btn-outline-success bi bi-pencil" data-bs-toggle="modal" data-bs-target="#modalFierros"> Editar</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div> <!-- shadow -->
</div> <!--- container -->


<!-- modal para editar Fierros -->
<div id="modalFierros" class="modal fade" tabindex="-1" aria-labelledby="modalFierro" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ejemplo"> Editar Fierro</h5>
            </div>
            <div class="modal-body">
                <form action="editar.php" method="POST" id="formEditarFierro">
                    <input type="hidden" name="identificacion" value="<?php echo htmlspecialchars($contribuyente['identificacion']); ?>">
                    <table>
                        <thead>
                            <tr>
                                <th class="col-md-2">Código Finca</th>
                                <th class="col-md-2">Comunidad</th>
                                <th class="col-md-1">Fecha Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-md-2"><input id="codFinca_editar" name="codFinca_editar" type="text" class="form-control" readonly></td>
                                <td class="col-md-2">
                                    <select id="comunidad_editar" name="comunidad_editar" class="form-control">
                                        <?php foreach ($comunidades as $comunidad): ?>
                                            <option value="" hidden>Comunidad</option>
                                            <option value="<?php echo htmlspecialchars($comunidad['barrio']); ?>"><?php echo htmlspecialchars($comunidad['barrio']); ?></option>
                                        <?php endforeach; ?>      
                                    </select>
                                </td>
                                <td class="col-md-1"><input id="fecRegistro_editar" name="fecRegistro_editar" type="date" class="form-control"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group row justify-content-end">
                        <label for="estado_editar" class="col-sm-3 col-form-label text-right font-weight-bold">Estado</label>
                        <div class="col-sm-3">
                            <input id="estado_editar" name="estado_editar" type="text" class="form-control text-center" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-outline-primary bi bi-pencil" id="btnActualizar"> Actualizar</button>
                        <button type="button" id="btnReactivar" class="btn btn-outline-success bi bi-pencil" data-bs-toggle="modal" data-bs-target="#modalAltas"> Reactivar</button>
                    </div>
                </form>
            </div> <!--- modal-body-->
        </div> <!--- modal-content-->
    </div> <!--- modal-dialog-->
</div> <!--- modal -->


<!-- modal pide clave para alta -->
<div id="modalAltas" class="modal fade" tabindex="-1" aria-labelledby="modalAlta" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ejemplo">Clave Secreta para Alta de Fierros</h5>
            </div>
            <div class="modal-body text-center">
                <input name="claveAlta" id="claveAlta" type="password" placeholder="Digite clave">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="reactivar_link" class="btn btn-outline-primary bi bi-pencil" onclick="actualizarHref()">Aceptar</button>
                </div>
                <p class="bg-danger text-center" id="mensajeAlta"></p>
            </div> <!--- modal-body-->
        </div> <!--- modal-content-->
    </div> <!--- modal-dialog-->
</div> <!--- modal -->

<script>

    // Obtener el valor de la celda td
    var valorid = document.getElementById("ident").innerText;
    
    // Asignar el valor de la celda al input
    document.getElementById("id").value = valorid;
    //document.getElementById("codLote").value = valorcL;



document.querySelectorAll('.btnEditar').forEach(function(btnEditar) {
    btnEditar.addEventListener('click', function() {
        var fila = btnEditar.closest('tr'); // Obtener la fila actual
        var codFinca = fila.querySelector('td:nth-child(1)').innerText; // Obtener el dato de la primera columna
        var comunidad = fila.querySelector('td:nth-child(2)').innerText; // Obtener el dato de la segunda columna
        var fecRegistro = fila.querySelector('td:nth-child(3)').innerText; // Obtener el dato de la tercera columna
        var estado = fila.querySelector('td:nth-child(4)').innerText; // Obtener el dato de la cuarta columna
        document.getElementById('codFinca_editar').value = codFinca; // Establecer el valor en el campo de edición
        document.getElementById('comunidad_editar').value = comunidad; // Establecer el valor en el campo de edición
        document.getElementById('fecRegistro_editar').value = fecRegistro; // Establecer el valor en el campo de edición
        document.getElementById('estado_editar').value = estado; // Establecer el valor en el campo de edición
        if (estado === "ACTIVO") { 
            document.getElementById('btnReactivar').style.display = "none"; 
        } else { 
            document.getElementById('btnReactivar').style.display = "block"; 
        }
        var divTexto = document.getElementById("mensajeAlta");
        divTexto.textContent = "";
    });
});

function actualizarHref() {
    // Obtener el valor del campo de entrada
    var claveIngresada = document.getElementById("claveAlta").value;

    if (claveIngresada === "111") {
        console.log('La clave es correcta.');
        // Redirigir a la URL deseada
        window.location.href = "alta.php?id=" + document.getElementById("id").value + "&codFinca=" + document.getElementById("codFinca_editar").value;
    } else {
        console.log('La clave es incorrecta.');
        var divTexto = document.getElementById("mensajeAlta");
        divTexto.textContent = "¡Clave equivocada!";
        setTimeout(function() {
            divTexto.textContent = ""; // Eliminar el contenido del div
            document.getElementById("claveAlta").value = ""; // Limpiar el campo de clave
        }, 5000); // 5000 milisegundos = 5 segundos
    }
}
</script>




