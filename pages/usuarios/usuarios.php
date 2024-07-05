<?php include '../../templates/header_menu.php';  ?>
<?php 
    include "../../clases/conexion.php";  
    $conexion = new Conexion();
    $conn = $conexion->conectar();
    $sql = "SELECT * FROM usuarios";
    $resultado = mysqli_query($conn, $sql);
    $usuarios = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $usuarios[] = $row;
        }
    }
    $conn->close();
?>

<div class="container mt-5 fondoEspecial">
    <div class="row justify-content-center">
        <div class="col-md-12 shadow-lg pb-3 mb-4 bg-body rounded">
            <h4>Datos de Usuarios</h4>
            <!-- Tabla para mostrar registros de usuarios -->
            <table id="tablax" class="mt-2 mb-0 table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th style="display: none;">2do Nombre</th>
                        <th>Apellido</th>
                        <th style="display: none;">2do Apellido</th>
                        <th style="display: none;">Email</th>
                        <th>Celular</th>
                        <th style="display: none;">Dirección</th>
                        <th>Estado</th>
                        <th>Usuario</th>
                        <th class="w-25">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['identificacion']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nombre1']); ?></td>
                        <td style="display: none;"><?php echo htmlspecialchars($usuario['nombre2']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['apellido1']); ?></td>
                        <td style="display: none;"><?php echo htmlspecialchars($usuario['apellido2']); ?></td>
                        <td style="display: none;"><?php echo htmlspecialchars($usuario['email']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['celular']); ?></td>
                        <td style="display: none;"><?php echo htmlspecialchars($usuario['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['estado']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['usuario']); ?></td>
                        <td>
                            <a href="baja.php?id=<?php echo htmlspecialchars($usuario['identificacion']); ?>" class="btn btn-outline-danger bi bi-trash" onclick="return confirm('¿Estás seguro de que deseas dar de baja a este usuario?');"> Baja</a>
                            <button type="button" class="btnEditar btn btn-outline-success bi bi-pencil" data-bs-toggle="modal" data-bs-target="#modalUsuarios"> Editar</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> <!-- col main -->
    </div> <!-- row main -->
</div> <!-- container main -->


<!-- modal para editar usuarios -->
<div id="modalUsuarios" class="modal fade" tabindex="-1" aria-labelledby="modalUsuario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ejemplo"> Editar Usuario</h5>
            </div>
            <div class="modal-body">

                <form action="editar.php" method="POST" id="formEditarUsuario">
                    <div class="row mb-3">
                        <label for="identificacion_editar" class="col-sm-3 col-form-label">Identificacion</label>
                        <div class="col-sm-9"><input id="identificacion_editar" name="identificacion_editar" type="text" class="form-control"></div>
                    </div>
                    <div class="row mb-3">
                        <label for="nombre1_editar" class="col-sm-3 col-form-label">1er. Nombre</label>
                        <div class="col-sm-9"><input id="nombre1_editar" name="nombre1_editar" type="text" class="form-control"></div>
                    </div>
                    <div class="row mb-3">
                        <label for="nombre2_editar" class="col-sm-3 col-form-label">2do. Nombre</label>
                        <div class="col-sm-9"><input id="nombre2_editar" name="nombre2_editar" type="text" class="form-control"></div>
                    </div>
                    <div class="row mb-3">
                        <label for="apellido1_editar" class="col-sm-3 col-form-label">1er. Apellido</label>
                        <div class="col-sm-9"><input id="apellido1_editar" name="apellido1_editar" type="text" class="form-control"></div>
                    </div>
                    <div class="row mb-3">
                        <label for="apellido2_editar" class="col-sm-3 col-form-label">2do. Apellido</label>
                        <div class="col-sm-9"><input id="apellido2_editar" name="apellido2_editar" type="text" class="form-control"></div>
                    </div>
                    <div class="row mb-3">
                        <label for="email_editar" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9"><input id="email_editar" name="email_editar" type="text" class="form-control"></div>
                    </div>
                    <div class="row mb-3">
                        <label for="celular_editar" class="col-sm-3 col-form-label">Celular</label>
                        <div class="col-sm-9"><input id="celular_editar" name="celular_editar" type="text" class="form-control"></div>
                    </div>
                    <div class="row mb-3">
                        <label for="direccion_editar" class="col-sm-3 col-form-label">Dirección</label>
                        <div class="col-sm-9"><input id="direccion_editar" name="direccion_editar" type="text" class="form-control"></div>
                    </div>
                    <div class="row mb-3">
                        <label for="estado_editar" style="text-align: right;" class="col-sm-9 col-form-label">Estado</label>
                        <div class="col-sm-3"><input id="estado_editar" name="estado_editar" type="text" class="form-control" readonly></div>
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
                <h5 class="modal-title" id="ejemplo"> Clave Secreta para Alta de Usuario</h5>
            </div>
            <div class="modal-body text-center">
                    <input name="claveAlta" id="claveAlta" type="password" placeholder="Digite clave">
                    <div class="modal-footer">  
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <a id="reactivar_link" href="#" class="btn btn-outline-primary bi bi-pencil" onclick="actualizarHref()">Aceptar</a>
                    </div>
                <p class="bg-danger text-center" id="mensajeAlta"></p>
            </div> <!--- modal-body-->
        </div> <!--- modal-content-->
    </div> <!--- modal-dialog-->
</div> <!--- modal -->


<!-- Modal para mostrar mensajes -->
<div class="modal fade" id="mensajeModal" tabindex="-1" aria-labelledby="mensajeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mensajeModalLabel">Mensaje</h5>
      </div>
      <div class="modal-body">
        <p id="mensajeTexto"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script>
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('modificar-usuario')) {
            // Obtén los datos del contribuyente del botón clickeado
            const identificacion = event.target.getAttribute('dident');
            const username = event.target.getAttribute('dusername');
            const password = event.target.getAttribute('dpassword');
            const rol = event.target.getAttribute('drol');
            // Llena los campos del formulario con los datos del cliente
            document.getElementById('identificacion').value = identificacion;
        }
    });

    document.querySelectorAll('.btnEditar').forEach(function(btnEditar) {
        btnEditar.addEventListener('click', function() {
            var fila = btnEditar.closest('tr'); // Obtener la fila actual
            var id = fila.querySelector('td:nth-child(1)').innerText; // Obtener el dato de la primera columna
            var nombre1 = fila.querySelector('td:nth-child(2)').innerText; // Obtener el dato de la segunda columna
            var nombre2 = fila.querySelector('td:nth-child(3)').innerText; // Obtener el dato de la tercera columna
            var apellido1 = fila.querySelector('td:nth-child(4)').innerText; // Obtener el dato de la cuarta columna
            var apellido2 = fila.querySelector('td:nth-child(5)').innerText; // Obtener el dato de la quinta columna
            var email = fila.querySelector('td:nth-child(6)').innerText; // Obtener el dato de la sexta columna
            var celular = fila.querySelector('td:nth-child(7)').innerText; // Obtener el dato de la septima columna
            var direccion = fila.querySelector('td:nth-child(8)').innerText; // Obtener el dato de la octava columna
            var estado = fila.querySelector('td:nth-child(9)').innerText; // Obtener el dato de la novena columna
            document.getElementById('identificacion_editar').value = id; // Establecer el valor en el campo de edición
            document.getElementById('nombre1_editar').value = nombre1; // Establecer el valor en el campo de edición
            document.getElementById('nombre2_editar').value = nombre2; // Establecer el valor en el campo de edición
            document.getElementById('apellido1_editar').value = apellido1; // Establecer el valor en el campo de edición
            document.getElementById('apellido2_editar').value = apellido2; // Establecer el valor en el campo de edición
            document.getElementById('email_editar').value = email; // Establecer el valor en el campo de edición
            document.getElementById('celular_editar').value = celular; // Establecer el valor en el campo de edición
            document.getElementById('direccion_editar').value = direccion; // Establecer el valor en el campo de edición
            document.getElementById('estado_editar').value = estado; // Establecer el valor en el campo de edición
            if (estado === "A" ){ btnReactivar.style.display = "none"; }
            else { btnReactivar.style.display = "block"; }
            var divTexto = document.getElementById("mensajeAlta");
            divTexto.textContent = "";
        }); 
    });

   
    function actualizarHref() {
        // Obtener el valor del campo de entrada
        var identificacion = document.getElementById("identificacion_editar").value;
        var claveIngresada = document.getElementById("claveAlta").value;
        
        if (claveIngresada === "111") {
           console.log('La clave es correcta.');
            // Obtener el enlace por su ID
            var link = document.getElementById("reactivar_link");
            // Concatenar el valor de identificacion_editar al href del enlace
            link.href = "alta.php?id=" + identificacion;
        } else {
            console.log('La clave es incorrecta.');
            var divTexto = document.getElementById("mensajeAlta");
            divTexto.textContent = "¡Clave equivocada!";
            setTimeout(function() {
                divTexto.textContent = ""; // Eliminar el contenido del div
                document.getElementById("mensajeAlta").value="";
                document.getElementById("claveAlta").value="";
            }, 5000); // 2500 milisegundos = 5 segundos
        }
    }
</script>




