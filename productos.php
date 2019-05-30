<?php
session_start();
 ?>
<!DOCTYPE html>
<html >

  <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/head.php'); ?>

  <style media="screen">

    .bootstrap-datepicker-widget .datepicker-days table tbody tr:hover {
        background-color: #eee;
    }
    .datepicker2 table tr td span {
      width: 100%;
    }



  </style>
  <body>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/navbar.php'); ?>

		<div class="hero-wrap hero-bread" style="background-image: url('images/bg_mesas.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">Regalos mas solicitados</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Regalos</span></p>
          </div>
        </div>
      </div>
    </div>

		<section style="padding-top: 3em;" class="ftco-section bg-light">
      <div style="background:white; margin-bottom:30px" class="container">
        <div class="row">
          <div class="col-sm-4">
          	<div class="form-group">
          		<label for="country">Tipo de evento</label>
          		<div class="select-wrap">
                <select name="" id="tipo" class="form-control">
                	<option value="0">Todos</option>
                  <option value="1">Cumpleaños</option>
                  <option value="2">Bautizo</option>
                  <option value="3">Casamiento o Boda</option>
                  <option value="4">Quince años</option>
                </select>
              </div>
          	</div>
          </div>
          <div class="col-sm-3 text-center">
            <p style="padding-top: 30px">
              <a href="#" id="buscar" style="width:150px" class="btn btn-primary py-3 px-4">Buscar</a>
            </p>
          </div>
          <div class="col-sm-3 text-center">
            <p style="padding-top: 30px" id="resultados">
               Resultados
            </p>
          </div>
          <div class="col-sm-2 text-center">
            <p style="padding-top: 30px">
              <a href="#" id="imprimir" class=""> Imprimir</a>
            </p>
          </div>

        </div>
      </div>
    	<div class="container">
    		<div class="row" id="vista_productos">

    		</div>
    	</div>
    </section>


    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/footer.php'); ?>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/scriptjs.php'); ?>

    <script src="src/js/productos.js"></script>

  </body>
</html>
