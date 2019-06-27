<?php

require('./conector.php');

  $con = new ConectorBD('localhost','root','');

  $response['conexion'] =$con->initConexion('agenda');

  if ($response['conexion']=='OK') {
      $resultado_consulta = $con->consultar(['usuarios'],
      ['email', 'password'], 'WHERE email="'.$_POST['username'].'"');

      /*if ($resultado_consulta->num_rows != 0) {
        $fila = $resultado_consulta->fetch_assoc();
        if (password_verify($_POST['password'], $fila['password'])) {
          $response['msg'] = 'OK';
          //session_start();
          //$_SESSION['username']=$fila['email'];
        }else {
          $response['motivo'] = 'Contraseña incorrecta';
          $response['msg'] = 'rechazado';
        }
      }else{
        $response['motivo'] = 'Email incorrecto';
        $response['msg'] = 'rechazado';
      }*/
      $fila = $resultado_consulta->fetch_assoc();
      $response['ps'] = password_verify($_POST['password'], $fila['password']);
      $response['dir'] = $_POST['password'];
      $response['msg'] = 'OK';
}

echo json_encode($response);

 $con->cerrarConexion();

 ?>
