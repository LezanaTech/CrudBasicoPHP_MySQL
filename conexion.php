<?php

 // Conectar a MySQL
 $conn = mysqli_connect("localhost","root","","crud_php_mysql");


 // Probar la conexion
//  if(mysqli_connect_errno()){
//     echo "Fallo al conectarse a Mysql: " .mysqli_connect_error();
//  }else{
//     echo "Conectado correctamente";
//  }