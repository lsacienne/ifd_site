<?php
$db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
$sql = 'SELECT * FROM link_categorie_jeux WHERE id_categorie = '.$_POST['categorie'].' AND id_jeux = '.$_POST['jeu'];
$req = $db->prepare($sql);
$req->execute();
$out = $req->fetch();
if($out){
  header('location: input_game.php?fail2');
}else{
  $id_jeu = $_POST['jeu'];
  $id_categorie = $_POST['categorie'];
  echo($id_jeu.$id_categorie);
  $sql = "INSERT INTO link_categorie_jeux(id_categorie,id_jeux) VALUES ($id_categorie,$id_jeu)";
  $req = $db->prepare($sql);
  $req->execute();
  header('location: game.php?id='.$id_jeu);
}
?>
