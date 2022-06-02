<?php

  $server = 'localhost';
  //$username = 'root';
  //$password = '!JesusHT12015';
  //$database = 'database';
  $username = 'u515072016_root';
  $password = '!Root123'; 
  $database = 'u515072016_blog2watch';

  try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
  } catch (PDOException $e) {
    die('Conexión fallida: ' . $e->getMessage());
  }
?>