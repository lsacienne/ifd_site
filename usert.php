<!DOCTYPE html>
<html lang="en" dir="ltr" class="cover">
  <head>
    <meta charset="utf-8">
    <title>Critiques</title>
  </head>
  <body>
    <?php
      $user_check[] = "";
      $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
      $req = $db->prepare("SELECT * FROM amis WHERE pseudo_1 = :pseudo_1 OR pseudo_2 = :pseudo_2; ");
      $req->execute([
        "pseudo_1" => $_SESSION['pseudo'],
        "pseudo_2" => $_SESSION['pseudo']
      ]);

      $data = $req->fetchAll();

      if($_SESSION['pseudo']){
        $user_check[] = $_SESSION['pseudo'];
      }

    ?>
    <h2>Liste d'amis</h2>

    <?php
      for ($i=0; $i < sizeof($data) ; $i++) {
        if($data[$i]['pseudo_1'] == $_SESSION['pseudo']){
          echo $data[$i]['pseudo_2'] . "<a href='friend_action.php?action=delete&id=".$data[$i]['id']."  '> Supprimer</a>";
          $user_check[] = $data[$i]['pseudo_2'];

          if($data[$i]['attente'] == true)
            echo " (en attente d'être acceptée)</br>";
        }else{
          if($data[$i]['attente'] == false){
            echo $data[$i]['pseudo_1'] . "<a href='friend_action.php?action=delete&id=".$data[$i]['id']." '> Supprimer</a>";
              $user_check[] = $data[$i]['pseudo_1'];
          }
        }
      }
      echo '</br>';
     ?>

    <h2>Demande d'amis</h2>
      <?php
        for ($i=0; $i < sizeof($data) ; $i++) {
          if($data[$i]['attente']== true && $data[$i]['pseudo_2'] == $_SESSION['pseudo']){
            echo $data[$i]['pseudo_1'] . "<a href='friend_action.php?action=accept&id=".$data[$i]['id']." '> Accepter</a> <a href='friend_action.php?action=delete&id=".$data[$i]['id']." '>Refuser</a>";
            $user_check[] = $data[$i]['pseudo_1'];
          }
        }



       ?>


    <h2>Autres utilisateurs</h2>

    <?php
      $req2 = $db->query("SELECT * FROM utilisateur;");
      $data = $req2->fetchALL();

      for ($i=0; $i < sizeof($data) ; $i++) {
        if(!in_array($data[$i]['pseudo'],$user_check)){
          echo $data[$i]['pseudo'] . "<a href='friend_action.php?action=add&pseudo=".$data[$i]['pseudo']." '> Demander en ami</a></br>";
        }
      }


     ?>




  </body>
  </html>
