<?php
  //this file adds a new reply (specifically an awnser to a comment allready in the reponses table) into the database
  session_start();
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  //get the data
  $userid = $_SESSION['id'];
  $replyid = $_GET['id'];
  $content = str_replace('\'','\'\'',$_POST['input']);
  //get the id of review the message beeing awnsered is from.
  $sql = 'SELECT id_critiques FROM reponses WHERE id='.$replyid;
  $req = $db->prepare($sql);
  $req->execute();
  $result = $req->fetch();
  $criticid = $result['id_critiques'];
  //insert into the database
  $sql = "INSERT INTO reponses(content,id_auteur,id_reponse,id_critiques) VALUES ('$content',$userid,$replyid,$criticid);";
  $req = $db->prepare($sql);
  $req->execute();
  header("location: critique.php?id=".$criticid);//go to the before mentionned review's page
?>
