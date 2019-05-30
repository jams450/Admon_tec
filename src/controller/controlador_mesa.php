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

      default:
        // code...
        break;
    }

    $conexion->close();
    die(json_encode($msj));
