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
            $datos_evento=$_POST['fechaevento'];
            $fechacierre=date('Y-m-d', strtotime($datos_evento.' + 7 days'));
            $fechaenvio=date('Y-m-d', strtotime($fechacierre.' + 7 days'));

            if (isset($_SESSION['id_sesion_cliente'])) {
            $stmt=$conexion->prepare("insert into eventos (idtipoevento,idcliente,fechaevento,fechacierre, fechaenvio) values (?,?,?,?,?)");
            echo $_POST['idtipoevento'];
            echo $_POST['fechaevento'];
            echo $fechaenvio;
            echo $fechacierre;
            echo $_SESSION['id_sesion_cliente'];
            //echo $stmt->error;
            $stmt->bind_param("iisss", $_POST['idtipoevento'], $_SESSION['id_sesion_cliente'], $_POST['fechaevento'], $fechacierre,$fechaenvio);
            $stmt->execute();
            echo $stmt->error;

            if ($stmt->affected_rows) {
                $msj="exito";
            } else {
                $msj="error";
            }
            $stmt->close();
          }else{
            $msj="Noconectado";
          }
        //}
        break;

      default:
        // code...
        break;
    }

    $conexion->close();
    die(json_encode($msj));
