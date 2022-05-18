<?php

  $server = 'localhost';
  $username = 'root';
  # Cambiar contraseña o dejar en blanco (NOTA: La contraseña debe ser del usuario root de phpmyadmin o el mysql mariadb)
  //$password = '!JesusHT12015';
  $password = ''; 
  $database = 'database';

  try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
  } catch (PDOException $e) {
    die('Connection Failed: ' . $e->getMessage());
  }
?>