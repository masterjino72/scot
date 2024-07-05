<?php
     include "../../clases/Conexion.php";

     $usuario = $_POST['usuario'];
     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
     $rol = $_POST['rol'];
     $identificacion = $_POST['identificacion'];
     $nombre1 = $_POST['nombre1'];
     $nombre2 = $_POST['nombre2'];
     $apellido1 = $_POST['apellido1'];
     $apellido2 = $_POST['apellido2'];
     $email = $_POST['email'];
     $celular = $_POST['celular'];
     $direccion = $_POST['direccion'];
     $estado = $_POST['estado'];

     $conexion = new Conexion();
     $conexion = $conexion->conectar();

     // Verificar si el nombre de usuario ya existe
     $sql_usuario_existente = "SELECT COUNT(*) as count FROM usuarios WHERE usuario = ?";
     $query_usuario_existente = $conexion->prepare($sql_usuario_existente);
     $query_usuario_existente->bind_param('s', $usuario);
     $query_usuario_existente->execute();
     $resultado_usuario_existente = $query_usuario_existente->get_result()->fetch_assoc();

     if ($resultado_usuario_existente['count'] > 0) {
     // El nombre de usuario ya está en uso
     header("Location: ../../registro.php?mensaje=usuario_existente");
     exit();
     }

     // Verificar si la identificación ya existe
     $sql_identificacion_existente = "SELECT COUNT(*) as count FROM usuarios WHERE identificacion = ?";
     $query_identificacion_existente = $conexion->prepare($sql_identificacion_existente);
     $query_identificacion_existente->bind_param('s', $identificacion);
     $query_identificacion_existente->execute();
     $resultado_identificacion_existente = $query_identificacion_existente->get_result()->fetch_assoc();

     if ($resultado_identificacion_existente['count'] > 0) {
     // La identificación ya está en uso
     header("Location: ../../registro.php?mensaje=identificacion_existente");
     exit();
     }

     // Verificar si el correo electrónico ya existe
     $sql_email_existente = "SELECT COUNT(*) as count FROM usuarios WHERE email = ?";
     $query_email_existente = $conexion->prepare($sql_email_existente);
     $query_email_existente->bind_param('s', $email);
     $query_email_existente->execute();
     $resultado_email_existente = $query_email_existente->get_result()->fetch_assoc();

     if ($resultado_email_existente['count'] > 0) {
     // El correo electrónico ya está en uso
     header("Location: ../../registro.php?mensaje=email_existente");
     exit();
     }

     // Si todo está bien, procedemos con la inserción
     $sql = "INSERT INTO usuarios (usuario, password, rol, identificacion, nombre1, nombre2, apellido1, apellido2, email, celular, direccion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";  
     $query = $conexion->prepare($sql);
     $query->bind_param('ssssssssssss', $usuario, $password, $rol, $identificacion, $nombre1, $nombre2, $apellido1, $apellido2, $email, $celular, $direccion, $estado);
     if ($query->execute()) {
     header("Location: ../../registro.php?mensaje=usuario_registrado");
     } else {
     header("Location: ../../registro.php?mensaje=usuario_noregistrado");
     }

?>
