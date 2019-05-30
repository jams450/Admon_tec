<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/src/model/conexion.php");
    $operacion = $_POST['operacion'];

    switch ($operacion) {
      case 'alta_mesa':
            session_start();
        /*$comprobacion_correo=$conexion->query("select correo from clientes where correo='".$_POST['correo']."'");

        if ($result=$comprobacion_correo->fetch_assoc()) {
            $msj="correo_mal";
        } else {*/
            $datos=$_POST['datos'];
            $longitud = count($datos);
            $result = [];
            for ($i=0; $i <$longitud ; $i++) {
                $result[$datos[$i]['name']]=$datos[$i]['value'];
            }
            $datos_evento=$result['fechaevento'];
            $fechacierre=date('Y-m-d', strtotime($datos_evento.' + 7 days'));
            $fechaenvio=date('Y-m-d', strtotime($fechacierre.' + 7 days'));

          if (isset($_SESSION['id_sesion_cliente'])) {
              $stmt=$conexion->prepare("insert into eventos (idtipoevento,idcliente,fechaevento,fechacierre, fechaenvio) values (?,?,?,?,?)");
              //echo $stmt->error;
              $stmt->bind_param("iisss", $result['idtipoevento'], $_SESSION['id_sesion_cliente'], $result['fechaevento'], $fechacierre, $fechaenvio);
              $stmt->execute();

              if ($stmt->affected_rows) {
                  $id_row=$stmt->insert_id;
                  $msj="exito";
                  for ($i=0; $i < count($_POST['articulo']); $i++) {
                      $stmt2=$conexion->prepare("insert into mesaderegalos values (NULL,?,?,0,1)");
                      $stmt2->bind_param("ii", $id_row, $_POST['articulo'][$i]);
                      $stmt2->execute();
                      $stmt2->close();
                  }
                  die(json_encode($id_row));
              } else {
                  $msj="error";
              }
              $stmt->close();
          } else {
              $msj="Noconectado";
          }
        //}
        break;

      case 'producto':
        $eventos=$conexion->query(" select idarticulo,nombre, categoria, precio from articulos inner join categoria_articulo
                               on categoria_articulo.idcategoria=articulos.idcategoria where idarticulo= " .$_POST['id']);
        while ($result=$eventos->fetch_assoc()) {
            $salida='
          <tr class="text-center" id="'.$result['idarticulo'].'">
            <td class="product-remove"><a href="#" class="quitar" id="remove_'.$result['idarticulo'].'"><span class="ion-ios-close "></span></a></td>
            <td  class="image-prod"><div class="img" style="background-image:url(images/productos/'.$result['idarticulo'].'.jpg);"></div></td>
            <td class="product-name">
              <h3>'.$result['nombre'].'</h3>
              <p>Categoria:    '.$result['categoria'].'</p>
            </td>
            <td class="price">$ <span class="precio_l">'.$result['precio'].'</span></td>
            <td class="quantity">
              1
            </td>
          </tr>

          ';
        }
        $conexion->close();
        die(json_encode($salida));
        break;
    }

    $conexion->close();
    die(json_encode($msj));
