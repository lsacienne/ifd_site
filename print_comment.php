<link rel="stylesheet" type="text/css" href="style_site.css">
<?php
  //recursive function printing the comments
  function printComs($idCrit,$idPreviousCom,$layer,$db){
    // check if the comments to print are a reply of another comment or not
    if($idPreviousCom==NULL){
      //if it's not, get every comments of the  review
      $sql = 'SELECT reponses.id AS id,content,pseudo,utilisateur.id AS uid FROM reponses INNER JOIN utilisateur ON reponses.id_auteur = utilisateur.id WHERE reponses.id_reponse IS NULL AND reponses.id_critiques ='.$idCrit;
    }else{
      //if it is, get every replies of the comment on this review
      $sql = 'SELECT reponses.id AS id,content,pseudo,utilisateur.id AS uid FROM reponses INNER JOIN utilisateur ON reponses.id_auteur = utilisateur.id WHERE reponses.id_reponse='.$idPreviousCom.' AND reponses.id_critiques ='.$idCrit;
    }
    $req = $db->prepare($sql);
    $req->execute();
    $line= $req->fetch();
    //display every comment, one by one
    while($line){
      echo(str_repeat("|&nbsp&nbsp&nbsp&nbsp",$layer).'|<br/>');
      echo(str_repeat("|&nbsp&nbsp&nbsp&nbsp",$layer).'<a class="commentaire" href="profile.php?id='.$line['uid'].'"><b>[ '.$line['pseudo'].'</b></a> : <a href="reply_input.php?id='.$line['id'].'">'.$line['content'].'</a><br/>');
      //diplay the comment with some | and some tabs so it looks like:
      //
      //  [ User1 : text 1
      //  |    |
      //  |    [ User2 : reply to user 1
      //  |    |    |
      //  |    |    [ User3 : reply to user 2
      //  |
      //  [ User4 : reply to no one, text 2
      //
      printComs($idCrit,$line['id'],$layer+1,$db);//get every reply of the comment and print them
      $line= $req->fetch();
    }
  }

  function deleteComsFromUser($id,$idPreviousCom,$db){
    if($idPreviousCom == NULL){
      $sql ='SELECT id FROM reponses WHERE id_auteur='.$id.' AND id_reponse IS NULL';
    }else{
      $sql ='SELECT id FROM reponses WHERE id_reponse = '.$idPreviousCom;
    }
    $req = $db->prepare($sql);
    $req->execute();
    $line = $req->fetch();
    while($line){
      deleteComsFromUser($id,$line['id'],$db);
      $db->query('DELETE FROM reponses WHERE id='.$line['id']);
      $line= $req->fetch();
    }
  }
?>
