<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/src/model/conexion.php");
    $operacion = $_POST['operacion'];
    switch ($operacion) {
      case 'alta_mesa':
        /*$comprobacion_correo=$conexion->query("select correo from clientes where correo='".$_POST['correo']."'");

        if ($result=$comprobacion_correo->fetch_assoc()) {
            $msj="correo_mal";
        } else {*/
            /*$fechacierre=date('Y-m-d', strtotime($datos_evento['fechacierre']. ' + 7 days'));
            $fechaenvio=date('Y-m-d', strtotime($fechacierre.' + 7 days'));;*/

            $stmt=$conexion->prepare("insert into eventos (idtipoevento,idcliente,fechaevento) values (?,?,?)");
            echo $stmt->error;
            $stmt->bind_param("iis", $_POST['idtipoevento'], $_POST['idcliente'], $_POST['fechaevento']);
            $stmt->execute();

            if ($stmt->affected_rows) {
                $msj="exito";
                /*session_start();
                $_SESSION['id_sesion_cliente']=$result['idcliente'];
                $_SESSION['nombre_cliente']=$result['nombre'];
                $_SESSION['appat_cliente']=$result['appat'];*/
            } else {
                $msj="error";
            }
            $stmt->close();
        //}
        break;

      case 'login':
        $comprobacion_correocliente=$conexion->query("select * from clientes where correo='".$_POST['correo_login']."' and passwd = '".$_POST['passwd_login']."' ");
        if ($result=$comprobacion_correocliente->fetch_assoc()) {
            $msj="exito";
            session_start();
            $_SESSION['id_sesion_cliente']=$result['idcliente'];
            $_SESSION['nombre_cliente']=$result['nombre'];
            $_SESSION['appat_cliente']=$result['appat'];
        } else {
            $msj="error";
        }
        break;

      case 'cambio':
        // code...
        break;

      default:
        // code...
        break;
    }

    $conexion->close();
    die(json_encode($msj));
