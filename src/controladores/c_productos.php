<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/src/model/conexion.php");

$operacion = $_POST['operacion'];
switch ($operacion) {
  case 'buscar':

    $tipo_evento=$_POST['tipo'];
    $sql="";

    if ($tipo_evento != '0') {
        if ($sql == '') {
            $art="where ";
        } else {
            $art=" and ";
        }
        $sql.=$art." eventos.idtipoevento = ".$tipo_evento;
    }

    $eventos=$conexion->query("select nombre,count(mesaderegalos.idarticulo) as cantidad, mesaderegalos.idarticulo  from mesaderegalos
                              inner join eventos on eventos.idevento=mesaderegalos.idevento
                              inner join articulos on articulos.idarticulo=mesaderegalos.idarticulo ".$sql."
                              group by mesaderegalos.idarticulo");
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
                  <p class="price"><span>Cantidad</span></p>
                </div>
                <div class="rating">
                  <p class="text-right">
                    <span>'.$result['cantidad'].'</span>
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

}
