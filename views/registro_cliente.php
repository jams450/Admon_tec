<!DOCTYPE html>
<html lang="en">
  <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/head.php'); ?>

  <body>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/navbar.php'); ?>

		<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">Registro</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Inicio</a></span> <span>Registro</span></p>
          </div>
        </div>
      </div>
    </div>

		<section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class=" ftco-animate">
          <form class="steps" method="post" id='newcustomer' name="newcustomer" action="/src/controller/controlador_cliente.php" enctype="multipart/form-data">
            <h3 class="mb-4 billing-heading">Registro de Cliente</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-4">
	                <div class="form-group">
	                	<label>Nombre(s) *</label>
	                  <input id="nombre" name="nombre" required="required" type="text" value="" maxlength="80" placeholder="Nombre (s) *" data-rule-required="true" data-msg-required="Nombre(s) requerido(s)" autocomplete="off">
	                </div>
	              </div>
	              <div class="col-md-4">
	                <div class="form-group">
	                	<label>Apellido Paterno *</label>
	                  <input id="appat" name="appat" required="required" type="text" value="" maxlength="80" placeholder="Apellido Paterno *" data-rule-required="true" data-msg-required="Apellido Paterno requerido" autocomplete="off">
	                </div>
                </div>
                <div class="col-md-4">
	                <div class="form-group">
	                	<label>Apellido Materno *</label>
	                  <input id="apmat" name="apmat" required="required" type="text" value="" maxlength="80" placeholder="Apellido Materno *" data-rule-required="true" data-msg-required="Apellido Materno requerido" autocomplete="off">
	                </div>
                </div>
                <div class="col-md-4">
	                <div class="form-group">
	                	<label>RFC *</label>
	                  <input id="rfc" name="rfc" required="required" type="text" value="" maxlength="80" placeholder="RFC *" data-rule-required="true" data-msg-required="RFC requerido" autocomplete="off">
	                </div>
                </div>
                <div class="col-md-4">
	                <div class="form-group">
	                	<label>Teléfono *</label>
	                  <input id="telefono" name="nombre" required="required" type="tel" value="" maxlength="80" placeholder="Teléfono *" data-rule-required="true" data-msg-required="Teléfono requerido" autocomplete="off">
	                </div>
                </div>
                <h4 class="mb-4 billing-heading">Dirección</h4>
                <div class="col-md-4">
	                <div class="form-group">
	                	<label>Calle *</label>
	                  <input id="calle" name="calle" required="required" type="text" value="" maxlength="80" placeholder="Calle *" data-rule-required="true" data-msg-required="Calle requerida" autocomplete="off">
	                </div>
                </div>
                <div class="col-md-4">
	                <div class="form-group">
	                	<label>Número Exterior</label>
	                  <input id="noext" name="noext" type="text" value="" maxlength="80" placeholder="Número Exterior" data-rule-required="true" data-rule-required="false" autocomplete="off">
	                </div>
                </div>
                <div class="col-md-4">
	                <div class="form-group">
	                	<label>Número Interior *</label>
	                  <input id="noint" name="noint" required="required" type="text" value="" maxlength="80" placeholder="Número Interior *" data-rule-required="true" data-msg-required="Número Interior requerido" autocomplete="off">
	                </div>
                </div>
                <div class="col-md-4">
	                <div class="form-group">
	                	<label>Colonia *</label>
	                  <input id="colonia" name="colonia" required="required" type="text" value="" maxlength="80" placeholder="Colonia *" data-rule-required="true" data-msg-required="Colonia requerida" autocomplete="off">
	                </div>
                </div>
                <div class="col-md-4">
	                <div class="form-group">
	                	<label>Delegación *</label>
	                  <input id="iddelegacion" name="iddelegacion" required="required" type="text" value="" maxlength="80" placeholder="Número Interior *" data-rule-required="true" data-msg-required="Delegación requerida" autocomplete="off">
	                </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-12 ">
                  <p><a href="#"class="btn btn-primary py-3 px-4">Registrarse</a></p>
                </div>
	            </div>
	          </form><!-- END -->

          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/footer.php'); ?>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/scriptjs.php'); ?>
        <script type="text/javascript" src="src/js/alta_usuario.js"></script>

  </body>
</html>
