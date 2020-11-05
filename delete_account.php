<?php
//supprimer réponses,critiques,upvotes,amis
session_start();
if($_GET['confirm']!=1){//silly security measure to avoid deleting the account uppon simply entering the page
  header('location: home.php');
}else{
  $id = $_SESSION['id'];
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");

  //delete all user related comments
  $sql = 'DELETE FROM reponses WHERE id_auteur='.$id;
  $req = $db->prepare($sql);
  $req->execute();

  //delete all user related critics
  $sql = 'DELETE FROM critiques WHERE id_utilisateur='.$id;
  $req = $db->prepare($sql);
  $req->execute();

  //delete all user related upvotes/downvotes
  $sql = 'DELETE FROM link_utilisateur_score WHERE id_utilisateur='.$id;
  $req = $db->prepare($sql);
  $req->execute();

  //delete all user related friendship
  //$sql = 'DELETE FROM link_utilisateur_score WHERE id_utilisateur='$id;
  //$req = $db->prepare($sql);
  //$req->execute();

  //Thanos snap that little fucker
  $sql = 'DELETE FROM utilisateur WHERE id='.$id;
  $req = $db->prepare($sql);
  $req->execute();
  header('location: logout.php');

}
?>
