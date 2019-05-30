<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/src/model/conexion.php");

$operacion = $_POST['operacion'];
switch ($operacion) {
  case 'buscar':

    $nombre=$_POST['nombre'];
    $tipo_evento=$_POST['tipo'];
    $sql="";

    if ($tipo_evento != '0') {
        if ($sql == '') {
            $art="where ";
        } else {
            $art=" and ";
        }
        $sql.=$art." articulos.idcategoria = ".$tipo_evento;
    }

    if ($nombre != '') {
        if ($sql == '') {
            $art="where ";
        } else {
            $art=" and ";
        }
        $sql.=$art." nombre like '%".$nombre."%'";
    }

    $eventos=$conexion->query(" select idarticulo,nombre, categoria from articulos inner join categoria_articulo
                             on categoria_articulo.idcategoria=articulos.idcategoria ".$sql."");
    //die(json_encode($sql));
    $vista_mesas= array();
    while ($result=$eventos->fetch_assoc()) {
        $vista_mesas[]='
        <div class="col-sm col-md-6 col-lg-3">
          <div class="product">
            <a href="#" class="img-prod"><img class="img-fluid" style="height: 200px; width:255px " src="images/productos/'.$result['idarticulo'].'.jpg"></a>
            <div class="text py-3 px-3">
              <h3><a href="#">'.$result['nombre'].'</a></h3>
              <div class="d-flex">
                <div class="pricing">
                  <p class="price"><span>Categoria</span></p>
                </div>
                <div class="rating">
                  <p class="text-right">
                    <span>'.$result['categoria'].'</span>
                  </p>
                </div>
              </div>
              <hr>
              <p class="bottom-area d-flex">
    							<a href="#" id="articulo_'.$result['idarticulo'].'" class="add-to-cart anadir"><span>Añadir al carrito <i class="ion-ios-add ml-1"></i></span></a>
    						</p>
            </div>
          </div>
        </div>

      ';
    }
    die(json_encode($vista_mesas));
    break;

}
