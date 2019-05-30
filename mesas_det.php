<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/src/model/conexion.php");

$id_evento=$_GET['id'];

$eventos=$conexion->query("select idevento,nombre,appat, apmat, nombreevento, fechaevento,fechacierre from eventos
                          inner join clientes on clientes.idcliente = eventos.idcliente
                          inner join tipoevento on tipoevento.idtipoevento=eventos.idtipoevento where idevento= ".$id_evento);
if ($result=$eventos->fetch_assoc()) {
    $datos_evento=$result;
    $datos_evento['fecha_envio']=date('Y-m-d', strtotime($datos_evento['fechacierre']. ' + 7 days'));
    $eventos=$conexion->query("select mesaderegalos.idarticulo,nombre,precio,categoria, mesaderegalos.estatus, mesaderegalos.cantidad, sum(regalos_mesa.cantidad) as regalados from mesaderegalos
                              inner join articulos on articulos.idarticulo=mesaderegalos.idarticulo
                              inner join categoria_articulo on categoria_articulo.idcategoria=articulos.idcategoria
                              left join regalos_mesa on regalos_mesa.idarticulo=articulos.idarticulo
                              inner join eventos on eventos.idevento=mesaderegalos.idevento where mesaderegalos.idevento= '.$id_evento.'
                              group by mesaderegalos.idarticulo ");

    $datos_articulos= array();
    while ($result=$eventos->fetch_assoc()) {
        if ($result['estatus']==0) {
            $result['estatus']='<div class="row">
                                  <div class="col-md-6">
                                    <p>NC</p>
                                  </div>
                                  <div class="col-md-6">
                                    <p>
                                      <a href="#" id="art_'.$result['idarticulo'].'" class="btn btn-primary py-3 px-4 comprar">Comprar</a>
                                    </p>
                                  </div>
                                </div>';
        } else {
            $result['estatus']='C';
        }

        if ($result['regalados']==null) {
            $result['regalados'] =0;
        }

        $datos_articulos[]=$result;
    }

    $eventos=$conexion->query("select regalos_mesa.idarticulo,nombre,precio,categoria, cantidad from regalos_mesa
                              inner join articulos on articulos.idarticulo=regalos_mesa.idarticulo
                              inner join categoria_articulo on categoria_articulo.idcategoria=articulos.idcategoria
                              where regalos_mesa.idevento = ".$id_evento." and regalos_mesa.idarticulo not in (select idarticulo from mesaderegalos where idevento= ".$id_evento." ) ");
    $datos_articulos2= array();
    while ($result=$eventos->fetch_assoc()) {
        $datos_articulos2[]=$result;
    }
}
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

    .cart-list {
      overflow-x:auto;
    }



  </style>
  <body>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/navbar.php'); ?>

		<div class="hero-wrap hero-bread" style="background-image: url('images/bg_mesas.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">Detalle de Mesa</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Mesas</span></p>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section bg-light">
      <div  class="container">
        <div class="row">
          <div style="background:white; margin-bottom:30px; padding-top: 35px; border: 1px solid rgba(0, 0, 0, 0.05);" class="col-lg-8 product-details pl-md-5 ftco-animate fadeInUp ftco-animated text-center">
    				<h3 >Mesa de Regalo <?=$datos_evento['nombreevento']?></h3>
    				<p class="price"><span>Cliente : <?=$datos_evento['nombre'].'   '.$datos_evento['appat'].'   '.$datos_evento['apmat']?></span></p>
            <p class="price"><span>ID : <?=$datos_evento['idevento']?></span></p>
    			</div>
          <div class="col col-lg-4 col-md-6  cart-wrap ftco-animate fadeInUp ftco-animated">
    				<div  style="background:white;" class="cart-total mb-3">
    					<h3 class="text-center ">Detalles de la mesa</h3>
    					<p class="d-flex">
    						<span>Fecha Incio</span>
    						<span><?=$datos_evento['fechaevento']?></span>
    					</p>
    					<p class="d-flex">
    						<span>Fecha de cierre</span>
    						<span><?=$datos_evento['fechacierre']?></span>
    					</p>
    					<p class="d-flex">
    						<span>Fecha de envio</span>
    						<span><?=$datos_evento['fecha_envio']?></span>
    					</p>
    				</div>
    			</div>
        </div>
      </div>

    	<div class="container">
        <h3 style="background:white;border: 1px solid rgba(0, 0, 0, 0.05);" class="text-center "> Regalos Deseados </h3>
        <div class="row">
          <div class="col-md-12 ftco-animate fadeInUp ftco-animated">
    				<div style="background:white; border: 1px solid rgba(0, 0, 0, 0.05);" class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <<th>&nbsp;</th>
						        <th>&nbsp;</th>
						        <th>Producto</th>
						        <th>Precio</th>
						        <th>Cantidad</th>
						        <th>Estatus</th>
						      </tr>
						    </thead>
						    <tbody id="vista_productos">
                  <?php
                    for ($i=0; $i < count($datos_articulos); $i++) {
                        echo '
                          <tr class="text-center">
        						        <td colspan="2" class="image-prod"><div class="img" style="background-image:url(images/productos/'.$datos_articulos[$i]['idarticulo'].'.jpg);"></div></td>
        						        <td class="product-name">
        						        	<h3>'.$datos_articulos[$i]['nombre'].'</h3>
        						        	<p>Categoria:    '.$datos_articulos[$i]['categoria'].'</p>
        						        </td>
        						        <td class="price">$ '.$datos_articulos[$i]['precio'].'</td>
                            <td class="price">'.$datos_articulos[$i]['regalados'].' de '.$datos_articulos[$i]['cantidad'].'</td>
        						        <td class="total" style="font-size:30px;">'.$datos_articulos[$i]['estatus'].'</td>
        						      </tr>
                        ';
                    }
                   ?>


						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
    	</div>

      <br>

      <div class="container">
        <h3 style="background:white;border: 1px solid rgba(0, 0, 0, 0.05);" class="text-center ">Regalos Regalados</h3>
        <div class="row">
          <div class="col-md-12 ftco-animate fadeInUp ftco-animated">
    				<div style="background:white; border: 1px solid rgba(0, 0, 0, 0.05);" class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <<th>&nbsp;</th>
						        <th>&nbsp;</th>
						        <th colspan="2">Producto</th>
						        <th>Precio</th>
						        <th>Cantidad</th>
						      </tr>
						    </thead>
						    <tbody id="vista_productos">
                  <?php
                    for ($i=0; $i < count($datos_articulos2); $i++) {
                        echo '
                          <tr class="text-center">
        						        <td colspan="2" class="image-prod"><div class="img" style="background-image:url(images/productos/'.$datos_articulos2[$i]['idarticulo'].'.jpg);"></div></td>
        						        <td colspan="2" class="product-name">
        						        	<h3>'.$datos_articulos2[$i]['nombre'].'</h3>
        						        	<p>Categoria:    '.$datos_articulos2[$i]['categoria'].'</p>
        						        </td>
        						        <td class="price">$ '.$datos_articulos2[$i]['precio'].'</td>
                            <td class="price">'.$datos_articulos2[$i]['cantidad'].'</td>
        						      </tr>
                        ';
                    }
                   ?>


						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
    	</div>
    </section>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/footer.php'); ?>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/scriptjs.php'); ?>

    <script src="src/js/mesas_det.js"></script>

  </body>
</html>
