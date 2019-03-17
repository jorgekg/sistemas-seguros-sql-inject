<?php
try {
  $conn = new PDO('mysql:host=127.0.0.1;dbname=trab', "root", "root");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $email = $_GET["email"];
  $senha = $_GET["senha"];

  $data = $conn->prepare("SELECT * FROM usuario WHERE email = :email and senha = :senha");
  $data->bindParam(':email', $email);
  $data->bindParam(':senha', $senha);
  $data->execute();
  if (!empty($data->fetchAll())) {
    header("location: ok.php");
  } else {
    header("location: login.html");
  }
  exit;
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
