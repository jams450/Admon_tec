<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/src/model/conexion.php");
session_start();

$cantidad=0;
$total=0;
$iva=0;
$datos_articulos=array();
if (isset($_SESSION['articulos'])) {
    $total=0;
    foreach ($_SESSION['articulos'] as $key => $value) {
        $eventos=$conexion->query("select idarticulo,nombre,precio,categoria from articulos
                              inner join categoria_articulo on categoria_articulo.idcategoria=articulos.idcategoria
                              where idarticulo = " .$value);

        while ($result=$eventos->fetch_assoc()) {
            $datos_articulos[]=$result;
            $total+=$result['precio'];
        }
    }
    $iva=$total*0.16;
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

    <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 bg-light ftco-animate fadeInUp ftco-animated">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>&nbsp;</th>
						        <th>&nbsp;</th>
						        <th>Producto</th>
						        <th>Precio</th>
						        <th>Cantidad</th>
						        <th>Total</th>
						      </tr>
						    </thead>
						    <tbody style="background: white;">

                  <?php
                  for ($i=0; $i < count($datos_articulos); $i++) {
                      echo '
                        <tr class="text-center">
                          <td class="product-remove"><a href="#" class="quitar" id="remove_'.$datos_articulos[$i]['idarticulo'].'"><span class="ion-ios-close "></span></a></td>
                          <td  class="image-prod"><div class="img" style="background-image:url(images/productos/'.$datos_articulos[$i]['idarticulo'].'.jpg);"></div></td>
                          <td class="product-name">
                            <h3>'.$datos_articulos[$i]['nombre'].'</h3>
                            <p>Categoria:    '.$datos_articulos[$i]['categoria'].'</p>
                          </td>
                          <td class="price">$ <span class="precio_l">'.$datos_articulos[$i]['precio'].'</span></td>
                          <td class="quantity">
      						        	1
      					          </td>
                          <td class="total">$  <span class="total_l">'.$datos_articulos[$i]['precio'].'</span></td>
                        </tr>
                      ';
                  }

                   ?>
						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
        <form id="form_pagar" method="post">
          <div class="row">
            <div class="col col-lg-12 col-md-12 cart-wrap ftco-animate fadeInUp ftco-animated bg-light">
              <h3 class="text-center">Datos de la tarjeta</h3>
              <div class="row align-items-end">
  	          		<div class="col-md-4">
  	                <div class="form-group">
  	                	<label for="firstname">Nombre</label>
  	                  <input type="text" class="form-control" name="nombre" required placeholder="">
  	                </div>
  	              </div>
  	              <div class="col-md-4">
  	                <div class="form-group">
  	                	<label for="lastname">Apellido Paterno</label>
  	                  <input type="text" name="appat" required class="form-control" placeholder="">
  	                </div>
                  </div>
                  <div class="col-md-4">
  	                <div class="form-group">
  	                	<label for="lastname">Apellido Materno</label>
  	                  <input type="text" name="apmat" required class="form-control" placeholder="">
  	                </div>
                  </div>
                  <div class="w-100"></div>
  		            <div class="col-md-6">
  		            	<div class="form-group">
  	                	<label for="streetaddress">Direccion</label>
  	                  <input type="text" name="direccion" required class="form-control" >
  	                </div>
  		            </div>

  		            <div class="col-md-6">
  	                <div class="form-group">
  	                	<label for="phone">Telefono</label>
  	                  <input type="text" name="telefono" required class="form-control" placeholder="">
  	                </div>
  	              </div>

                  <div class="col-md-6">
  	                <div class="form-group">
  	                	<label for="emailaddress">Numero de la tarjeta</label>
  	                  <input type="text" class="form-control" required name="numero_tarjeta" placeholder="">
  	                </div>
                  </div>

                  <div class="col-md-3">
  	                <div class="form-group">
  	                	<label for="emailaddress">Fecha de caducidad</label>
  	                  <input type="text" class="form-control" required name="fecha_caducidad" placeholder="">
  	                </div>
                  </div>

                  <div class="col-md-3">
  	                <div class="form-group">
  	                	<label for="emailaddress">CVV</label>
  	                  <input type="text" class="form-control" required name="cvv" placeholder="">
  	                </div>
                  </div>

  	            </div>
            </div>
          </div>
      		<div class="row ">
            <div class="col col-lg-8 col-md-8 cart-wrap ftco-animate fadeInUp ftco-animated bg-light">
              <br>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                		<label for="country">Mesa de regalos de destino</label>
                		<div class="">
                      <select  name="id_mesa" id="id_mesa" class="form-control">
                        <?php
                        $eventos=$conexion->query("select idevento,fechaevento,nombre, appat, nombreevento, eventos.idtipoevento from eventos
                                                        join clientes on clientes.idcliente=eventos.idcliente
                                                        join tipoevento on tipoevento.idtipoevento = eventos.idtipoevento where estatus=1");
                        while ($result=$eventos->fetch_assoc()) {
                            echo '<option value="'.$result['idevento'].'">'.$result['fechaevento'].'  &nbsp;&nbsp;   '.$result['nombre'].'  '.$result['appat'].' &nbsp; &nbsp;    '.$result['nombreevento'].' </option>';
                        }

                         ?>
                      </select>
                    </div>
                	</div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div style="padding-top:50px" class="checkbox">
                      &nbsp;&nbsp;<label><input type="checkbox" name="si_factura" id="si_factura" value="">&nbsp; ¿Requiere Factura?</label>
                    </div>
                  </div>
                </div>
              </div>

              <div id="div_fac" style="display:none">
                <h3 class="text-center">Datos de Facturacion</h3>
                <div class="row align-items-end">
    	          		<div class="col-md-6">
    	                <div class="form-group">
    	                	<label for="firstname">RFC</label>
    	                  <input type="text" class="form-control"  name="rfc" id="rfc" placeholder="">
    	                </div>
    	              </div>
                    <div class="col-md-6">
    	                <div class="form-group">
    	                	<label for="firstname">Direccion Fiscal </label>
    	                  <input type="text" class="form-control"  name="direccion_fiscal"  id="direccion_fiscal" placeholder="">
    	                </div>
    	              </div>
    	            </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="firstname">Correo</label>
                      <input type="email" class="form-control"  name="correo"  id="correo" placeholder="">
                    </div>
                  </div>
              </div>

            </div>
      			<div class="col col-lg-4 col-md-4 cart-wrap ftco-animate fadeInUp ftco-animated bg-light">
      				<div style="background: white;" class="cart-total mb-3">
      					<h3 class="text-center">Total del carrito</h3>
      					<p class="d-flex">
      						<span>Subtotal</span>
      						<span>$ <?=$total?></span>
      					</p>
      					<p class="d-flex">
      						<span>IVA</span>
      						<span>$ <?=$iva?></span>
      					</p>
      					<hr>
      					<p class="d-flex total-price">
      						<span>Total</span>
      						<span>$<?=$iva+$total?></span>
      					</p>
      				</div>

              <button type="submit" <?php if (count($datos_articulos)==0) {
                             echo "disabled";
                         } ?> name="button" class="btn btn-primary py-3 px-4">Pagar</button>
      			</div>
      		</div>
        </form>

			</div>
		</section>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/footer.php'); ?>

    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/scriptjs.php'); ?>

    <script src="src/js/carrito.js"></script>

  </body>
</html>
