<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/src/model/conexion.php");
    $operacion = $_POST['operacion'];
    switch ($operacion) {
      case 'alta':
        $comprobacion_correo=$conexion->query("select correo from clientes where correo='".$_POST['correo']."'");

        if ($result=$comprobacion_correo->fetch_assoc()) {
            $msj="correo_mal";
        } else {
            $stmt=$conexion->prepare("insert into clientes (nombre,appat,apmat,rfc,telefono,correo,passwd,calle,noext,noint,colonia,iddelegacion) values (?,?,?,?,?,?,?,?,?,?,?,?)");
            echo $stmt->error;
            $stmt->bind_param("sssssssssssi", $_POST['nombre'], $_POST['appat'], $_POST['apmat'], $_POST['rfc'], $_POST['telefono'], $_POST['correo'], $_POST['passwd'],
              $_POST['calle'], $_POST['noext'], $_POST['noint'], $_POST['colonia'], $_POST['iddelegacion']);
            $stmt->execute();

            if ($stmt->affected_rows) {
                $msj="exito";
                session_start();
                $_SESSION['id_sesion_cliente']=$stmt->insert_id;
                $_SESSION['nombre_cliente']=$_POST['nombre'];
                $_SESSION['appat_cliente']=$_POST['appat'];
            } else {
                $msj="error";
            }
            $stmt->close();
        }
        break;

      case 'login':
        $comprobacion_usuario=$conexion->query("select * from clientes where nombre='".$_POST['nombre_login']."' and passwd = '".$_POST['password_login']."' ");
        if ($result=$comprobacion_usuario->fetch_assoc()) {
            $msj="exito";
            session_start();
            $_SESSION['id_sesion_usuario']=$result['idusuario'];
            $_SESSION['nombre_usuario']=$result['username'];
            $_SESSION['username_usuario']=$result['nombre'];
            $_SESSION['appat_usuario']=$result['appat'];
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
