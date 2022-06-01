<?php

  $server = 'localhost';
 // $username = 'root';
 // $password = '!JesusHT12015';
//  $database = 'database';
  $username = 'id19025691_root';
  $password = '!Root1234567'; 
  $database = 'id19025691_blog2watch';

  try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
  } catch (PDOException $e) {
    die('Conexión fallida: ' . $e->getMessage());
  }
?>