<?php
require('./conector.php');

session_start();

if (isset($_SESSION['username'])) {
  $con = new ConectorBD('localhost', 'primerUSer', '12345');

  if ($con->initConexion('agenda')=='OK') {
    $response['eventos'] = array();
    $consulta_user = $con->consultar(['usuarios'], ['id'], "WHERE email ='" .$_SESSION['username']."'");
    $filaUser = $consulta_user->fetch_assoc();

    $consulta_eventos = $con->consultar(['eventos'],
    ['id', 'titulo', 'fecha_inicio', 'hora_inicio', 'fecha_fin', 'hora_fin', 'FullDay'], "WHERE fk_usuario ='" .$filaUser['id']."'");

    $numRegistros = $consulta_eventos->num_rows;

    if ($numRegistros != 0) {
      //$i = 1;
    while ($filaEvent = $consulta_eventos->fetch_assoc()) {
      $res['id'] = $filaEvent['id'];
      $res['title'] = $filaEvent['titulo'];

      if($filaEvent['FullDay'] == 1){
        $res['allDay'] = true;
      }else{
        $res['allDay'] = false;
      }

      if($filaEvent['fecha_inicio'] == "00:00:00"){
        $res['start'] = $filaEvent['fecha_inicio'];
      }else {
        $res['start'] = $filaEvent['fecha_inicio']."T".$filaEvent['hora_inicio'];
      }

      if($filaEvent['fecha_fin'] != "0000-00-00"){
        $res['end'] = $filaEvent['fecha_fin']."T".$filaEvent['hora_fin'];;
      }


      array_push($response['eventos'], $res);
    }
  }else {
    $response['eventos'] .= "{}]";
  }
    $response['msg'] = 'OK';
  }else {
    $response['msg'] = 'Error en la conexión con la base de datos.';
  }

}else {
  $response['msg'] = 'No hay sesión abierta.';
}


echo json_encode($response);

//echo json_encode($eventArray);

$con->cerrarConexion();

 ?>
