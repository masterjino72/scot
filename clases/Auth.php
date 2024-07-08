<?php
include "Conexion.php";

class Auth extends Conexion {
    
    public function login($usuario, $password) {
        $conexion = parent::conectar();
        $passwordExistente = "";
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $respuesta = mysqli_query($conexion, $sql);
        $datosUsuario = mysqli_fetch_array($respuesta);
        

         // Verificar si el usuario existe
        if (!$datosUsuario) {
            header("Location: /index.php?mensaje=usuario_noexistente");
            exit;
        }

        // Verificar si el usuario está activo
        if ($datosUsuario['estado'] != 'A') {
            header("Location: /index.php?mensaje=usuario_inactivo");
            exit;
        }

        // Verificar la contraseña
        if (!password_verify($password, $datosUsuario['password'])) {
            header("Location: /index.php?mensaje=contrasenia_equivocada");
            exit;
        }


        if ($datosUsuario && password_verify($password, $datosUsuario['password'])) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['rol'] = $datosUsuario['rol'];
            return true;
        } else {
            return false;
        }
    }
}
?>
