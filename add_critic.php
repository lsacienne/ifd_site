<?php

  include 'header.php';
  $idu = $_SESSION['id'];

  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  $idj = $_POST['jeux'];

  $req1 = $db->prepare("SELECT id_utilisteur FROM critiques;");
  $req1->execute();
  $line = $req1->fetch();

  while($line && ($line != '$idu') ){
    $line = $req1->fetch();
  }

  if($line){
    header("location: critics_input.php?failed");
  }else {
    $name = $_POST['titre'];
    $note = $_POST['note'];
    $content = str_replace('\'','\'\'',$_POST['content']);

    $req2 = $db->prepare("INSERT INTO critiques (id_utilisateur,id_jeu,nom,note,content) VALUES ('$idu','$idj','$name','$note','$content');");
    $req2->execute();
    header("location: critics_input.php?success");
    echo("<br/>Votre critique a bien été posté !<br/>");
  }
?>
