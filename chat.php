<!DOCTYPE html>
<html lang="en" dir="ltr" class="cover">
  <head>
    <meta charset="utf-8">
    <title>Chat</title>
  </head>
  <body>
    <?php
      include 'header.php';
      echo'<div class="corps">';
      $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
      // check if the id of the friendship and the number of message to display was properly mentionned in the url
      if( !( isset( $_GET['id'] ) && isset( $_GET['num'] ) ) ){
        header('location: error.html');
      }
      //check if the user is part of the friendship mentionned in the url
      $req = $db->prepare('SELECT id1,id2,attente FROM amis WHERE amis.id='.$_GET['id']);
      $req->execute();
      $out = $req->fetch();
      if(!($out)){
        //case where the friendship simply wasn't found
        header('location: error.html');
      }else if(($out['id1']==$_SESSION['id'] || $out['id2']==$_SESSION['id']) && $out['attente']==0){
        if($out['id1']==$_SESSION['id']){
          $sender = 0;
          $req = $db->prepare('SELECT pseudo FROM utilisateur WHERE id='.$out['id2']);
          $req->execute();
          $out = $req->fetch();
          $uname = $out['pseudo'];
        }else{
          $sender = 1;
          $req = $db->prepare('SELECT pseudo FROM utilisateur WHERE id='.$out['id1']);
          $req->execute();
          $out = $req->fetch();
          $uname = $out['pseudo'];
        }
        echo('<div id="titre_conversation">Discussion avec '.$uname.'</div><br />');


        //get all the messages from thge friendship mentionned
        $req = $db->prepare("SELECT u1.pseudo AS u1, u2.pseudo AS u2,sender,content,datetime
        FROM utilisateur u1 INNER JOIN amis ON id1=u1.id  INNER JOIN utilisateur u2 ON id2=u2.id
        INNER JOIN messages ON messages.id_amis = amis.id WHERE amis.id = ".$_GET['id']." ORDER BY messages.id desc LIMIT 30");
        $req->execute();
        $out = $req->fetchAll();
        if($out){
          $length = count($out);
          $toDisplay = min($length, $_GET['num']);
          if($toDisplay != $length){
            echo('
              <form method="post" action="chat.php?id='.$_GET['id'].'&num='.min($_GET['num']+10,$length).'">
              <button type="submit" id="submit_corps">Voir plus de messsages précédent</button>
              </form><br />
            ');
          }
          for($i = $toDisplay-1; $i>=0;$i--){
            if($out[$i]['sender']==0){
              echo('<b>['.$out[$i]['u1'].']</b> <small><i>'.$out[$i]['datetime'].'</i></small> >'.$out[$i]['content'].'<br/>');
            }else{
              echo('<b>['.$out[$i]['u2'].']</b> <small><i>'.$out[$i]['datetime'].'</i></small> >'.$out[$i]['content'].'<br/>');
            }
          }
        }else{
          echo('<i>Aucun messages ...</i>');
        }

        echo('
        <br/>
        <form method="post" action="send_text.php?id='.$_GET['id'].'&sender='.$sender.'">
          <label for="input">Message:</label>
          <input type="text" name="input" maxlength="255" size="50">
          <button type="submit" id="submit_corps"> > </button>
        </form>
        ');

      }else{
        //case where the user isn't part of the friendship
        echo('<h1>Vous n\'avez pas accès à cette page</h1>');
      }
    ?>
  </div>
  </body>
</html>
