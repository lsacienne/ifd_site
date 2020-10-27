<?php
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  $userid = $_SESSION['id'];
  $critiqueid = $_GET['id'];
  $value = $_GET['value'];
  $sql = 'UPDATE link_utilisateur_score SET value='.$value.'WHERE id_utilisateur ='.$userid.'AND id_critiques='.$critiqueid;
  $req = $db->prepare($sql);
  $req->execute();
?>
