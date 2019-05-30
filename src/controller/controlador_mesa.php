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
            /*$fechacierre=date('Y-m-d', strtotime($datos_evento['fechacierre']. ' + 7 days'));
            $fechaenvio=date('Y-m-d', strtotime($fechacierre.' + 7 days'));;*/

            $stmt=$conexion->prepare("insert into eventos (idtipoevento,idcliente,fechaevento) values (?,?,?)");
            echo $_POST['idtipoevento'];
            echo $_POST['fechaevento'];
            echo $_SESSION['id_sesion_cliente'];
            //echo $stmt->error;
            $stmt->bind_param("iis", $_POST['idtipoevento'], $_SESSION['id_sesion_cliente'], $_POST['fechaevento']);
            $stmt->execute();
            echo $stmt->error;

            if ($stmt->affected_rows) {
                $msj="exito";

                $_SESSION['id_sesion_cliente']=$stmt->insert_id;
                $_SESSION['nombre_cliente']=$result['nombre'];
                $_SESSION['appat_cliente']=$result['appat'];
            } else {
                $msj="error";
            }
            $stmt->close();
        //}
        break;

      case 'producto':
        $eventos=$conexion->query(" select idarticulo,nombre, categoria, precio from articulos inner join categoria_articulo
                               on categoria_articulo.idcategoria=articulos.idcategoria where idarticulo= " .$_POST['id']);
        while ($result=$eventos->fetch_assoc()) {
            $salida='
          <tr class="text-center">
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
