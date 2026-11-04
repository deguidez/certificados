<?php
$hostName = "mysql.famevaco.br";
$userName = "famevaco";
$password = "@DR06788U";
$databaseName = "certificado";

 $conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

?>
