<?php
  //simple request the redirection to get the last entred review
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  $sql = 'SELECT max(id) AS id FROM critiques';//get the max id == the last
  $req = $db->prepare($sql);
  $req->execute();
  $out = $req->fetch();// get the id
  header('location: critique.php?id='.$out['id']);//send to the user to the review page
?>
