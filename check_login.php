<?php
  //this file is used to check the credentials of the person trying to log in, and to log him/her in if the password is succesfulle
  session_start();
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  //get every user data
  $req = $db->prepare("SELECT id,pseudo,mdp,nom FROM utilisateur;");
  $req->execute();
  $line = $req->fetch();
  //tries to find a match with username the user entred
  while($line && !($line['pseudo']==$_POST['pseudo'])){
    $line = $req->fetch();
  }
  if($line){
    //if succesfull, verify the password entred by the user
    if(password_verify($_POST['pwd'],$line['mdp'])){
      //if succesfull, the user is logged in, and is id and password are stored in a session variable
      $_SESSION['id'] = $line['id'];
      $_SESSION['pseudo'] = $line['pseudo'];
      $_SESSION['login'] = true;
      header("location: home.php");
    }else{
      //if not succesfull, display an error message saying that the password was wrong
      header("location: login.php?failed2");
    }
  }else{
    //if not succesfull, display an error message saying that the user wasn't found
    header("location: login.php?failed");
  }
 ?>
