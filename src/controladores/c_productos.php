<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/src/model/conexion.php");
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';


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
    $lista="";
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
              <p class="bottom-area d-flex">
    							<a href="#" id="articulo_'.$result['idarticulo'].'" class="add-to-cart anadir"><span>Añadir al carrito <i class="ion-ios-add ml-1"></i></span></a>
    						</p>
            </div>
          </div>
        </div>

      ';

        if (isset($_POST['pdf'])) {
            $lista.='
          <tr>
          <td style="border:0px">'.$result['idarticulo'].'</td>
          <td style="border:0px">'.$result['nombre'].'</td>
          <td style="border:0px">'.$result['cantidad'].'</td>
          </tr>
        ';
        }
    }

    if (isset($_POST['pdf'])) {
        $encabezado='
        <th>ID</th>
        <th>NOMBRE</th>
        <th>CANTIDAD</th>
      ';

        $mpdf = new \Mpdf\Mpdf();

        $archivo= file_get_contents('lista.html');

        $archivo=str_replace('{titulo}', 'Regalos', $archivo);
        $archivo=str_replace('{fecha}', date("Y-m-d H:i:s"), $archivo);
        $archivo=str_replace('{encabezado}', $encabezado, $archivo);
        $archivo=str_replace('{lista}', $lista, $archivo);


        // Write some HTML code:
        $mpdf->WriteHTML($archivo);

        // Output a PDF file directly to the browser
        $mpdf->Output('Lista_Regalos.pdf', \Mpdf\Output\Destination::FILE);
        die(json_encode('pdf'));
    }
    die(json_encode($vista_mesas));
    break;

}
