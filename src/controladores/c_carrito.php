<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/src/model/conexion.php");
session_start();

$operacion = $_POST['operacion'];

switch ($operacion) {
  case 'agregar':
    $mensaje="";
    foreach ($_SESSION['articulos'] as $key => $value) {
        $eventos=$conexion->query("select * from articulos where idarticulo = ".$value);
        if ($result=$eventos->fetch_assoc()) {
            if ($result['existencias'] < 1) {
                $mensaje.="El articulo ".$result['nombre']." no tiene existencias\n";
            } else {
                $eventos=$conexion->query("select * from regalos_mesa where idevento = ". $_POST['evento']);
                while ($result2=$eventos->fetch_assoc()) {
                    if ($value == $result2['idarticulo']) {
                        $mensaje.="El articulo ".$result['nombre']." ya ha se regalo\n";
                    }
                }
            }
        }
    }
    if ($mensaje != "") {
        die(json_encode($mensaje));
    } else {
        foreach ($_SESSION['articulos'] as $key => $value) {
            $stmt=$conexion->prepare("insert into regalos_mesa values (NULL,?,?,1)");
            $stmt->bind_param("ii", $_POST['evento'], $value);
            $stmt->execute();
            $stmt->close();

            $stmt=$conexion->prepare('update articulos set existencias = existencias-1 where idarticulo = ?');
            $stmt->bind_param("i", $value);
            $stmt->execute();
            $stmt->close();

            $eventos=$conexion->query("select * from mesaderegalos where idevento = ". $_POST['evento']. " and idarticulo = ".$value);
            if ($eventos->num_rows > 0) {
                $stmt=$conexion->prepare("update mesaderegalos set estatus = 1 where idevento = ? and idarticulo = ? ");
                $stmt->bind_param("ii", $_POST['evento'], $value);
                $stmt->execute();
                $stmt->close();
            }
        }
        unset($_SESSION['articulos']);
        die(json_encode('exito'));
    }

    break;

}
