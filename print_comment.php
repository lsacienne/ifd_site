<link rel="stylesheet" type="text/css" href="style_site.css">
<?php
  function printComs($idCrit,$idPreviousCom,$layer,$db){
    if($idPreviousCom==NULL){
      $sql = 'SELECT reponses.id AS id,content,pseudo,utilisateur.id AS uid FROM reponses INNER JOIN utilisateur ON reponses.id_auteur = utilisateur.id WHERE reponses.id_reponse IS NULL AND reponses.id_critiques ='.$idCrit;
    }else{
      $sql = 'SELECT reponses.id AS id,content,pseudo,utilisateur.id AS uid FROM reponses INNER JOIN utilisateur ON reponses.id_auteur = utilisateur.id WHERE reponses.id_reponse='.$idPreviousCom.' AND reponses.id_critiques ='.$idCrit;
    }
    $req = $db->prepare($sql);
    $req->execute();
    $line= $req->fetch();
    while($line){
      echo(str_repeat("|&nbsp&nbsp&nbsp&nbsp",$layer).'|<br/>');
      echo(str_repeat("|&nbsp&nbsp&nbsp&nbsp",$layer).'<a class="commentaire" href="profile.php?id='.$line['uid'].'"><b>[ '.$line['pseudo'].'</b></a> : <a href="reply_input.php?id='.$line['id'].'">'.$line['content'].'</a><br/>');
      printComs($idCrit,$line['id'],$layer+1,$db);
      $line= $req->fetch();
    }
  }
?>
