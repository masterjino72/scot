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

    // Consulta para obtener los IBI del contribuyente
    $sqlTributo = sprintf("SELECT I.* FROM ibi I JOIN Tributos T ON I.codCatastral = T.codEntidad WHERE  T.tipoEntidad = 'IBI' AND identificacion = '%s'", $id);
    $resultado = mysqli_query($conn, $sqlTributo);
    $tributos = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $tributos[] = $row;
        }
    }

    $conn->close();
?>


<div class="container mt-2 fondoEspecial">
    <div class="row justify-content-center" >
        <h4>ASIGNACION DE IBI A CONTRIBUYENTE</h4>
        <div class="row justify-content-center">
            <div class="container">
                    <div class="col-md-12 shadow-lg pb-3 mt-2 bg-white rounded">
                            <div class="p-2">
                                <table class="mt-2 mb-2 table table-dark table-striped">
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
                            </div>
                            <!-- FORMULARIO DE REGISTRO DE IMPUESTO IBI + TA-->
                            <div class="p-2">
                                <form action="registrar.php" method="POST">
                                    <h4 class="text-center">Datos de la Propiedad a Registrar</h4>
                                    <div class="fondoVerdesito">
                                    <table>
                                        <tbody>
                                            <hr>
                                            <tr>
                                                <th class="col-md-2">Codigo Catastral</th>
                                                <th class="col-md-5">Ubicación de la Propiedad</th>
                                                <th class="col-md-2">Construcción</th>
                                                <th class="col-md-2">Tipo IBI</th>
                                                <th class="col-md-2">Uso</th>
                                            </tr>
                                            <tr>
                                                <td class="col-md-2"><input id="codCatastral" name="codCatastral" type="text" class="form-control" placeholder="Código Catastral" required></td>
                                                <td class="col-md-5"><input id="ubicacion" name="ubicacion" type="text" class="form-control" placeholder="Ubicacion de la Propiedad"></td>
                                                <td class="col-md-2"><input id="construccion" name="construccion" type="text" class="form-control" placeholder="Tipo de Construccion" required></td>
                                                <td class="col-md-2"><input id="tipoIBI" name="tipoIBI" type="text" class="form-control" placeholder="Tipo IBI" required></td>
                                                <td class="col-md-2"><input id="usoIBI" name="usoIBI" type="text" class="form-control" placeholder="Uso IBI" required></td>
                                                <td><input id="id" name="id" type="text" hidden></td> 
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th class="col-md-2">Valor Catastral</th>
                                                <th class="col-md-2">Finca</th>
                                                <th class="col-md-2">Folio</th>
                                                <th class="col-md-2">Tomo</th>
                                                <th class="col-md-2">Asiento</th>
                                                <th class="col-md-1">T. Aseo</th>
                                                <th class="col-md-1">Barrido</th>
                                            </tr>
                                            <tr>
                                                <td class="col-md-2"><input id="valorCatastral" name="valorCatastral" type="number" step="any" class="form-control" placeholder="Valor Catastral" required></td>
                                                <td class="col-md-2"><input id="finca" name="finca" type="text" class="form-control" placeholder="Finca"></td>
                                                <td class="col-md-2"><input id="folio" name="folio" type="text" class="form-control" placeholder="Folio"></td>
                                                <td class="col-md-2"><input id="tomo" name="tomo" type="text" class="form-control" placeholder="Tomo"></td>
                                                <td class="col-md-2"><input id="asiento" name="asiento" type="text" class="form-control" placeholder="Asiento"></td>
                                                <td class="col-md-1">
                                                    <input id="tAseo" name="tAseo" type="text" class="form-control" placeholder="Tren de Aseo" oninput="toUpperCaseAndValidate(this.id)" onblur="clearIfInvalid(this.id)" maxlength="1">
                                                    <span id="tAseoError" style="color: red;"></span>
                                                </td>
                                                <td class="col-md-1">
                                                    <input id="barrido" name="barrido" type="text" class="form-control" placeholder="Barrido" oninput="toUpperCaseAndValidate(this.id)" onblur="clearIfInvalid(this.id)" maxlength="1">
                                                    <span id="barridoError" style="color: red;"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <button type="submit" class="w-100 btn btn-guardar btn-lg"> <i class="bi bi-save"></i> Registrar Bien Inmueble </button>
                                </form>
                            </div>
                        </div>
                    </div> <!--- shadow -->
            </div> <!-- container -->
        </div> <!--- row interno -->
    </div> <!--- container interno-->

    <!--Tabla para mostrar registros de IBIS -->
    <table id="tabla" class="mt-2 mb-0 table table-dark table-striped">
        <thead>
            <tr>
                <th colspan="18" class="text-white bg-success text-center">BIENES INMUEBLES REGISTRADOS AL CONTRIBUYENTE</th>
            </tr>
            <tr>
                <th style="display:none">cod IBI</th>
                <th class="col-1">C.Catastral</th>
                <th class="col-3">Ubicacion</th>
                <th style="display:none">Finca</th>
                <th style="display:none">Tomo</th>
                <th style="display:none">Folio</th  >
                <th style="display:none">Asiento</th>

                <th style="display:none">Uso</th>
                <th style="display:none">TAseo</th>
                <th style="display:none">Barrido</th>

                <th>V.Catastral</th>
                <th>Construcción</th>
                <th class="col-1">Tipo IBI</th>
                <th class="col-1">Estado</th>
                <th class="col-2">Acciones</th>
                <th class="col-2">Propietarios</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tributos as $tributo): ?>
            <tr>
                <td style="display:none"><?php echo htmlspecialchars($tributo['codIBI']); ?></td> 
                <td class="col-1"><?php echo htmlspecialchars($tributo['codCatastral']); ?></td> 
                <td class="col-3"><?php echo htmlspecialchars($tributo['ubicacion']); ?></td> 
                <td style="display:none"><?php echo htmlspecialchars($tributo['finca']); ?></td> 
                <td style="display:none"><?php echo htmlspecialchars($tributo['folio']); ?></td> 
                <td style="display:none"><?php echo htmlspecialchars($tributo['tomo']); ?></td> 
                <td style="display:none"><?php echo htmlspecialchars($tributo['asiento']); ?></td> 

                <td style="display:none"><?php echo htmlspecialchars($tributo['uso']); ?></td> 
                <td style="display:none"><?php echo htmlspecialchars($tributo['TA']); ?></td> 
                <td style="display:none"><?php echo htmlspecialchars($tributo['barrido']); ?></td> 

                <td><?php echo htmlspecialchars($tributo['valorCatastral']); ?></td> 
                <td><?php echo htmlspecialchars($tributo['construccion']); ?></td> 
                <td class="col-1"><?php echo htmlspecialchars($tributo['tipoIBI']); ?></td> 
                <td class="col-1"><?php echo htmlspecialchars($tributo['estadoIBI']); ?></td> 
                <td class="col-2">
                    <button type="button" class="btnEditar btn btn-outline-primary bi bi-pencil" data-bs-toggle="modal" data-bs-target="#modalIBIs"> Editar</button>
                </td>
                <td class="col-2">
                    <a href="nuevosPropietarios.php?codCatastral=<?php echo urlencode($tributo['codCatastral']); ?>&id=<?php echo urlencode($contribuyente['identificacion']); ?>" class="btn btn-outline-warning bi bi-person-plus"> +News</a>
                    <a href="losPropietarios.php?codCatastral=<?php echo urlencode($tributo['codCatastral']); ?>" class="btn btn-outline-success bi bi-bank2"> +Lista</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>


<!-- modal para editar IBIS -->
<div id="modalIBIs" class="modal fade" tabindex="-1" aria-labelledby="modalIBI" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 80%; width: 80%;">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ejemplo"> Editar IBI</h5>
            </div>
            <div class="modal-body">
                <form action="editar.php" method="POST" id="formEditarIBI">
                    <input type="hidden" name="identificacion" value="<?php echo htmlspecialchars($contribuyente['identificacion']); ?>">
                    <table>
                        <thead>
                            <tr>
                                <th class="col-md-2">C. Catastral</th>
                                <th class="col-md-4">Ubicación</th>
                                <th class="col-md-2">Construcción</th>
                                <th class="col-md-2">Tipo IBI</th>
                                <th class="col-md-2">Uso IBI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="display:none"><input id="codIBI_editar" name="codIBI_editar" type="text" class="form-control"></td>
                                <td class="col-md-2"><input id="codCatastral_editar" name="codCatastral_editar" type="text" class="form-control"></td>
                                <td class="col-md-4"><input id="ubicacion_editar" name="ubicacion_editar" type="text" class="form-control"></td>
                                <td class="col-md-2"><input id="construccion_editar" name="construccion_editar" type="text" class="form-control"></td>
                                <td class="col-md-2"><input id="tipoIBI_editar" name="tipoIBI_editar" type="text" class="form-control"></td>
                                <td class="col-md-2"><input id="usoIBI_editar" name="usoIBI_editar" type="text" class="form-control"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <tr>
                                <th class="col-md-2">Valor Catastral</th>    
                                <th class="col-md-2">Finca</th>
                                <th class="col-md-2">Folio</th>
                                <th class="col-md-2">Tomo</th>
                                <th class="col-md-2">Asiento</th>
                                <th class="col-md-1">T.Aseo</th>
                                <th class="col-md-1">Barrido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input id="valorCatastral_editar" name="valorCatastral_editar" type="number" step="any" class="form-control"></td>
                                <td><input id="finca_editar" name="finca_editar" type="text" class="form-control"></td>
                                <td><input id="folio_editar" name="folio_editar" type="text" class="form-control"></td>
                                <td><input id="tomo_editar" name="tomo_editar" type="text" class="form-control"></td>
                                <td><input id="asiento_editar" name="asiento_editar" type="text" class="form-control"></td>
                                <td>
                                    <input id="tAseo_editar" name="tAseo_editar" type="text" class="form-control" placeholder="Editar Tren de Aseo" oninput="toUpperCaseAndValidate(this.id)" onblur="clearIfInvalid(this.id)" maxlength="1">
                                    <span id="tAseo_editarError" style="color: red;"></span>
                                </td>
                                <td>
                                    <input id="barrido_editar" name="barrido_editar" type="text" class="form-control" placeholder="Editar Barrido" oninput="toUpperCaseAndValidate(this.id)" onblur="clearIfInvalid(this.id)" maxlength="1">
                                    <span id="barrido_editarError" style="color: red;"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group row justify-content-end">
                        <label for="estado_editar" class="col-sm-3 col-form-label text-right font-weight-bold">Estado</label>
                        <div class="col-sm-3">
                            <input id="identificacion_editar" name="identificacion_editar" type="text" hidden>
                            <input id="estado_editar" name="estado_editar" type="text" class="form-control text-center" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-outline-primary bi bi-pencil" id="btnActualizar"> Actualizar</button>
                    </div>
                </form>
            </div> <!--- modal-body-->
        </div> <!--- modal-content-->
    </div> <!--- modal-dialog-->
</div> <!--- modal -->


<script>
    document.querySelectorAll('.nuevoPropietario').forEach(button => {
        button.addEventListener('click', function() {
            const noExpediente = this.getAttribute('data-noexp');
            const identificacion = this.getAttribute('data-ident');
            document.getElementById('selectedNoExpediente').value = noExpediente;
            document.getElementById('selectedIdentificacion').value = identificacion;
        });
    });

    document.querySelectorAll('.btnPropietarios').forEach(function(btnPropietarios) {
        btnPropietarios.addEventListener('click', function() {
            var fila = btnPropietarios.closest('tr'); // Obtener la fila actual
            var noExpIBI = fila.querySelector('td:nth-child(3)').innerText; // Obtener el dato de la tercera columna
            document.getElementById('expedienteIBI').value = noExpIBI; // Establecer el valor en el campo de edición
        });
    });

</script>

<script>
    document.querySelectorAll('.btnEditar').forEach(function(btnEditar) {
        btnEditar.addEventListener('click', function() {
            var fila = btnEditar.closest('tr'); // Obtener la fila actual
            console.log(fila);
            var codIBI = fila.querySelector('td:nth-child(1)').innerText; // Obtener el dato de la segunda columna
            var codCatastral = fila.querySelector('td:nth-child(2)').innerText; // Obtener el dato de la segunda columna
            var ubicacion = fila.querySelector('td:nth-child(3)').innerText; // Obtener el dato de la cuarta columna
            var finca = fila.querySelector('td:nth-child(4)').innerText; // Obtener el dato de la quinta columna
            var folio = fila.querySelector('td:nth-child(5)').innerText; // Obtener el dato de la septima columna
            var tomo = fila.querySelector('td:nth-child(6)').innerText; // Obtener el dato de la sexta columna
            var asiento = fila.querySelector('td:nth-child(7)').innerText; // Obtener el dato de la octava columna
            
            var usoIBI = fila.querySelector('td:nth-child(8)').innerText; // Obtener el dato de la octava columna
            var tAseo = fila.querySelector('td:nth-child(9)').innerText; // Obtener el dato de la octava columna
            var barrido = fila.querySelector('td:nth-child(10)').innerText; // Obtener el dato de la octava columna
            
            var valorCatastral = fila.querySelector('td:nth-child(11)').innerText; // Obtener el dato de la octava columna
            var construccion = fila.querySelector('td:nth-child(12)').innerText; // Obtener el dato de la septima columna
            var tipoIBI = fila.querySelector('td:nth-child(13)').innerText; // Obtener el dato de la novena columna
            var estadoIBI = fila.querySelector('td:nth-child(14)').innerText; // Obtener el dato de la novena columna
            document.getElementById('codIBI_editar').value = codIBI; // Establecer el valor en el campo de edición
            document.getElementById('codCatastral_editar').value = codCatastral; // Establecer el valor en el campo de edición
            document.getElementById('ubicacion_editar').value = ubicacion; // Establecer el valor en el campo de edición
            document.getElementById('finca_editar').value = finca; // Establecer el valor en el campo de edición
            document.getElementById('folio_editar').value = folio; // Establecer el valor en el campo de edición
            document.getElementById('tomo_editar').value = tomo; // Establecer el valor en el campo de edición
            document.getElementById('asiento_editar').value = asiento; // Establecer el valor en el campo de edición
            
            document.getElementById('usoIBI_editar').value = usoIBI; // Establecer el valor en el campo de edición
            document.getElementById('tAseo_editar').value = tAseo; // Establecer el valor en el campo de edición
            document.getElementById('barrido_editar').value = barrido; // Establecer el valor en el campo de edición
            
            document.getElementById('valorCatastral_editar').value = valorCatastral; // Establecer el valor en el campo de edición
            document.getElementById('construccion_editar').value = construccion; // Establecer el valor en el campo de edición
            document.getElementById('tipoIBI_editar').value = tipoIBI; // Establecer el valor en el campo de edición
            document.getElementById('estado_editar').value = estadoIBI; // Establecer el valor en el campo de edición
            if (estadoIBI === "ACTIVO" ){ btnReactivar.style.display = "none"; }
            else { btnReactivar.style.display = "block"; }
            var divTexto = document.getElementById("mensajeAlta");
            divTexto.textContent = "";
        }); 
    });
    // Obtener el valor de la celda td
    var valorid = document.getElementById("ident").innerText;
    // Asignar el valor de la celda al input
    document.getElementById("id").value = valorid;
</script>


<script>
function toUpperCaseAndValidate(inputId) {
    var inputValue = document.getElementById(inputId).value.toUpperCase();
    var errorSpanId = inputId + 'Error';
    var errorSpan = document.getElementById(errorSpanId);

    if (inputValue !== 'S' && inputValue !== 'N') {
        errorSpan.textContent = 'Ingrese solo S o N.';
    } else {
        errorSpan.textContent = '';
    }
}

function clearIfInvalid(inputId) {
    var inputValue = document.getElementById(inputId).value.toUpperCase();
    var errorSpanId = inputId + 'Error';
    var errorSpan = document.getElementById(errorSpanId);

    if (inputValue !== 'S' && inputValue !== 'N') {
        document.getElementById(inputId).value = '';
        errorSpan.textContent = '';
    }
}
</script>







