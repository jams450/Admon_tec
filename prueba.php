<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$result=$_SESSION['cdfi'];
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

$archivo= file_get_contents('cfdi.html');

$archivo=str_replace('{fecha_certificacion}', date("Y-m-d H:i:s"), $archivo);
$archivo=str_replace('{fecha_emision}', date("Y-m-d H:i:s"), $archivo);
$archivo=str_replace('{#}', rand(0, 10), $archivo);

$archivo=str_replace('{rfc}', $result['rfc'], $archivo);


$archivo=str_replace('{productos}', $_SESSION['cdfi_art'], $archivo);

$iva=$_SESSION['cdfi_total']*0.16;
$total=$iva+$_SESSION['cdfi_total'] ;

$archivo=str_replace('{subtotal}', $_SESSION['cdfi_total'], $archivo);
$archivo=str_replace('{iva}', $iva, $archivo);
$archivo=str_replace('{total}', $total, $archivo);

$letras = NumeroALetras::convertir($total, 'pesos', 'centavos');

$archivo=str_replace('{letra}', $letras, $archivo);

// Write some HTML code:
$mpdf->WriteHTML($archivo);

// Output a PDF file directly to the browser
$mpdf->Output('CFDI.pdf', \Mpdf\Output\Destination::FILE);
