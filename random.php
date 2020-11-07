<?php
  //this file is used to get either a random review or a random game, for the side =bar ine header.php
  //differentiate between a random review and a random game using the content variable in the url
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  //case 1: game
  if($_GET['content']==1){
    $sql = 'SELECT id FROM jeux ORDER BY RAND() LIMIT 1';//get the id of a random game
    $req = $db->prepare($sql);
    $req->execute();
    $out = $req->fetch();
    header('location: game.php?id='.$out['id']);//send the user to the game with the previous id

  }else if($_GET['content']==2){//exactly the same behaviour, with review instead of games
    $sql = 'SELECT id FROM critiques ORDER BY RAND() LIMIT 1';
    $req = $db->prepare($sql);
    $req->execute();
    $out = $req->fetch();
    header('location: critique.php?id='.$out['id']);

  }else{
    header('location: error.html');
  }
?>
