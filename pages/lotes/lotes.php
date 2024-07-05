<?php include '../../templates/header_menu.php';  ?>
<?php 
    include "../../clases/conexion.php";  
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Consulta para obtener los lotes
    $sql = "SELECT * FROM lotes";
    $resultado = mysqli_query($conn, $sql);
    $lotes = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $lotes[] = $row;
        }
    }

    // Consulta para obtener los cementerios
    $sqlCementerios = "SELECT * FROM cementerios"; 
    $resultadoCementerios = mysqli_query($conn, $sqlCementerios);
    $cementerios = [];
    if ($resultadoCementerios) {
        while ($row = mysqli_fetch_assoc($resultadoCementerios)) {
            $cementerios[] = $row;
        }
    }

    // Consulta para obtener los sectores
    $sqlSectores = "SELECT * FROM sectores"; 
    $resultadoSectores = mysqli_query($conn, $sqlSectores);
    $sectores = [];
    if ($resultadoSectores) {
        while ($row = mysqli_fetch_assoc($resultadoSectores)) {
            $sectores[] = $row;
        }
    }

    // Consulta para obtener los categorias
    $sqlCategorias = "SELECT * FROM categorias"; 
    $resultadoCategorias = mysqli_query($conn, $sqlCategorias);
    $categorias = [];
    if ($resultadoCategorias) {
        while ($row = mysqli_fetch_assoc($resultadoCategorias)) {
            $categorias[] = $row;
        }
    }

    $conn->close();
    
?>

<div class="container mt-5 fondoEspecial">
    <div class="row justify-content-center">
            <div class="col-md-12 shadow-lg pb-3 mb-4 bg-body rounded">
                <h4>Datos de Lotes</h4>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-11 shadow-lg pb-3 mb-4 bg-white rounded">
                            <!--Formulario para nuevos lotes -->
                            <form action="registrar.php" method="POST">
                                <?php
                                    // Mostrar mensajes de error
                                    if (isset($_GET['mensaje'])) {
                                        if ($_GET['mensaje'] == 'codLote_existente') {
                                            echo '<p id="Message" class="text-danger fw-bold">CODIGO DE LOTE EN USO.</p>';
                                        } elseif ($_GET['mensaje'] == 'lote_registrado') {
                                            echo '<p id="Message" class="text-danger fw-bold">¡¡LOTE REGISTRADO EXITOSAMENTE!!</p>';
                                        } elseif ($_GET['mensaje'] == 'lote_noregistrado') {
                                            echo '<p id="Message" class="text-danger fw-bold">LOTE NO FUE REGISTRADO</p>';
                                        } 
                                    }
                                ?>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="col-md-3">Código de Lote</th>
                                            <th class="col-md-2">Cementerio</th>
                                            <th class="col-md-2">Sector</th>
                                            <th class="col-md-2">Categoria</th>
                                            
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"><input id="codLote" name="codLote" type="text" class="form-control" placeholder="Código de Lote" required></td>
                                            <td class="col-md-2">
                                            <select id="cementerio" name="cementerio" class="form-control">
                                                <option value="" hidden>Cementerio</option>
                                                <?php foreach ($cementerios as $cementerio): ?>
                                                    <option value="<?php echo htmlspecialchars($cementerio['cementerio']); ?>">
                                                        <?php echo htmlspecialchars($cementerio['cementerio']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>

                                            </td>
                                            <td class="col-md-2">
                                                <select id="sector" name="sector" class="form-control">
                                                <option value="" hidden>Sector</option>
                                                    <?php foreach ($sectores as $sector): ?>      
                                                        <option value="<?php echo htmlspecialchars($sector['sector']); ?>"><?php echo htmlspecialchars($sector['sector']); ?></option>        
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td class="col-md-2">
                                            <select id="categoria" name="categoria" class="form-control">
                                            <option value="" hidden>Categoría</option>
                                                <?php foreach ($categorias as $categoria): ?>      
                                                    <option value="<?php echo htmlspecialchars($categoria['categoria']); ?>"><?php echo htmlspecialchars($categoria['categoria']); ?></option>        
                                                <?php endforeach; ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <th class="col-md-1">Fecha Registro</th>
                                            <th class="col-md-2">Medidas</th>
                                        </tr>
                                        <tr>
                                            <td class="col-md-1"><input id="fechaRegistro" name="fechaRegistro" type="date" class="form-control" placeholder="Fecha Registro"></td>
                                            <td class="col-md-2"><input id="medidas" name="medidas" type="text" class="form-control" placeholder="Medidas"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <th class="col-md-2">Lindero Norte</th>
                                            <th class="col-md-2">Lindero Sur</th>
                                            <th class="col-md-2">Lindero Este</th>
                                            <th class="col-md-2">Lindero Oeste</th>
                                        </tr>
                                        <tr>
                                            <td class="col-md-2"><input id="linderoNorte" name="linderoNorte" type="text" class="form-control" placeholder="Lindero Norte"></td>
                                            <td class="col-md-2"><input id="linderoSur" name="linderoSur" type="text" class="form-control" placeholder="Lindero Sur"></td>
                                            <td class="col-md-2"><input id="linderoEste" name="linderoEste" type="text" class="form-control" placeholder="Lindero Este"></td>
                                            <td class="col-md-2"><input id="linderoOeste" name="linderoOeste" type="text" class="form-control" placeholder="Lindero Oeste"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="w-100 btn btn-guardar btn-lg"> <i class="bi bi-save"></i> Registrar Lote </button>
                            </form>
                        </div> <!--- shadow -->
                    </div> <!--- row interno -->
                </div> <!--- container interno-->
                <small class="text-danger text-center font-weight-bold" id="errorFecha" style="display: none;">¡¡¡LA FECHA NO PUEDE SER MAYOR QUE LA FECHA ACTUAL!!!</small>

                <!--Tabla para mostrar registros de lotes -->
                <table id="tablax" class="mt-2 mb-0 table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>CodLote</th>
                                <th>Cementerio</th>
                                <th>Sector</th>
                                <th>Categoria</th>
                                <th>Fecha Registro</th>
                                <th style="display: none;">Medidas</th>
                                <th style="display: none;">Lindero Norte</th>
                                <th style="display: none;">Lindero Sur</th>
                                <th style="display: none;">Lindero Este</th>
                                <th style="display: none;">Lindero Oeste</th>
                                <th class="w-25">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        <?php foreach ($lotes as $lote): ?>  
                            <tr>
                                <td><?php echo htmlspecialchars($lote['codLote']); ?></td>
                                <td><?php echo htmlspecialchars($lote['cementerio']); ?></td>
                                <td><?php echo htmlspecialchars($lote['sector']); ?></td>
                                <td><?php echo htmlspecialchars($lote['categoria']); ?></td>
                                <td><?php echo htmlspecialchars($lote['fecRegistro']); ?></td>
                                <td style="display: none;"><?php echo htmlspecialchars($lote['medidas']); ?></td>
                                <td style="display: none;"><?php echo htmlspecialchars($lote['lindeNorte']); ?></td>
                                <td style="display: none;"><?php echo htmlspecialchars($lote['lindeSur']); ?></td>
                                <td style="display: none;"><?php echo htmlspecialchars($lote['lindeEste']); ?></td>
                                <td style="display: none;"><?php echo htmlspecialchars($lote['lindeOeste']); ?></td>
                                <td>
                                    <button type="button" class="btnEditar btn btn-outline-success bi bi-pencil" data-bs-toggle="modal" data-bs-target="#modalLotes"> Editar</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                </table>
            </div> <!-- col main -->
    </div> <!-- row main -->
</div> <!-- container main -->

<!-- modal para editar lotes -->
<div id="modalLotes" class="modal fade" tabindex="-1" aria-labelledby="modalLote" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalTitle">Editar Lote</h5>
            </div>
            <div class="modal-body">
                <form action="editar.php" method="POST" id="formEditarLote">
                    <table id="tablax" class="mt-2 mb-0 table table-dark table-striped">
                        <thead>
                            <tr>
                                <th style="display: none;">CodLote</th>
                                <th>Cementerio</th>
                                <th>Sector</th>
                                <th>Categoria</th>
                                <th>Fecha Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="display: none;"><input name="codLote_editar" id="codLote_editar" type="text"></td>
                                <td class="col-md-2">
                                    <select id="cementerio_editar" name="cementerio_editar" class="form-control">
                                        <?php foreach ($cementerios as $cementerio): ?>      
                                            <option value="<?php echo htmlspecialchars($cementerio['cementerio']); ?>"><?php echo htmlspecialchars($cementerio['cementerio']); ?></option>
                                        <?php endforeach; ?>   
                                    </select>
                                </td>
                                <td class="col-md-2">
                                    <select id="sector_editar" name="sector_editar" class="form-control">
                                        <?php foreach ($sectores as $sector): ?>      
                                            <option value="<?php echo htmlspecialchars($sector['sector']); ?>"><?php echo htmlspecialchars($sector['sector']); ?></option>
                                        <?php endforeach; ?>   
                                    </select>
                                </td>
                                <td class="col-md-2">
                                    <select id="categoria_editar" name="categoria_editar" class="form-control">
                                        <?php foreach ($categorias as $categoria): ?>      
                                            <option value="<?php echo htmlspecialchars($categoria['categoria']); ?>"><?php echo htmlspecialchars($categoria['categoria']); ?></option>
                                        <?php endforeach; ?>        
                                    </select>
                                </td>
                                <td><input id="fechaRegistro_editar" name="fechaRegistro_editar" type="date" class="form-control"></td>
                            </tr>
                        </tbody>
                    </table>

                    <table id="tablax" class="mt-2 mb-0 table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Medidas</th>
                                <th>Lindero Norte</th>
                                <th>Lindero Sur</th>
                                <th>Lindero Este</th>
                                <th>Lindero Oeste</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input id="medidas_editar" name="medidas_editar" type="text" class="form-control"></td>
                                <td><input id="linderoNorte_editar" name="linderoNorte_editar" type="text" class="form-control"></td>
                                <td><input id="linderoSur_editar" name="linderoSur_editar" type="text" class="form-control"></td>
                                <td><input id="linderoEste_editar" name="linderoEste_editar" type="text" class="form-control"></td>
                                <td><input id="linderoOeste_editar" name="linderoOeste_editar" type="text" class="form-control"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-outline-primary bi bi-pencil" id="btnActualizar">Actualizar</button>
                    </div>
                    <small class="text-danger text-center font-weight-bold" id="errorFechaRegistro" style="display: none;">¡¡¡LA FECHA NO PUEDE SER MAYOR QUE LA FECHA ACTUAL!!!</small>
                </form>
            </div> <!--- modal-body-->
        </div> <!--- modal-content-->
    </div> <!--- modal-dialog-->
</div> <!--- modal -->


<script>
    document.getElementById('fecRegistro').addEventListener('change', function(event) {
            var fechaInput = event.target.value;
            var fechaActual = new Date().toISOString().split('T')[0];

            if (fechaInput > fechaActual) {
                document.getElementById('errorFecha').style.display = 'block';
                document.getElementById('fecRegistro').value = fechaActual -1;
            } else {
                document.getElementById('errorFecha').style.display = 'none';
            }
        });
</script>


<script>
    document.getElementById('fechaRegistro_editar').addEventListener('change', function(event) {
            var fechaInput = event.target.value;
            var fechaActual = new Date().toISOString().split('T')[0];

            if (fechaInput > fechaActual) {
                document.getElementById('errorFechaRegistro').style.display = 'block';
                document.getElementById('fechaRegistro_editar').value = fechaActual -1;
            } else {
                document.getElementById('errorFecha').style.display = 'none';
            }
        });
</script>


<script>
    document.querySelectorAll('.btnEditar').forEach(function(btnEditar) {
        btnEditar.addEventListener('click', function() {
            var fila = btnEditar.closest('tr'); // Obtener la fila actual
            var codLote = fila.querySelector('td:nth-child(1)').innerText; // Obtener el dato de la segunda columna
            var cementerio = fila.querySelector('td:nth-child(2)').innerText; // Obtener el dato de la tercera columna
            var sector = fila.querySelector('td:nth-child(3)').innerText; // Obtener el dato de la cuarta columna
            var categoria = fila.querySelector('td:nth-child(4)').innerText; // Obtener el dato de la quinta columna
            var fechaRegistro = fila.querySelector('td:nth-child(5)').innerText; // Obtener el dato de la sexta columna
            var medidas = fila.querySelector('td:nth-child(6)').innerText; // Obtener el dato de la septima columna
            var linderoNorte = fila.querySelector('td:nth-child(7)').innerText; // Obtener el dato de la octava columna
            var linderoSur = fila.querySelector('td:nth-child(8)').innerText; // Obtener el dato de la novena columna
            var linderoEste = fila.querySelector('td:nth-child(9)').innerText; // Obtener el dato de la octava columna
            var linderoOeste = fila.querySelector('td:nth-child(10)').innerText; // Obtener el dato de la novena columna
            document.getElementById('codLote_editar').value = codLote; // Establecer el valor en el campo de edición
            document.getElementById('cementerio_editar').value = cementerio; // Establecer el valor en el campo de edición
            document.getElementById('sector_editar').value = sector; // Establecer el valor en el campo de edición
            document.getElementById('categoria_editar').value = categoria; // Establecer el valor en el campo de edición
            document.getElementById('fechaRegistro_editar').value = fechaRegistro; // Establecer el valor en el campo de edición
            document.getElementById('medidas_editar').value = medidas; // Establecer el valor en el campo de edición
            document.getElementById('linderoNorte_editar').value = linderoNorte; // Establecer el valor en el campo de edición
            document.getElementById('linderoSur_editar').value = linderoSur; // Establecer el valor en el campo de edición
            document.getElementById('linderoEste_editar').value = linderoEste; // Establecer el valor en el campo de edición
            document.getElementById('linderoOeste_editar').value = linderoOeste; // Establecer el valor en el campo de edición
            
        }); 
    });

    document.getElementById('btnEditar').addEventListener('click', function() {
    var id = document.getElementById('id_editar').value;
    window.location.href = '/lotes/editar/' + encodeURIComponent(id);   
    });
</script>

<script>
    // Función para manejar la apertura del modal y actualizar el título
    document.querySelectorAll('.btnEditar').forEach(function(btnEditar) {
        btnEditar.addEventListener('click', function() {
            var fila = btnEditar.closest('tr'); // Obtener la fila actual
            var codLote = fila.querySelector('td:nth-child(1)').innerText.trim(); // Obtener el dato de la primera columna (CodLote)
            var modalTitle = document.getElementById('modalTitle');
            modalTitle.textContent = 'Editar Lote ' + codLote;
            document.getElementById('codLote_editar').value = codLote;
        });
    });
</script>
