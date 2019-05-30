<?php
    /*session_start();
    if (isset($_SESSION['id_sesion_cliente'])) {
        header("location: index.php");
    }*/
?>

<!DOCTYPE html>
<html lang="en">
  <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/head.php'); ?>

  <body>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/navbar.php'); ?>

		<div class="hero-wrap hero-bread" style="background-image: url('images/index_bg.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">Nueva Mesa de Regalos</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Inicio</a></span> <span>Nueva Mesa de Regalos</span></p>
          </div>
        </div>
      </div>
    </div>

		<section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class=" ftco-animate">
          <form class="steps" method="post" id='newcustomer' name="newcustomer" action="/src/controller/controlador_mesa.php" enctype="multipart/form-data">
            <h3 class="mb-4 billing-heading">Agregar Mesa de Regalos</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-12">
	                <div class="form-group">
	                	<label>Tipo de Evento *</label>
                    <select name="idtipoevento" id="idtipoevento" class="form-control">
                        <option value="1">Cumpleaños</option>
                        <option value="2">Bautizo</option>
                        <option value="3">Boda</option>
                        <option value="4">XV Años</option>
                    </select>
	                </div>
	              </div>
	              <div class="col-md-12">
	                <div class="form-group">
	                	<label>Fecha del Evento *</label>
	                  <input id="fechaevento" class="form-control" name="fechaevento" required="required" type="date" value="" maxlength="80" data-rule-required="true" data-msg-required="Fecha del Evento requerida" autocomplete="off">
	                </div>
                </div>

                <div class="w-100"></div>
                <div class="col-md-12 ">
                  <input type="hidden" name="operacion" id="operacion" value="alta_mesa">
                  <button type="submit" id="nuevamesa" name="nuevamesa" class="btn btn-primary py-3 px-4">Crear Mesa</button>
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

        <script type="text/javascript" src="js/sweetalert2.min.js"></script>
        <script type="text/javascript" src="src/js/alta_usuario.js"></script>

  </body>
</html>
