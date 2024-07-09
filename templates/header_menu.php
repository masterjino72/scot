<?php
    session_start();

    // Verificar sesión de usuario
    if (!isset($_SESSION['usuario'])) {
        header("Location: /index.php");
        exit;
    }

    // Aquí debes establecer la conexión a tu base de datos
    // Reemplaza 'tu_host', 'tu_usuario', 'tu_contraseña' y 'tu_base_de_datos' con tus propios valores
    $conexion = new mysqli('localhost', 'root', '', 'scot');
    
    // Preparar consulta para obtener el ID del usuario
    $usuario = $_SESSION['usuario'];
    $sql = "SELECT identificacion FROM usuarios WHERE usuario = '$usuario'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        // Obtener el ID del usuario
        $fila = $resultado->fetch_assoc();
        $id_usuario = $fila['identificacion'];
    } else {
        // Si no se encuentra el usuario, puedes manejarlo de acuerdo a tu lógica
        $id_usuario = ''; // Puedes establecer un valor predeterminado o mostrar un mensaje de error
    }

    // Cerrar conexión
    $conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion SCOT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("/public/Imagenes/FondoX.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #000; /* Letras negras */
        }

        .brand-container {
            display: flex;
            margin-left: 10px;
            color: white;
            align-items: flex-end; /* Alinea el logo y el texto verticalmente */
        }

        /* Personalización del paginador */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            margin-left: 5px;
            margin-right: 5px;
        }


        .dataTables_filter {
            text-align: right;
            float: right;
            margin-bottom: 10px; /* Ajusta el margen inferior según sea necesario */
        }

        .dataTables_length {
            float: left;
            margin-right: 10px; /* Ajusta el margen derecho según sea necesario */
        }

    </style>
</head>
<body>
<?php
//session_start();
if (isset($_POST['cerrarSesion'])) {
    session_unset();
    session_destroy();
    header("Location: /index.php"); 
    exit;
}

if (!isset($_SESSION['usuario'])) {
    header("location:/index.php");  
}
?>
<input type="text" value="<?php echo $_SESSION['rol'];?>" id="nivel1" name="nivel1" hidden>
<input type="text" value="jairo" id="usernom" name="usernom" hidden>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="brand-container" style="align-items:center">
            <img src="/public/Imagenes/Escudo.png" alt="Escudo" class="img-fluid" style="height: 50px;">
            <span style="margin:10px">Alcaldia Municipal de Jinotega</span>
            <img src="/public/Imagenes/scot_logo.png" alt="">
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-auto" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown" id="adminMenu" style="display: none;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu Administrador
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <li><a class="dropdown-item" href="/pages/usuarios/usuarios.php">Usuarios</a></li>
                        <li><a class="dropdown-item" href="/pages/barrios/barrios.php">Barrios</a></li>
                        <li><a class="dropdown-item" href="/pages/parametros/parametros.php">Parametrización</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/pages/contribuyentes/contribuyentes.php">Contribuyentes</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><form action="" method="POST">
                            <button type="submit" class="btn btn-primary btn-block" name="cerrarSesion">Cerrar Sesion</button>
                        </form></li>
                    </ul>
                </li>
                <li class="nav-item dropdown" id="registroMenu" style="display: none;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu Auxiliar de Registro
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <li><a class="dropdown-item" href="/pages/ibis/contribuyentes.php">Registro IBI</a></li>
                        <li><a class="dropdown-item" href="#">Registrar Boletas</a></li>
                        <li><a class="dropdown-item" href="/pages/contribuyentes/contribuyentes.php">Contribuyentes</a></li>
                        <li><a class="dropdown-item" href="#">Reportes</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><form action="" method="POST">
                            <button type="submit" class="btn btn-primary btn-block" name="cerrarSesion">Cerrar Sesion</button>
                        </form></li>
                    </ul>
                </li>
                <li class="nav-item dropdown" id="cementerioMenu" style="display: none;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu Resp. Cementerio
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown3">
                        <li><a class="dropdown-item" href="/pages/lotes/lotes.php">Lotes</a></li>
                        <li><a class="dropdown-item" href="/pages/lotes/tablaLoteContribuyente.php">Lote-Contribuyente</a></li>
                        <li><a class="dropdown-item" href="/pages/lotes/tablaDeudoContribuyente.php">Deudo-Contribuyente</a></li>
                        <li><a class="dropdown-item" href="#">Reportes</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><form action="" method="POST">
                            <button type="submit" class="btn btn-primary btn-block" name="cerrarSesion">Cerrar Sesion</button>
                        </form></li>
                    </ul>
                </li>
                <li class="nav-item dropdown" id="fierrosMenu" style="display: none;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu Resp. Fierros
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown4">
                        <li><a class="dropdown-item" href="/pages/fierros/contribuyentes.php">Fierro-Contribuyente</a></li>
                        <li><a class="dropdown-item" href="#">Reportes</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><form action="" method="POST">
                            <button type="submit" class="btn btn-primary btn-block" name="cerrarSesion">Cerrar Sesion</button>
                        </form></li>
                    </ul>
                </li>
                <li class="nav-item dropdown" id="contribuyenteMenu" style="display: none;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown5" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu Contribuyente
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown5">
                    <li><a class="dropdown-item" href="/pages/contribuyentes/tributos.php?id=<?php echo $id_usuario; ?>">Tributos</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><form action="" method="POST">
                        <button type="submit" class="btn btn-primary btn-block" name="cerrarSesion">Cerrar Sesion</button>
                    </form></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<b style="background-color: #00ffaa; padding: 5px; border-radius: 5px; font-size: 15px;">
    <span style="color: black">Usuario:</span> <span style="color: red; text-transform: uppercase;"><?php echo $_SESSION['usuario']; ?></span>
    <span style="color: black">Rol: </span> <span style="color: red; text-transform: uppercase;"><?php echo $_SESSION['rol'];?></span>
</b>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap5.min.js"></script>

<script>
window.addEventListener("DOMContentLoaded", function() {
    var nivel1Value = document.getElementById("nivel1").value.toLowerCase();
    mostrarMenu(nivel1Value);
});

function mostrarMenu(nivel) {
    var adminMenu = document.getElementById("adminMenu");
    var cementerioMenu = document.getElementById("cementerioMenu");
    var fierrosMenu = document.getElementById("fierrosMenu");
    var contribuyenteMenu = document.getElementById("contribuyenteMenu");
    var registroMenu = document.getElementById("registroMenu");

    adminMenu.style.display = "none";
    cementerioMenu.style.display = "none";
    fierrosMenu.style.display = "none";
    contribuyenteMenu.style.display = "none";
    registroMenu.style.display = "none";

    if (nivel === "administrador") {
        adminMenu.style.display = "block";
    } else if (nivel === "cementerio") {
        cementerioMenu.style.display = "block";
    } else if (nivel === "fierros") {
        fierrosMenu.style.display = "block";
    } else if (nivel === "contribuyente") {
        contribuyenteMenu.style.display = "block";
    } else if (nivel === "registro") {
        registroMenu.style.display = "block";
    }
}
</script>

<script>
setTimeout(function() {
    var Message = document.getElementById('Message');
    if (Message) {
        Message.style.display = 'none';
    }
}, 4000);
</script>

<script>
$(document).ready(function () {
    $('#tablax').DataTable({
        language: {
            processing: "Tratamiento en curso...",
            search: "Buscar&nbsp;:",
            lengthMenu: "Agrupando _MENU_ registros",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "No existen datos.",
            infoFiltered: "(filtrado de _MAX_ registros en total)",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron registros con tu búsqueda",
            emptyTable: "No hay datos disponibles en la tabla.",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Último"
            },
            aria: {
                sortAscending: ": active para ordenar la columna en orden ascendente",
                sortDescending: ": active para ordenar la columna en orden descendente"
            }
        },
        scrollY: 200,
        lengthMenu: [[3, 5, 10, -1], [3, 5, 10, "All"]]
    });
});
</script>

</body>
</html>
