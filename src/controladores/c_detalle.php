<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . "/src/model/conexion.php");

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

$id_evento=$_POST['id'];

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
                              inner join eventos on eventos.idevento=mesaderegalos.idevento where mesaderegalos.idevento = ".$id_evento."
                              group by mesaderegalos.idarticulo ");

    $datos_articulos= array();
    while ($result=$eventos->fetch_assoc()) {
        if ($result['estatus']==0) {
            $result['estatus']='NC';
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


    $mpdf = new \Mpdf\Mpdf();

    $archivo= file_get_contents('detalle.html');

    $archivo=str_replace('{titulo}', 'Detalle de Mesa', $archivo);
    $archivo=str_replace('{fechaim}', date("Y-m-d H:i:s"), $archivo);
    $archivo=str_replace('{cl}', $datos_evento['nombre'].'   '.$datos_evento['appat'].'   '.$datos_evento['apmat'], $archivo);
    $archivo=str_replace('{id}', $id_evento, $archivo);

    $archivo=str_replace('{fecha}', $datos_evento['fechaevento'], $archivo);
    $archivo=str_replace('{fechai}', $datos_evento['fechacierre'], $archivo);
    $archivo=str_replace('{fechae}', $datos_evento['fecha_envio'], $archivo);

    $encabezado='

    <th>Producto</th>
    <th>Precio</th>
    <th>Cantidad</th>
    <th>Estatus</th>
    ';
    $lista="";
    for ($i=0; $i < count($datos_articulos); $i++) {
        $lista.= '
          <tr class="text-center">
            <td class="product-name">
              <h3>'.$datos_articulos[$i]['nombre'].'</h3>
              <p>Categoria:    '.$datos_articulos[$i]['categoria'].'</p>
            </td>
            <td class="price">$ '.$datos_articulos[$i]['precio'].'</td>
            <td class="price">'.$datos_articulos[$i]['cantidad'].'</td>
            <td class="total" style="font-size:30px;">'.$datos_articulos[$i]['estatus'].'</td>
          </tr>
        ';
    }

    for ($i=0; $i < count($datos_articulos2); $i++) {
        $lista.='
          <tr class="text-center">
            <td  class="product-name">
              <h3>'.$datos_articulos2[$i]['nombre'].'</h3>
              <p>Categoria:    '.$datos_articulos2[$i]['categoria'].'</p>
            </td>
            <td class="price">$ '.$datos_articulos2[$i]['precio'].'</td>
            <td class="price">'.$datos_articulos2[$i]['cantidad'].'</td>
            <td class="total" style="font-size:30px;">C</td>
          </tr>
        ';
    }

    $archivo=str_replace('{encabezado}', $encabezado, $archivo);
    $archivo=str_replace('{lista}', $lista, $archivo);



    // Write some HTML code:
    $mpdf->WriteHTML($archivo);

    // Output a PDF file directly to the browser
    $mpdf->Output('Detalle_Mesa.pdf', \Mpdf\Output\Destination::FILE);
    die(json_encode($lista));
}
