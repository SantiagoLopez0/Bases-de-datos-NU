<?php

  require('conector.php');

  $con = new ConectorBD('localhost', 'primerUSer', '12345');

  if ($con->initConexion('agenda')=='OK') {
    $conexion = $con->getConexion();

    $insert = $conexion->prepare('INSERT INTO usuarios (email, nombre, password, fecha_nacimiento) VALUES (?,?,?,?)');
    $insert->bind_param("ssss", $email, $nombre, $password, $fecha_nacimiento);

    $email = 'rog34.@gmail.com';
    $nombre = 'Rodrigo Gonzales';
    $password = password_hash("098765tgd", PASSWORD_DEFAULT);
    $fecha_nacimiento = "1998-09-21";
    $insert->execute();

    $email = 'anm_rodriguez@hotmail.com';
    $nombre = 'Ana Maria Rodriguez';
    $password = password_hash("2345t6vbs", PASSWORD_DEFAULT);
    $fecha_nacimiento = "2001-02-15";
    $insert->execute();

    $email = 'santiag0r2@hotmail.com';
    $nombre = 'Santiago López';
    $password = password_hash("456l6wxd1", PASSWORD_DEFAULT);
    $fecha_nacimiento = "1989-11-30";
    $insert->execute();

    echo "Se insertaron los registros exitosamente";

    $con->cerrarConexion();

  }else {
    echo "Se presentó un error en la conexión";
  }






 ?>
