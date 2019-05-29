<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/src/model/conexion.php");

$operacion = $_POST['operacion'];
switch ($operacion) {
  case 'buscar':

    $nombre=$_POST['nombre'];
    $tipo_evento=$_POST['tipo'];
    $sql="";

    if ($nombre != '') {
        if ($sql == '') {
            $art="where ";
        } else {
            $art="and ";
        }
        $sql.=$art."nombre like '%".$nombre."%'";
    }

    if ($tipo_evento != '0') {
        if ($sql == '') {
            $art="where ";
        } else {
            $art=" and ";
        }
        $sql.=$art." eventos.idtipoevento = ".$tipo_evento;
    }

    $eventos=$conexion->query("select fechaevento,nombre, appat, nombreevento, eventos.idtipoevento from eventos
                                    join clientes on clientes.idcliente=eventos.idcliente
                                    join tipoevento on tipoevento.idtipoevento = eventos.idtipoevento ".$sql);
    //die(json_encode($sql));
    $vista_mesas= array();
    while ($result=$eventos->fetch_assoc()) {
        $vista_mesas[]='
        <div class="col-sm col-md-6 col-lg-3">
          <div class="product">
            <a href="#" class="img-prod"><img class="img-fluid" style="height: 200px; width:255px " src="images/tipoevento/'.$result['idtipoevento'].'.jpg"></a>
            <div class="text py-3 px-3">
              <h3><a href="#">'.$result['nombre'].'  '.$result['appat'].'</a></h3>
              <div class="d-flex">
                <div class="pricing">
                  <p class="price"><span>'.$result['nombreevento'].'</span></p>
                </div>
                <div class="rating">
                  <p class="text-right">
                    <span>'.$result['fechaevento'].'</span>
                  </p>
                </div>
              </div>
              <hr>
            </div>
          </div>
        </div>

      ';
    }
    die(json_encode($vista_mesas));
    break;

  default:
    // code...
    break;
}
