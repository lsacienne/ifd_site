<?php
  session_start();
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  $userid = $_SESSION['id'];
  $replyid = $_GET['id'];
  $content = str_replace('\'','\'\'',$_POST['input']);
  $sql = 'SELECT id_critiques FROM reponses WHERE id='.$replyid;
  $req = $db->prepare($sql);
  $req->execute();
  $result = $req->fetch();
  $criticid = $result['id_critiques'];
  $sql = "INSERT INTO reponses(content,id_auteur,id_reponse,id_critiques) VALUES ('$content',$userid,$replyid,$criticid);";
  $req = $db->prepare($sql);
  $req->execute();
  header("location: critique.php?id=".$criticid);
?>
