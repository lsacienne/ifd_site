<?php
//supprimer réponses,critiques,upvotes,amis
session_start();
include 'print_comment.php';
if($_GET['confirm']!=1){//silly security measure to avoid deleting the account uppon simply entering the page
  header('location: home.php');
}else{
  $id = $_SESSION['id'];
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");

  //delete all user related comments
  deleteComsFromUser($id,NULL,$db);

  //delete all user related critics
  $sql = 'DELETE FROM critiques WHERE id_utilisateur='.$id;
  $req = $db->prepare($sql);
  $req->execute();

  //delete all user related upvotes/downvotes
  $sql = 'DELETE FROM link_utilisateur_score WHERE id_utilisateur='.$id;
  $req = $db->prepare($sql);
  $req->execute();

  //delete all user related friendship and messages
  $sql = 'SELECT id FROM amis WHERE id1='.$id.' OR id2= '.$id;
  $req = $db->prepare($sql);
  $req->execute();
  $amis = $req->fetch();
  while($amis){
    $db->query("DELETE FROM messages WHERE id_amis =".$amis['id']);
    $db->query("DELETE FROM amis WHERE id =".$amis['id']);
    $amis = $req->fetch();
  }

  //Delete the user
  $sql = 'DELETE FROM utilisateur WHERE id='.$id;
  $req = $db->prepare($sql);
  $req->execute();
  header('location: logout.php');

}
?>
