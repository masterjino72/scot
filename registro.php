<?php include 'templates/header.php';  ?>

<div class="container mt-12">
  <div class="row">
    <div class="col-md-8">
      <h3 class="text-dark">SOLICITUD DE REGISTRO DE CONTRIBUYENTE</h3>
      <div class="border-0 rounded-lg">
        <form style="width: 100%" id="registerForm" action="pages/registro/registrar.php" method="POST">
          <?php
            // Mostrar mensajes de error
            if (isset($_GET['mensaje'])) {
                if ($_GET['mensaje'] == 'usuario_existente') {
                    echo '<p id="Message" class="text-danger fw-bold">NOMBRE DE USUARIO EN USO.</p>';
                } elseif ($_GET['mensaje'] == 'identificacion_existente') {
                    echo '<p id="Message" class="text-danger fw-bold">IDENTIFICACION YA REGISTRADA.</p>';
                } elseif ($_GET['mensaje'] == 'email_existente') {
                    echo '<p id="Message" class="text-danger fw-bold">CORREO YA REGISTRADO.</p>';
                } elseif ($_GET['mensaje'] == 'usuario_registrado') {
                  echo '<p id="Message" class="text-danger fw-bold">¡¡USUARIO REGISTRADO EXITOSAMENTE!!.</p>';
                } elseif ($_GET['mensaje'] == 'usuario_noregistrado') {
                  echo '<p id="Message" class="text-danger fw-bold">USUARIO NO FUE REGISTRADO.<br> Consulte con el Administrador del sitio</p>';
                }
            }
          ?>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3"><input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de usuario" oninput="this.value = this.value.toUpperCase()" required></div>
              <div class="mb-3"><input type="password" class="form-control" id="password" name="password" placeholder="Contraseña de acceso" required></div>
              <div class="mb-3"><input type="text" class="form-control" id="nombre1" name="nombre1" placeholder="Primer nombre" oninput="this.value = this.value.toUpperCase()" required></div>
              <div class="mb-3"><input type="text" class="form-control" id="nombre2" name="nombre2" placeholder="Segundo nombre" oninput="this.value = this.value.toUpperCase()"></div>
              <div class="mb-3"><input type="text" class="form-control" id="apellido1" name="apellido1" placeholder="Primer apellido" oninput="this.value = this.value.toUpperCase()" required></div>
              <div class="mb-3"><input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="Segundo apellido" oninput="this.value = this.value.toUpperCase()"></div>
            </div> <!-- col-md-6 -->
            <div class="col-md-6">
              <div class="mb-3"><input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Identificación" oninput="this.value = this.value.toUpperCase()" required></div>
              <div class="mb-3"><input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" oninput="this.value = this.value.toUpperCase()"></div>
              <div class="mb-3"><input type="text" class="form-control" id="celular" name="celular" placeholder="# Celular" oninput="this.value = this.value.toUpperCase()" required></div>
              <div class="mb-3"><textarea style="margin-left: 0px; min-width: 200px;" class="form-control" id="direccion" name="direccion" rows="2" placeholder="Dirección domiciliar" oninput="this.value = this.value.toUpperCase()"></textarea></div>
              <input type="text" id="rol" name="rol" value="contribuyente" hidden>
              <input type="text" id="estado" name="estado" value="A" hidden>
            </div> <!-- col-md-6 -->
          </div> <!-- row -->
          <div class="text-center">
            <button type="submit" class="btn btn-primary">REGISTRAR</button>
            <a type="button" class="btn btn-success" href="/">INICIO</a>
          </div>
          <div style="font-size: smaller; color:white; text-align: center"><br>
            En un periodo no mayor de 72 horas, nos pondremos en contacto con usted
            para brindarle instrucciones de cómo activar su cuenta.
          </div>
        </form>
      </div>
    </div> <!--col-->
    <section class="col-md-4">
      <?php include 'templates/slideIndex.php';  ?>
    </section>
  </div>  <!--row--> 
</div> <!--container-->

<script>
  // Ocultar el mensaje después de 4 segundos
  setTimeout(function() {
    var Message = document.getElementById('Message');
    if (Message) {
      Message.style.display = 'none';
    }
  }, 4000);
</script>


<?php include 'templates/footer.php';  ?>