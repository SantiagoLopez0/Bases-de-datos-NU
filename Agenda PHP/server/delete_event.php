<?php
require('./conector.php');

session_start();

if (isset($_SESSION['username'])) {
  $con = new ConectorBD('localhost', 'primerUSer', '12345');

  if ($con->initConexion('agenda')=='OK') {
    $idEvent = $_POST['id'];

    $sql = "DELETE FROM eventos WHERE id =".$idEvent.";";

    if($con->ejecutarQuery($sql)){
      $response['msg'] = 'OK';
    }
  }
}
echo json_encode($response);

$con->cerrarConexion();

 ?>
