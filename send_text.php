<?php
  //this file add a new message in the database
  session_start();//so we can get the SESSION variables
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  //get the data
  $id = $_GET['id'];
  $sender = $_GET['sender'];
  echo($sender);
  $content = str_replace('\'','\'\'',$_POST['input']);//used so that ' is displayed propoerly
  //insert it into the database
  $sql = "INSERT INTO messages(id_amis,sender,content) VALUES ('$id','$sender','$content')";
  $req = $db->prepare($sql);
  $req->execute();
  header("location: chat.php?id=".$id."&num=15");//redirect the user to post where the comment is located
?>
