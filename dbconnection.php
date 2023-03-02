<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

$dotenv->load();

// $port = $_ENV['DB_PORT'];
$hs = $_ENV['DB_HOST'];
$usr= $_ENV['DB_USERNAME'];
$ps= $_ENV['DB_PASSWORD'];
$db= $_ENV['DB_NAME'];
$conn = mysqli_connect("$hs","$usr","$ps","$db");   
?>