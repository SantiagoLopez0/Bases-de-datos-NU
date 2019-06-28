<?php
require('./conector.php');

session_start();

if (isset($_SESSION['username'])) {
  $con = new ConectorBD('localhost', 'primerUSer', '12345');

  if ($con->initConexion('agenda')=='OK') {
    $response['eventos'] = "[";
    $consulta_user = $con->consultar(['usuarios'], ['id'], "WHERE email ='" .$_SESSION['username']."'");
    $filaUser = $consulta_user->fetch_assoc();

    $consulta_eventos = $con->consultar(['eventos'],
    ['titulo', 'fecha_inicio', 'hora_inicio', 'fecha_fin', 'hora_fin', 'FullDay'], "WHERE fk_usuario ='" .$filaUser['id']."'");

    $numRegistros = $consulta_eventos->num_rows;

    if ($numRegistros != 0) {
    while ($filaEvent = $consulta_eventos->fetch_assoc()) {
      $i = 1;
      $titulo = $filaEvent['titulo'];
      $inicio = $filaEvent['fecha_inicio'];
      $fin = $filaEvent['fecha_fin'];

      if($filaEvent['FullDay'] == 1){
        $diaEntero = "true";
      }else{
        $diaEntero = "false";
      }

      $response['eventos'] .= '{
        title  : "'.$titulo.'",
        start  : "'.$inicio.'",
        end    : "'.$fin.'",
        allDay : "'.$diaEntero.'"'
        .'}';
        $i++;

        if($i != $numRegistros){
          $response['eventos'] .= ',';
        }else{
          $response['eventos'] .= ']';
        }
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

 ?>
