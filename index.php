<?php
session_start();

 ?>
<!DOCTYPE html>
<html >
  <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/head.php'); ?>
  <style media="screen">
    .hero-wrap  .overlay{
      background: #F3F09F;
    }
  </style>
  <body>
    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/navbar.php'); ?>

    <div class="hero-wrap js-fullheight" style="background-image: url('images/index_bg.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
          <h3 class="v">Mesa de Regalos - El detalle perfecto</h3>
          <h3 class="vr">Desde - 2019</h3>
          <div class="col-md-11 ftco-animate text-center">
            <h1>El detalle perfecto</h1>
            <h2><span>Todo para tus Eventos</span></h2>
          </div>
          <div class="mouse">
            <a href="#" class="mouse-icon">
              <div class="mouse-wheel"><span class="ion-ios-arrow-down"></span></div>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="goto-here"></div>

    <section class="ftco-section ftco-product bg-light">
      <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <h1 class="big">Eventos</h1>
            <h2 class="mb-4">Tipos de eventos</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="product-slider owl-carousel ftco-animate">
              <div class="item">
                <div class="product">
                  <a href="#" class="img-prod"><img class="img-fluid" src="images/cumpleanos.jpg" style="height: 200px" alt="Ccumpleanos">
                  </a>
                  <div class="text pt-3 px-3">
                    <h3><a href="#">Cumpleaños</a></h3>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product">
                  <a href="#" class="img-prod"><img class="img-fluid" src="images/bautizo.jpg" style="height: 200px" alt="bautizo"></a>
                  <div class="text pt-3 px-3">
                    <h3><a href="#">Bautizo</a></h3>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product">
                  <a href="#" class="img-prod"><img class="img-fluid" src="images/boda.jpg" style="height: 200px" alt="boda"></a>
                  <div class="text pt-3 px-3">
                    <h3><a href="#">Casamiento o Boda</a></h3>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product">
                  <a href="#" class="img-prod"><img class="img-fluid" src="images/quince_anos.jpg" style="height: 200px" alt="quince_anos"></a>
                  <div class="text pt-3 px-3">
                    <h3><a href="#">Quince años</a></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-services ">
      <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <h1 class="big">Servicios</h1>
            <h2>Nuestros Servicios</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="icon d-flex justify-content-center align-items-center mb-4">
                <span class="flaticon-002-recommended"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Mesas de Regalo</h3>
                <p>Crear mesas de regalo para todos tus eventos</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="icon d-flex justify-content-center align-items-center mb-4">
                <span class="flaticon-001-box"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Entrega De Regalos</h3>
                <p>Envio de regalos 7 dias despues del cierre del evento</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="icon d-flex justify-content-center align-items-center mb-4">
                <span class="flaticon-003-medal"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Variedad de productos</h3>
                <p>Tenemos todos los productos para que tu evento sea exitoso</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/footer.php'); ?>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/scriptjs.php'); ?>

  </body>
</html>
