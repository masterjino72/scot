<?php include '../../templates/header_menu.php';  ?>
<?php 
    include "../../clases/conexion.php";  
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Consulta para obtener los parametros
    $sql = "SELECT * FROM parametros";
    $resultado = mysqli_query($conn, $sql);
    $parametros = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $parametros[] = $row;
        }
    }

    $conn->close();
?>

<div class="container mt-5 fondoEspecial">
    <div class="row justify-content-center">
            <div class="col-md-12 shadow-lg pb-3 mb-4 bg-body rounded">
                <h4>Datos de Parametrizacion de Impuestos</h4>
                <!--Tabla para mostrar registros de usuarios -->
                <table class="mt-2 mb-0 table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Parametro</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Final</th>
                                <th>Porcentaje</th>
                                <th class="w-25">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($parametros as $param): ?>  
                                <tr>
                                    <td><?php echo htmlspecialchars($param['parametro']); ?></td>
                                    <td><?php echo htmlspecialchars($param['fecha1']); ?></td>
                                    <td><?php echo htmlspecialchars($param['fecha2']); ?></td>
                                    <td><?php echo htmlspecialchars($param['porcentaje']); ?></td>
                                    <td>
                                        <button type="button" class="btnEditar btn btn-outline-success bi bi-pencil" data-bs-toggle="modal" data-bs-target="#modalParametros"> Editar</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                </table>
                <h4>Datos de Parametrizacion de Cementerio</h4>
                <a href="categorias.php" class="btnEditar btn btn-outline-primary bi bi-pencil"> Categorias</a>
                <a href="sectores.php" class="btnEditar btn btn-outline-secondary bi bi-pencil"> Sectores</a>
                <a href="cementerios.php" class="btnEditar btn btn-outline-success bi bi-pencil"> Cementerios</a>
            </div> <!-- col main -->
    </div> <!-- row main -->
</div> <!-- container main -->

<!-- modal para editar parametros -->
<div id="modalParametros" class="modal fade" tabindex="-1" aria-labelledby="modalUsuario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="editarParametro.php" method="POST" id="formEditarParametro">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="ejemplo"> Editar Parametro:</h5>
                    <input id="parametro_editar" name="parametro_editar" type="text" readonly style="margin-right: 140px; width: 150px;" class="form-control bg-secondary text-white text-center">
                </div>  
                <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="fecha1_editar">Fecha Inicial</label>
                                <input id="fecha1_editar" name="fecha1_editar" type="date" class="form-control bg-secondary text-white">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="fecha2_editar">Fecha Final</label>
                                <input id="fecha2_editar" name="fecha2_editar" type="date" class="form-control bg-secondary text-white">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="porcentaje_editar"> Porcentaje (Decimal)</label>
                                <input id="porcentaje_editar" step="any" name="porcentaje_editar" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="pt-5 bg-dangerous text-center" id="mensaje"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-outline-primary bi bi-pencil" id="btnActualizar"> Actualizar</button>
                        </div>
                </div> <!--- modal-body-->
            </form>
        </div> <!--- modal-content-->
    </div> <!--- modal-dialog-->
</div> <!--- modal -->

<script>
    document.querySelectorAll('.btnEditar').forEach(function(btnEditar) {
        btnEditar.addEventListener('click', function() {
            var fila = btnEditar.closest('tr'); // Obtener la fila actual
            var parametro = fila.querySelector('td:nth-child(1)').innerText; // Obtener el dato de la primera columna
            var fecha1 = fila.querySelector('td:nth-child(2)').innerText; // Obtener el dato de la segunda columna
            var fecha2 = fila.querySelector('td:nth-child(3)').innerText; // Obtener el dato de la tercera columna
            var porcentaje = fila.querySelector('td:nth-child(4)').innerText; // Obtener el dato de la cuarta columna
            document.getElementById('parametro_editar').value = parametro; // Establecer el valor en el campo de edición
            document.getElementById('fecha1_editar').value = fecha1; // Establecer el valor en el campo de edición
            document.getElementById('fecha2_editar').value = fecha2; // Establecer el valor en el campo de edición
            document.getElementById('porcentaje_editar').value = porcentaje; // Establecer el valor en el campo de edición
        }); 
    });

    document.getElementById('fecha2_editar_nueva').addEventListener('change', function() {
        // Aquí puedes escribir el código que deseas ejecutar cuando se hace clic en el botón
        const fecha1Input = document.getElementById('fecha1_editar_nueva');
        const fecha2Input = document.getElementById('fecha2_editar_nueva');
        const fecha1 = new Date(fecha1Input.value);
        const fecha2 = new Date(fecha2Input.value);
        // Validar si fecha2 es menor que fecha1
        if (fecha2 < fecha1) {
        // Si es menor, mostrar un mensaje de error
        alert('La Fecha Final no puede ser anterior a la Fecha Inicial.');
        document.getElementById('mensaje').innerText = 'La Fecha Final no puede ser anterior a la Fecha Inicial.';
        // También podrías deshabilitar el botón de enviar el formulario si la validación falla
        document.getElementById('btnActualizar').disabled = true;
        } else {
        // Si es válida, limpiar el mensaje de error y habilitar el botón
        document.getElementById('mensaje').innerText = '';
        document.getElementById('btnActualizar').disabled = false;
        }
    });
</script>



