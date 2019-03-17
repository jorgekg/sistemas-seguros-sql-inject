<?php
try {
  $conn = new PDO('mysql:host=127.0.0.1;dbname=trab', "root", "root");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

$email = $_GET["email"];
$senha = $_GET["senha"];

$data = $conn->query("SELECT * FROM usuario WHERE email = '". $email ."' and senha = '". $senha ."'");

if (!empty($data->fetchAll())) {
	header("location: ok.php");
} else {
  header("location: login.html");
}
