<?php
  $dbHost = 'localhost';
  $dbUsername = 'macbook';
  $dbPassword = 'Sl0429905#';
  $dbName = 'cms';

  $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>
