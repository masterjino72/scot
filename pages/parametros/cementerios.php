<?php include '../../templates/header_menu.php';  ?>
<?php 
    include "../../clases/conexion.php";  
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Consulta para obtener los cementerios
    $sql = "SELECT * FROM cementerios";
    $resultado = mysqli_query($conn, $sql);
    $cementerios = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $cementerios[] = $row;
        }
    }
    $conn->close();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
          <div class="col-md-6 shadow-lg pb-3 mb-4 fondoEspecial rounded">
          <h4>Datos de Cementerios</h4>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 shadow-lg pb-3 mb-4 bg-white rounded">
                    <form action="registrarCementerio.php" method="POST">
                        <?php
                        // Mostrar mensajes de error
                        if (isset($_GET['mensaje'])) {
                            if ($_GET['mensaje'] == 'cementerio_existente') {
                                echo '<p id="Message" class="text-danger fw-bold">CEMENTERIO YA HABIA SIDO REGISTRADO</p>';
                            } elseif ($_GET['mensaje'] == 'sector_noregistrado') {
                                echo '<p id="Message" class="text-danger fw-bold">CEMENTERIO NO FUE REGISTRADO</p>';
                            } 
                        }
                        ?>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="col-md-3"><input id="cementerio" name="cementerio" type="text" class="form-control" placeholder="Cementerio" oninput="this.value = this.value.toUpperCase()" required></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="w-100 btn btn-guardar btn-lg"> <i class="bi bi-save"></i> Registrar Cementerio </button>
                    </form>
                </div> <!--- shadow -->
            </div> <!--- row -->
        </div> <!--- container-->


    <!--Tabla para mostrar registros de cementerios -->
    <table class="mt-2 mb-0 table table-dark table-striped">
    <thead>
        <tr>
            <th style="display: none;">ID</th>
            <th>Id. Cementerio</th>
            <th>Cementerio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cementerios as $cementerio): ?>  
        <tr>
            <td><?php echo htmlspecialchars($cementerio['idCementerio']); ?></td>
            <td><?php echo htmlspecialchars($cementerio['cementerio']); ?></td>
            <td>
                <button type="button" class="btnEditar btn btn-outline-success bi bi-pencil" data-bs-toggle="modal" data-bs-target="#modalCementerios"> Editar</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- modal para editar cementerios -->
<div id="modalCementerios" class="modal fade" tabindex="-1" aria-labelledby="modalCementerio" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ejemplo"> Editar Cementerio</h5>
            </div>
            <div class="modal-body">
                <form action="editarCementerio.php" method="POST" id="formEditarCementerio">
                    <input name="idCementerio_editar" id="idCementerio_editar" type="text" hidden>
                    <input id="cementerio_editar" name="cementerio_editar" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()">
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
            var id = fila.querySelector('td:nth-child(1)').innerText; // Obtener el distrito de la segunda columna
            var cementerio = fila.querySelector('td:nth-child(2)').innerText; // Obtener el distrito de la segunda columna
            document.getElementById('idCementerio_editar').value = id; // Establecer el valor en el campo de edición
            document.getElementById('cementerio_editar').value = cementerio; // Establecer el valor en el campo de edición
        });
    });
</script>




