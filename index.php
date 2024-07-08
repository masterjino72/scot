<?php include 'templates/header.php';  ?>

<div class="container mt-12">
  <div class="row">
    <div class="col-md-8">
      <h3 class="text-dark">INICIO DE SESIÓN</h3>
      <div class="border-0 rounded-lg">
        <form style="width: 100%;" id="loginForm" action="pages/registro/login.php" method="POST">
          <?php 
            if (isset($_GET['mensaje'])) {
                if ($_GET['mensaje'] == 'usuario_noexistente') {
                    echo '<p id="Message" class="text-danger fw-bold">USUARIO NO EXISTE</p>';
                } elseif ($_GET['mensaje'] == 'contrasenia_equivocada') {
                    echo '<p id="Message" class="text-danger fw-bold">CONTRASEÑA INCORRECTA</p>';
                }elseif ($_GET['mensaje'] == 'usuario_inactivo') {
                  echo '<p id="Message" class="text-danger fw-bold">USUARIO DE BAJA<br>¡¡COMUNÍQUESE CON EL ADMINISTRADOR!!</p>';
                }elseif ($_GET['mensaje'] == 'error_login') {
                    echo '<p id="Message" class="text-danger fw-bold">NO SE PUDO LOGEAR</p>';
                }
            }
          ?>
          <div class="mb-3">
            <label for="usuario" class="form-label">Usuario:</label>
            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" oninput="this.value = this.value.toUpperCase()" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
          </div>
          <div class="text-center pt-4">
            <button type="submit" class="btn btn-primary">INICIAR SESIÓN</button>
            <p>No tienes cuenta? <a href="registro.php" class="btn btn-link">¡REGÍSTRATE AQUÍ!</a></p>
            <p style="padding: -20px;">
                Contacta al Administrador del Sitio
                <a href="https://wa.me/50588252163" target="_blank">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/240px-WhatsApp.svg.png" width="35" height="35" alt="WhatsApp">
                </a>
            </p>
          </div>
        </form>
      </div> <!-- .border-0 -->
    </div>
    <section class="col-md-3">
      <?php include 'templates/slideIndex.php';  ?>
    </section>
  </div>
</div>


<script>
  // Ocultar el mensaje después de 4 segundos
  setTimeout(function() {
    var Message = document.getElementById('Message');
    if (Message) {
      Message.style.display = 'none';
      window.location.href = 'index.php';
    }
  }, 4000);
</script>

<?php include 'templates/footer.php';  ?>