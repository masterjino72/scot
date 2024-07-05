
 <?php
 /* use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/Exception.php';
  require 'PHPMailer/PHPMailer.php';
  require 'PHPMailer/SMTP.php';
?>


<?php
if(isset($_POST['boton2']))
{
  header("Location:logout.php");
}

if(count($_POST)>0) {   
    
    
    //ENVIAR CORREO DESDE SERVIDOR BANAHOSTING
    $destino = "informatica@alcaldiajinotega.gob.ni";
    $correo = $_POST['Correo'];
    $nombres = $_POST['Nombre'];
    $telefono = $_POST['Telefono'];
    //$cabeceras = "From: ".$correo. "\r\n";
    $cabeceras = "Mensaje de Contactanos:\n";
    $mensaje = "Contribuyente: ".$nombres . "\r\nCorreo: " . $correo . "\r\nTelefono:" . $telefono . "\r\n" . $_POST["Mensaje"];
    if (!empty($correo)){
        
        mail($destino, 'Mensaje de Contacto', $mensaje, $cabeceras);
        include_once "envio_modal.php";
        MensajeAlerta("index.php");
        exit;
    }
    else
    {
        include_once "envioerror_modal.php";
        MensajeAlerta("index.php");
    }
    
    
}*/
?>
<?php include '../templates/header.php';  ?>
<link rel="stylesheet" href="../public/css/estilos_bootstrap.css">

<section class="main container">
    <div class="row">
        <section class="col-md-3">
            <img src="../public/imagenes/computadora.jpg" class="img-fluid img-rounded" alt="">
        </section>

        <section class="col-md-6 mt-3">
            <h2 class="form_titulo text-dark">INGRESE SUS DATOS DE CONTACTO</h2>
            <form name="frmUser" method="post" action="" autocomplete="off" class="login-formulario">
                <label>Nombre:</label>
                <input type="text" name="Nombre" placeholder="Nombre">
                <label>Correo:</label>
                <input type="email" name="Correo" placeholder="Correo">
                <label>Telefono:</label>
                <input type="text" name="Telefono" placeholder="Teléfono">
                <label>Mensaje:</label>
                <textarea name="Mensaje" placeholder="Escriba aqui su mensaje"></textarea>
                <p class="text-center">
                    <button type="submit" class="btn btn-primary" name="boton1">ENVIAR</button>
                    <a href="../index.php" class="btn btn-success">INICIO</a>
                </p>
            </form>
        </section>

<section class="col-md-3">
        <?php include '../templates/slide.php';  ?>
    </section> 

<?php include '../templates/footer.php';  ?>
