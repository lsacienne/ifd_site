<?php
  session_start();
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  $req = $db->prepare("SELECT id,pseudo,nom FROM utilisateur;");
  $req->execute();
  $line = $req->fetch();
  while(!($line['pseudo']==$_POST['uname'] && $line['nom']==$_POST['pwd']) && $line){
    $line = $req->fetch();
  }
  if($line){
    $_SESSION['id'] = $line['id'];
    $_SESSION['uname'] = $_POST['uname'];
    $_SESSION['login'] = true;
    header("location: home.php");
  }else{
    header("location: login.php?failed");
  }
 ?>
