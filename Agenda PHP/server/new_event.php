<?php
require('./conector.php');

session_start();

  if (isset($_SESSION['username'])) {
    $con = new ConectorBD('localhost', 'root', '');
    if ($con->initConexion('agenda')=='OK') {

      $consulta_user = $con->consultar(['usuarios'], ['id'], "WHERE email ='" .$_SESSION['username']."'");
      $filaUser = $consulta_user->fetch_assoc();

      $consulta_eventos = $con->consultar(['eventos'], ['*']);
      $numRegistros = $consulta_eventos->num_rows;

      $data['titulo'] = "'".$_POST['titulo']."'";
      $data['fecha_inicio'] = "'".$_POST['start_date']."'";
      $data['fecha_fin'] = "'".$_POST['end_date']."'";
      $data['hora_fin'] = "'".$_POST['end_hour']."'";
      $data['hora_inicio'] = "'".$_POST['start_hour']."'";
      $data['fk_usuario'] = $filaUser['id'];

      if($_POST['allDay'] == "true"){
        $data['FullDay'] = 1;
      }else {
        $data['FullDay'] = 0;
      }

      if ($con->insertData('eventos', $data)) {
        $resultado = $con->consultar(['eventos'],['MAX(id)']);
        $fila = $resultado->fetch_assoc();
        $response['id']=$fila['MAX(id)'];

        $response['msg']= 'OK';
      }else {
        $response['msg']= 'No se pudo realizar la inserción de los datos.';
      }
    }else {
      $response['msg']= 'Error en la conexion con la base de datos';
    }
  }else {
    $response['msg']= 'No se inicio sesión.';
  }

  echo json_encode($response);

 ?>
