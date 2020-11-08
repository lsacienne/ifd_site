<?php
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");

  $nom = $_POST['nom'];

  $sql = "SELECT * FROM categorie WHERE nom_categorie = '$nom'";
  echo($sql);
  $req = $db->prepare($sql);
  $req->execute();
  $out = $req->fetch();
  if($out){
    header('location: input_game.php?fail3');
  }else{
    $sql = "INSERT INTO categorie(nom_categorie) VALUES ('$nom')";
    $req = $db->prepare($sql);
    $req->execute([$photo]);
    header('location: input_game.php?succ');
  }
?>
