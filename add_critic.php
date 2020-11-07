<?php
  //this file adds a new critic to the database
  include 'header.php';
  $idu = $_SESSION['id'];

  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  $idj = $_POST['jeux'];

  //check if the user allready posted a review for this game, redirect to the review input page with an error message
  $req1 = $db->prepare("SELECT id_utilisteur FROM critiques;");
  $req1->execute();
  $line = $req1->fetch();

  while($line && ($line != '$idu') ){
    $line = $req1->fetch();
  }

  if($line){
    header("location: critics_input.php?failed");
  }else {
    //Add the the review to the db
    //get the data
    $name = $_POST['titre'];
    $note = $_POST['note'];
    $content = str_replace('\'','\'\'',$_POST['content']);//used so that ' display properly'

    //Insert into the database
    $req2 = $db->prepare("INSERT INTO critiques (id_utilisateur,id_jeu,nom,note,content) VALUES ('$idu','$idj','$name','$note','$content');");
    $req2->execute();
    header('location: profile.php?id='.$_SESSION['id']);//go back to the profile webpage
  }
?>
