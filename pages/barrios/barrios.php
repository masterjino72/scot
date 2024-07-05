<?php include '../../templates/header_menu.php';  ?>
<?php 
    include "../../clases/conexion.php";  
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Consulta para obtener los barrios
    $sql = "SELECT * FROM barrios";
    $resultado = mysqli_query($conn, $sql);
    $barrios = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $barrios[] = $row;
        }
    }

    // Consulta para obtener los distritos
    $sqlDistritos = "SELECT * FROM distritos"; 
    $resultadoDistritos = mysqli_query($conn, $sqlDistritos);
    $distritos = [];
    if ($resultadoDistritos) {
        while ($row = mysqli_fetch_assoc($resultadoDistritos)) {
            $distritos[] = $row;
        }
    }

    $conn->close();
    
?>



<div class="container mt-5 fondoEspecial">
    <div class="row justify-content-center">
            <div class="col-md-12 shadow-lg pb-3 mb-4 bg-body rounded">
                <h4>Datos de Barrios</h4>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-11 shadow-lg pb-3 mb-4 bg-white rounded">
                            <!--Formulario para nuevos barrios -->
                            <form action="registrar.php" method="POST">
                                <?php
                                // Mostrar mensajes de error
                                if (isset($_GET['mensaje'])) {
                                    if ($_GET['mensaje'] == 'codBarrio_existente') {
                                        echo '<p id="Message" class="text-danger fw-bold">CODIGO DE BARRIO EN USO.</p>';
                                    } elseif ($_GET['mensaje'] == 'barrioDistrito_existente') {
                                        echo '<p id="Message" class="text-danger fw-bold">NOMBRE DE BARRIO EN DISTRITO YA REGISTRADO.</p>';
                                    } elseif ($_GET['mensaje'] == 'barrio_registrado') {
                                        echo '<p id="Message" class="text-danger fw-bold">¡¡BARRIO REGISTRADO EXITOSAMENTE!!</p>';
                                    } elseif ($_GET['mensaje'] == 'barrio_noregistrado') {
                                        echo '<p id="Message" class="text-danger fw-bold">BARRIO NO FUE REGISTRADO</p>';
                                    } 
                                }
                                ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th class="w-25">Barrio</th>
                                            <th>Tipo</th>
                                            <th>Distrito</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-md-1"><input id="codBarrio" name="codBarrio" type="text" class="form-control" placeholder="Código del Barrio" oninput="this.value = this.value.toUpperCase()" required></td>
                                            <td class="col-md-2"><input id="nomBarrio" name="nomBarrio" type="text" class="form-control" placeholder="Nombre del Barrio" oninput="this.value = this.value.toUpperCase()" required></td>
                                            <td class="col-md-1">
                                                <select id="tipoBarrio" name="tipoBarrio" class="form-control">
                                                    <option value="BARRIO">BARRIO</option>
                                                    <option value="COMUNIDAD">COMUNIDAD</option>
                                                </select>
                                            </td>
                                            <td class="col-md-1">
                                                <select id="nomDistrito" name="nomDistrito" class="form-control">
                                                    <?php foreach ($distritos as $distrito): ?>  
                                                        <option value="<?php echo htmlspecialchars($distrito['distrito']); ?>"><?php echo htmlspecialchars($distrito['distrito']); ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="w-100 btn btn-guardar btn-lg"> <i class="bi bi-save"></i> Registrar Barrio </button>
                            </form>
                        </div> <!--- shadow -->
                    </div> <!--- row interno -->
                </div> <!--- container interno-->

                <!--Tabla para mostrar registros de barrios -->
           
                 <table id="tablax" class="mt-2 mb-0 table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Codigo</th>
                                <th>Barrio</th>
                                <th>Tipo</th>
                                <th>Distrito</th>
                                <th class="w-25">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php foreach ($barrios as $barrio): ?>  
                            <tr>
                                <td><?php echo htmlspecialchars($barrio['idBarrio']); ?></td>
                                <td><?php echo htmlspecialchars($barrio['codBarrio']); ?></td>
                                <td><?php echo htmlspecialchars($barrio['barrio']); ?></td>
                                <td><?php echo htmlspecialchars($barrio['tipoBarrio']); ?></td>
                                <td><?php echo htmlspecialchars($barrio['distrito']); ?></td>
                                <td>
                                    <button type="button" class="btnEditar btn btn-outline-success bi bi-pencil" data-bs-toggle="modal" data-bs-target="#modalBarrios"> Editar</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        
                        </tbody>
                </table>


            </div> <!-- col main -->
    </div> <!-- row main -->
</div> <!-- container main -->

<!-- modal para editar barrios -->
<div id="modalBarrios" class="modal fade" tabindex="-1" aria-labelledby="modalBarrio" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ejemplo"> Editar Barrio</h5>
            </div>
            <div class="modal-body">
                <form action="editar.php" method="POST" id="formEditarBarrio">
                    <input name="id_editar" id="id_editar" type="text" hidden>
                    <label for="codBarrio_editar">Código</label>
                    <input id="codBarrio_editar" name="codBarrio_editar" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()">
                    <label for="nomBarrio_editar">Barrio</label>
                    <input id="nomBarrio_editar" name="nomBarrio_editar" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()">
                    <label for="tipoBarrio_editar">Tipo</label>
                    <select id="tipoBarrio_editar" name="tipoBarrio_editar" class="form-control">
                        <option value="BARRIO">BARRIO</option>
                        <option value="COMUNIDAD">COMUNIDAD</option>
                    </select>
                    <label for="nomDistrito_editar">Distrito</label>
                    <select id="nomDistrito_editar" name="nomDistrito_editar" class="form-control">
                        <?php foreach ($distritos as $distrito): ?>  
                            <option value="<?php echo htmlspecialchars($distrito['distrito']); ?>"><?php echo htmlspecialchars($distrito['distrito']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-outline-success bi bi-pencil" id="btnActualizar"> Actualizar</button>
                    </div>
                </form>
            </div> <!--- modal-body-->
        </div> <!--- modal-content-->
    </div> <!--- modal-dialog-->
</div> <!--- modal -->

<script>
    document.querySelectorAll('.btnEditar').forEach(function(btnEditar) {
        btnEditar.addEventListener('click', function() {
            var fila = btnEditar.closest('tr'); // Obtener la fila actual
            var id = fila.querySelector('td:nth-child(1)').innerText; // Obtener el id de la primera columna
            var codBarrio = fila.querySelector('td:nth-child(2)').innerText; // Obtener el código de la segunda columna
            var nomBarrio = fila.querySelector('td:nth-child(3)').innerText; // Obtener el nombre del barrio de la tercera columna
            var tipoBarrio = fila.querySelector('td:nth-child(4)').innerText; // Obtener el tipo de barrio de la cuarta columna
            var nomDistrito = fila.querySelector('td:nth-child(5)').innerText; // Obtener el distrito de la quinta columna

            document.getElementById('id_editar').value = id; // Establecer el valor en el campo de edición
            document.getElementById('codBarrio_editar').value = codBarrio; // Establecer el valor en el campo de edición
            document.getElementById('nomBarrio_editar').value = nomBarrio; // Establecer el valor en el campo de edición

            var tipoBarrioSelect = document.getElementById('tipoBarrio_editar');
            for (var i = 0; i < tipoBarrioSelect.options.length; i++) {
                if (tipoBarrioSelect.options[i].value === tipoBarrio) {
                    tipoBarrioSelect.selectedIndex = i;
                    break;
                }
            }

            document.getElementById('nomDistrito_editar').value = nomDistrito; // Establecer el valor en el campo de edición
        });
    });

    document.getElementById('btnEditar').addEventListener('click', function() {
        var id = document.getElementById('id_editar').value;
        window.location.href = '/barrios/editar/' + encodeURIComponent(id);
    });
</script>




