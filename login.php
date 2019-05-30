<!DOCTYPE html>
<html lang="en">
  <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/head.php'); ?>

  <body>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/navbar.php'); ?>

		<div class="hero-wrap hero-bread" style="background-image: url('images/index_bg.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">Inicio de Sesión</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Inicio</a></span> <span>Inicio de Sesión</span></p>
          </div>
        </div>
      </div>
    </div>

		<section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class=" ftco-animate">
          <form class="steps" method="post" id='newcustomer' name="newcustomer" action="/src/controller/controlador_cliente.php" enctype="multipart/form-data">
            <h3 class="mb-4 billing-heading">Login</h3>
	          	<div class="row align-items-end">
                <div class="col-md-12">
	                <div class="form-group">
	                	<label>Correo *</label>
	                  <input id="correo_login" class="form-control" name="correo_login" required="required" type="email" value="" maxlength="80" placeholder="Correo *" data-rule-required="true" data-msg-required="Correo requerido" autocomplete="off">
	                </div>
                </div>
                <div class="col-md-12">
	                <div class="form-group">
	                	<label>Password *</label>
	                  <input id="passwd_login" class="form-control" name="passwd_login" required="required" type="password" value="" maxlength="80" placeholder="Password *" data-rule-required="true" data-msg-required="Correo requerido" autocomplete="off">
	                </div>
                </div>
              </div>

                <div class="w-100"></div>
                <div class="col-md-12 ">
                  <input type="hidden" name="operacion" id="operacion" value="login">
                  <button type="submit" id="login_cliente" name="login_cliente" class="btn btn-primary py-3 px-4">Entrar</button>
                  <!--<p><a href="#"class="btn btn-primary py-3 px-4">Registrarse</a></p> -->
                </div>
	            </div>
	          </form><!-- END -->

          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/footer.php'); ?>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/scriptjs.php'); ?>

        <script type="text/javascript" src="assets/js/sweetalert2.min.js"></script>
        <script type="text/javascript" src="src/js/login_usuario.js"></script>

  </body>
</html>
