<?php include '../../templates/header_menu.php';  ?>
<?php 
    include "../../clases/conexion.php";  
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Consulta para obtener los parametros
    $sql = "SELECT * FROM categorias";
    $resultado = mysqli_query($conn, $sql);
    $categorias = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $categorias[] = $row;
        }
    }

    $conn->close();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 shadow-lg pb-3 mb-4 fondoEspecial rounded">
        <h4>Datos de Categorias</h4>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 shadow-lg pb-3 mb-4 bg-white rounded">
                    <form action="registrarCategoria.php" method="POST">
                        <?php
                        // Mostrar mensajes de error
                        if (isset($_GET['mensaje'])) {
                            if ($_GET['mensaje'] == 'categoria_existente') {
                                echo '<p id="Message" class="text-danger fw-bold">CATEGORIA YA HABIA SIDO REGISTRADA</p>';
                            } elseif ($_GET['mensaje'] == 'categoria_noregistrada') {
                                echo '<p id="Message" class="text-danger fw-bold">CATEGORIA NO FUE REGISTRADA</p>';
                            } 
                        }
                        ?>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="col-md-3"><input id="categoria" name="categoria" type="text" class="form-control" placeholder="Categoria" oninput="this.value = this.value.toUpperCase()" required></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="w-100 btn btn-guardar btn-lg"> <i class="bi bi-save"></i> Registrar Categoria </button>
                    </form>
                </div> <!--- shadow -->
            </div> <!--- row -->
        </div> <!--- container-->


    <!--Tabla para mostrar registros de categorias -->
    <table class="mt-2 mb-0 table table-dark table-striped">
    <thead>
        <tr>
            <th style="display: none;">ID</th>
            <th>No. Categoria</th>
            <th>Categoria</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorias as $categoria): ?>  
        <tr>
            <td><?php echo htmlspecialchars($categoria['idCategoria']); ?></td>
            <td><?php echo htmlspecialchars($categoria['categoria']); ?></td>
            <td>
                <button type="button" class="btnEditar btn btn-outline-success bi bi-pencil" data-bs-toggle="modal" data-bs-target="#modalCategorias"> Editar</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- modal para editar categorias -->
<div id="modalCategorias" class="modal fade" tabindex="-1" aria-labelledby="modalCategoria" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ejemplo"> Editar Categoria</h5>
            </div>
            <div class="modal-body">
                <form action="editarCategoria.php" method="POST" id="formEditarCategoria">
                    <input name="idCategoria_editar" id="idCategoria_editar" type="text" hidden>
                    <input id="categoria_editar" name="categoria_editar" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" >
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
            var categoria = fila.querySelector('td:nth-child(2)').innerText; // Obtener el distrito de la segunda columna
            document.getElementById('idCategoria_editar').value = id; // Establecer el valor en el campo de edición
            document.getElementById('categoria_editar').value = categoria; // Establecer el valor en el campo de edición
        });
    });

</script>



