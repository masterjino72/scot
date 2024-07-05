<?php include '../../templates/header_menu.php';  ?>
<?php 
    include "../../clases/conexion.php";  
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Consulta para obtener los sectores
    $sql = "SELECT * FROM sectores";
    $resultado = mysqli_query($conn, $sql);
    $sectores = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $sectores[] = $row;
        }
    }

    $conn->close();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
          <div class="col-md-6 shadow-lg pb-3 mb-4 fondoEspecial rounded">
          <h4>Datos de Sectores</h4>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 shadow-lg pb-3 mb-4 bg-white rounded">
                    <form action="registrarSector.php" method="POST">
                        <?php
                        // Mostrar mensajes de error
                        if (isset($_GET['mensaje'])) {
                            if ($_GET['mensaje'] == 'sector_existente') {
                                echo '<p id="Message" class="text-danger fw-bold">SECTOR YA HABIA SIDO REGISTRADO</p>';
                            } elseif ($_GET['mensaje'] == 'sector_noregistrado') {
                                echo '<p id="Message" class="text-danger fw-bold">SECTOR NO FUE REGISTRADO</p>';
                            } 
                        }
                        ?>
                        <table class="table">   
                            <tbody>
                                <tr>
                                    <td class="col-md-3"><input id="sector" name="sector" type="text" class="form-control" placeholder="Sector" oninput="this.value = this.value.toUpperCase()" required></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="w-100 btn btn-guardar btn-lg"> <i class="bi bi-save"></i> Registrar Sector </button>
                    </form>
                </div> <!--- shadow -->
            </div> <!--- row -->
        </div> <!--- container-->


    <!--Tabla para mostrar registros de sectores -->
    <table class="mt-2 mb-0 table table-dark table-striped">
    <thead>
        <tr>
            <th style="display: none;">ID</th>
            <th>No. Sector</th>
            <th>Sector</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sectores as $sector): ?>  
        <tr>
            <td><?php echo htmlspecialchars($sector['idSector']); ?></td>
            <td><?php echo htmlspecialchars($sector['sector']); ?></td>
            <td>
                <button type="button" class="btnEditar btn btn-outline-success bi bi-pencil" data-bs-toggle="modal" data-bs-target="#modalSectores"> Editar</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- modal para editar sectores -->
<div id="modalSectores" class="modal fade" tabindex="-1" aria-labelledby="modalSector" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ejemplo"> Editar Sector</h5>
            </div>
            <div class="modal-body">
                <form action="editarSector.php" method="POST" id="formEditarSector">
                    <input name="idSector_editar" id="idSector_editar" type="text" hidden>
                    <input id="sector_editar" name="sector_editar" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" >
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
            var sector = fila.querySelector('td:nth-child(2)').innerText; // Obtener el distrito de la segunda columna
            document.getElementById('idSector_editar').value = id; // Establecer el valor en el campo de edición
            document.getElementById('sector_editar').value = sector; // Establecer el valor en el campo de edición
        });
    });
</script>



