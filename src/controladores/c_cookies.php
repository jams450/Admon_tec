<?php
session_start();
$operacion = $_POST['operacion'];
switch ($operacion) {
  case 'agregar':
    $_SESSION['articulos'][$_POST['articulo']]=$_POST['articulo'];
    die(json_encode('agregado'));
    break;
  case 'quitar':
    unset($_SESSION['articulos'][$_POST['articulo']]);
    die(json_encode('quitado'));
    break;

}
