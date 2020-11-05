<?php
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  if($_GET['content']==1){
    $sql = 'SELECT id FROM jeux ORDER BY RAND() LIMIT 1';
    $req = $db->prepare($sql);
    $req->execute();
    $out = $req->fetch();
    header('location: game.php?id='.$out['id']);

  }else if($_GET['content']==2){
    $sql = 'SELECT id FROM critiques ORDER BY RAND() LIMIT 1';
    $req = $db->prepare($sql);
    $req->execute();
    $out = $req->fetch();
    header('location: critique.php?id='.$out['id']);

  }else{
    header('location: error.html');
  }
?>
