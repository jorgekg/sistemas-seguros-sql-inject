<?php
try {
  $conn = new PDO('mysql:host=127.0.0.1;dbname=trab', "root", "root");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

$email = $_GET["email"];
$senha = $_GET["senha"];

$istaBranca = ['@', '.', '_', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'x', 'w', 'y', 'z', "1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];

$emailListaBranca = '';
$senhaListaBranca = '';

$emailArray = str_split($email);
for($i = 0; $i < count($emailArray); $i++) {
  foreach($istaBranca as $branca) {
    if ($emailArray[$i] == $branca) {
      $emailListaBranca .= $emailArray[$i];
    }
  }
}

$senhaArray = str_split($senha);
for($i = 0; $i < count($senhaArray); $i++) {
  foreach($istaBranca as $branca) {
    if ($senhaArray[$i] == $branca) {
      $senhaListaBranca .= $senhaArray[$i];
    }
  }
}

if ($senhaListaBranca != $senha || $emailListaBranca != $email) {
  header("location: login.html");
  exit;
}

$data = $conn->query("SELECT * FROM usuario WHERE email = '". $emailListaBranca ."' and senha = '". $senhaListaBranca ."'");

if (!empty($data->fetchAll())) {
	header("location: ok.php");
} else {
  header("location: login.html");
}