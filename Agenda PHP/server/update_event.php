<?php
require('./conector.php');

session_start();

if (isset($_SESSION['username'])) {
  $con = new ConectorBD('localhost', 'primerUSer', '12345');

  if ($con->initConexion('agenda')=='OK') {
    $eventId = $_POST['id'];
    $fechaIn = $_POST['start_date'];
    $horaIn = $_POST['start_hour'];
    $fechaFn = $_POST['end_date'];
    $horaFn = $_POST['end_hour'];

    $sql = 'UPDATE eventos SET fecha_inicio = "'.$fechaIn.'", hora_inicio="'.$horaIn.'", fecha_fin="'.$fechaFn.'", hora_fin="'.$horaFn.'" WHERE id = '.$eventId.';';

    if($con->ejecutarQuery($sql)){
      $response['msg'] = "OK";
    }else {
      $response['msg'] = "Error al actualizar registro";
    }

  }else {
    $response['msg'] = "Error en la conexion con la base de datos";
  }
}else {
  $response['msg'] = "No se ha iniciado sesión";
}

echo json_encode($response);

$con->cerrarConexion();


 ?>
