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
						<form action="#" class="billing-form bg-light p-3 p-md-5">
							<h3 class="mb-4 billing-heading">Registrate !!</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-4">
	                <div class="form-group">
	                	<label for="firstname">Nombre</label>
	                  <input type="text" class="form-control" placeholder="">
	                </div>
	              </div>
	              <div class="col-md-4">
	                <div class="form-group">
	                	<label for="lastname">Apellido Paterno</label>
	                  <input type="text" class="form-control" placeholder="">
	                </div>
                </div>
                <div class="col-md-4">
	                <div class="form-group">
	                	<label for="lastname">Apellido Materno</label>
	                  <input type="text" class="form-control" placeholder="">
	                </div>
                </div>
                <div class="w-100"></div>
		            <div class="col-md-12">
		            	<div class="form-group">
	                	<label for="streetaddress">Direccion</label>
	                  <input type="text" class="form-control" placeholder="House number and street name">
	                </div>
		            </div>

		            <div class="w-100"></div>
		            <div class="col-md-6">
	                <div class="form-group">
	                	<label for="phone">Telefono</label>
	                  <input type="text" class="form-control" placeholder="">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="emailaddress">Correo Electronico</label>
	                  <input type="text" class="form-control" placeholder="">
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


  </body>
</html>
