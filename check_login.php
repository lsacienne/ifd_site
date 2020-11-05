<?php
  session_start();
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  $req = $db->prepare("SELECT id,pseudo,mdp,nom FROM utilisateur;");
  $req->execute();
  $line = $req->fetch();
  while($line && !($line['pseudo']==$_POST['pseudo'])){
    $line = $req->fetch();
  }
  if($line){
    if(password_verify($_POST['pwd'],$line['mdp'])){
      $_SESSION['id'] = $line['id'];
      $_SESSION['pseudo'] = $_POST['pseudo'];
      $_SESSION['login'] = true;
      header("location: home.php");
    }else{
      header("location: login.php?failed2");
    }
  }else{
    header("location: login.php?failed");
  }
 ?>
