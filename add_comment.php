<?php
  //this file add a new comment in the database
  session_start();//so we can get the SESSION variables
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  //get the data
  $userid = $_SESSION['id'];
  $criticid = $_GET['id'];
  $content = str_replace('\'','\'\'',$_POST['input']);//used so that ' is displayed propoerly
  //insert it into the database
  $sql = "INSERT INTO reponses(content,id_auteur,id_critiques) VALUES ('$content','$userid','$criticid')";
  $req = $db->prepare($sql);
  $req->execute();
  header("location: critique.php?id=".$criticid);//redirect the user to post where the comment is located
?>
