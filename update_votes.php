<?php
  //this file is used to change the value of an upvote/downvote
  session_start();
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  //get the user id and the review id, wich will get it's score updated
  $userid = $_SESSION['id'];
  $critiqueid = $_GET['id'];
  //get the value from the url
  $value = $_GET['value'];
  $sql = 'SELECT * FROM link_utilisateur_score WHERE id_utilisateur = '.$userid.' AND id_critiques='.$critiqueid;
  $req = $db->prepare($sql);
  $req->execute();
  //check if the user allready has a vote on this review and create one if it doesn't exist, unless the value is 0, implying the user wants to delete his vote
  if(!($req->fetch()) && $value!=0){
    $sql = "INSERT INTO link_utilisateur_score(id_utilisateur,id_critiques) VALUES ('$userid','$critiqueid');";
    $req = $db->prepare($sql);
    $req->execute();
  }


  $req_check_upvote = $db->prepare('SELECT value FROM link_utilisateur_score WHERE id_utilisateur='.$userid.' AND id_critiques='.$critiqueid.';');
  $req_check_upvote->execute();
  $value_upvote = $req_check_upvote->fetch();
  if($value_upvote['value']!=$value){
    //if the value isn't 0, change the value of the vote to 1 or -1 depending on the value variable
    $sql = 'UPDATE link_utilisateur_score SET value='.$value.' WHERE id_utilisateur = '.$userid.' AND id_critiques='.$critiqueid;
    $req = $db->prepare($sql);
    $req->execute();
  } else {
    //if the value is 0, delete the vote from the table(will fail if the votes doesn't exist, but it will change nothing);

    $sql = 'DELETE FROM link_utilisateur_score WHERE id_utilisateur = '.$userid.' AND id_critiques='.$critiqueid;
    $req = $db->prepare($sql);
    $req->execute();
  }
  header('location: critique.php?id='.$critiqueid);//return to the review
?>
