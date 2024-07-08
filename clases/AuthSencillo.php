<?php
include "Conexion.php";

class Auth extends Conexion {
    
    public function login($usuario, $password) {
        $conexion = parent::conectar();
        $passwordExistente = "";
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND estado = 'A'";
        $respuesta = mysqli_query($conexion, $sql);
        $datosUsuario = mysqli_fetch_array($respuesta);
        
        // DEBO VALIDAR POR PARTES..SI LA CONTRASEÑA ES LA CORRECTA, SI EL USUARIO EXISTE, SI NO EXISTE, SI ESTA DE BAJA, ETC...
        
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
