<?php
include 'header.php';
$db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");

if($_GET['action'] == "delete"){
  $db->query("DELETE FROM amis WHERE id =".$_GET['id']);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if($_GET['action'] == "add"){
  $req = $db->prepare("INSERT INTO amis(pseudo_1, pseudo_2, attente) VALUES (:pseudo_1, :pseudo_2, :attente); ");
  $req->execute([
    "pseudo_1" => $_SESSION['pseudo'],
    "pseudo_2" => $_GET['pseudo'],
    "attente" => 1
  ]);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if($_GET['action'] == "accept"){
  $db->query("UPDATE amis SET attente = 0 WHERE id = ".$_GET['id']);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}


 ?>
