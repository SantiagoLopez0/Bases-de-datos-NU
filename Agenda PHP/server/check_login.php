<?php

require('conector.php');
  $user = $_POST['username'];
  $pwd = $_POST['password'];

  $con = new ConectorBD('localhost','primerUSer','12345');

  //$response['conexion'] = $con->initConexion('agenda');

  if ($con->initConexion('agenda')=='OK') {
    if(isset($user)){
      $resultado_consulta = $con->consultar(['usuarios'],
        ['email', 'password'], 'WHERE email="'.$user.'"');

        if ($resultado_consulta->num_rows != 0) {
          $fila = $resultado_consulta->fetch_assoc();
          if (password_verify($pwd, $fila['password'])) {
            $response['acceso'] = 'concedido';
            //session_start();
            //$_SESSION['username']=$fila['email'];
          }else {
            $response['motivo'] = 'Contraseña incorrecta';
            $response['acceso'] = 'rechazado';
          }
        }else{
          $response['motivo'] = 'Email incorrecto';
          $response['acceso'] = 'rechazado';
        }
    }else {
      $response['motivo'] = 'No hay variables';
    }
  }

 echo json_encode($response);

 $con->cerrarConexion();



 ?>
