
 <title> PDF </title>
<?php

$archivo=$_GET['archivo'];
header('Content-type: application/pdf');

  header('Content-Disposition: inline; filename="'.$archivo.'.pdf"');
  // The PDF source is in original.pdf
  readfile($_SERVER['DOCUMENT_ROOT'].'/src/controladores/'.$archivo.'.pdf');



 ?>
