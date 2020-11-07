<?php
include 'header.php';
$db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");

if($_GET['action'] == "delete"){
  $db->query("DELETE FROM messages WHERE id_amis =".$_GET['id']);
  $db->query("DELETE FROM amis WHERE id =".$_GET['id']);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if($_GET['action'] == "add"){
  $req = $db->prepare("INSERT INTO amis(id1, id2, attente) VALUES (:id1, :id2, :attente); ");
  $req->execute([
    "id1" => $_SESSION['id'],
    "id2" => $_GET['id'],
    "attente" => 1
  ]);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if($_GET['action'] == "accept"){
  $db->query("UPDATE amis SET attente = 0 WHERE id = ".$_GET['id']);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}


 ?>
