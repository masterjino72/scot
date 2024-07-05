<?php
   session_start(); 
   include "../../clases/Auth.php";
   $usuario = $_POST['usuario'];
   $password = $_POST['password'];

   $Auth = new Auth();

   if ($Auth->login($usuario, $password)) {
        header("location:../../inicio.php");
   } else {
    header("location: /index.php?mensaje=error_login");
   }
?>
