<?php
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  $sql = 'SELECT max(id) AS id FROM critiques';
  $req = $db->prepare($sql);
  $req->execute();
  $out = $req->fetch();
  header('location: critique.php?id='.$out['id']);
?>
