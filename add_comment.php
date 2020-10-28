<?php
  session_start();
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  $userid = $_SESSION['id'];
  $criticid = $_GET['id'];
  $content = str_replace('\'','\'\'',$_POST['input']);
  $sql = "INSERT INTO reponses(content,id_auteur,id_critiques) VALUES ('$content','$userid','$criticid')";
  $req = $db->prepare($sql);
  $req->execute();
  header("location: critique.php?id=".$criticid);
?>
