<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/src/model/conexion.php");

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        $vista_articulos_cfdi="";
        $total=0;
        foreach ($_SESSION['articulos'] as $key => $value) {
            $stmt=$conexion->prepare("insert into regalos_mesa values (NULL,?,?,1)");
            $stmt->bind_param("ii", $_POST['evento'], $value);
            $stmt->execute();
            $stmt->close();

            $eventos=$conexion->query("select * from articulos where idarticulo = ".$value);
            if ($result=$eventos->fetch_assoc()) {
                $total+=$result['precio'];
                $vista_articulos_cfdi.='
              <tr>
                <td style="border:0px">Pieza</td>
                <td style="border:0px">1</td>
                <td style="border:0px">'.$value.'</td>
                <td style="border:0px">'.$result['nombre'].'</td>
                <td style="border:0px">'.$result['precio'].'</td>
                <td style="border:0px">'.$result['precio'].'</td>
              </tr>

              ';
            }


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

        if (isset($_POST['datos'])) {
            $datos=$_POST['datos'];
            $longitud = count($datos);
            $result = [];
            for ($i=0; $i <$longitud ; $i++) {
                $result[$datos[$i]['name']]=$datos[$i]['value'];
            }

            $mpdf = new \Mpdf\Mpdf();

            $archivo= file_get_contents('cfdi.html');

            $archivo=str_replace('{fecha_certificacion}', date("Y-m-d H:i:s"), $archivo);
            $archivo=str_replace('{fecha_emision}', date("Y-m-d H:i:s"), $archivo);
            $archivo=str_replace('{#}', rand(0, 10), $archivo);

            $nombre_completo=$result['nombre'].'   '.$result['appat'].'   '.$result['apmat'];
            $archivo=str_replace('{rfc}', $result['rfc'], $archivo);
            $archivo=str_replace('{cliente}', $nombre_completo, $archivo);
            $archivo=str_replace('{direccion}', $result['direccion_fiscal'], $archivo);


            $archivo=str_replace('{productos}', $vista_articulos_cfdi, $archivo);

            $iva=$total*0.16;
            $total2=$iva+$total ;

            $archivo=str_replace('{subtotal}', $total, $archivo);
            $archivo=str_replace('{iva}', $iva, $archivo);
            $archivo=str_replace('{total}', $total2, $archivo);

            $letras = NumeroALetras::convertir($total2, 'pesos', 'centavos');

            $archivo=str_replace('{letra}', $letras.' 00/100 M.N', $archivo);

            // Write some HTML code:
            $mpdf->WriteHTML($archivo);

            // Output a PDF file directly to the browser
            $mpdf->Output('CFDI.pdf', \Mpdf\Output\Destination::FILE);
        }
        unset($_SESSION['articulos']);
        die(json_encode('exito'));
    }

    break;

  case 'correo':

  // Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
      //Server settings
      // Enable verbose debug output
      $mail->isSMTP();
      $mail->SMTPDebug = 2;
      $mail->SMTPAuth   = true;
      $mail->SMTPSecure = 'ssl';
      $mail->Port       = 465;
      $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers                                     // Set mailer to use SMTP                                   // Enable SMTP authentication
      $mail->Username   = 'jams45072@gmail.com';                     // SMTP username
      $mail->Password   = 'jams45072ande5000';                               // SMTP password
                                      // Enable TLS encryption, `ssl` also accepted
                                       // TCP port to connect to

    //Recipients
      $mail->setFrom('jams45072@gmail.com', 'El detalle perfecto');
      $mail->addAddress($_POST['correo'], 'Cliente');     // Add a recipient

      // Attachments
    $mail->addAttachment('CFDI.pdf');         // Add attachments

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Factura Electronica El detalle perfecto';
      $mail->Body    = 'Factura electronica del El detalle perfecto, por favor no conteste este correo';
      $mail->send();
      die(json_encode('exito'));
  } catch (Exception $e) {
      die(json_encode('error'));
  }
    break;
}
