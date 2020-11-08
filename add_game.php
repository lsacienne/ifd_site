<?php
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");

  $sql = 'SELECT * FROM jeux WHERE nom = "'.$_POST['nom'].'"';
  $req = $db->prepare($sql);
  $req->execute();
  $out = $req->fetch();
  if($out){header('location: input_game.php?fail');}
  $name = str_replace('\'','\'\'',$_POST['nom']);
  $editeur = str_replace('\'','\'\'',$_POST['editeur']);
  $prix = $_POST['prix'];
  $photo = file_get_contents($_FILES['photo']['tmp_name']);
  $description = str_replace('\'','\'\'',$_POST['description']);
  $sql = "INSERT INTO jeux(nom,editeur,picture,prix,description) VALUES ('$name','$editeur',?,$prix,'$description')";
  $req = $db->prepare($sql);
  $req->execute([$photo]);
  header('location: games_display.php')
?>
