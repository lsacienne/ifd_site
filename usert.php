
<link rel="stylesheet" type="text/css" href="style_site.css">
<div class="liste_amis">
    <?php

      $user_check[] = "";
      $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
      $req = $db->prepare("SELECT amis.id AS ida,amis.id1 AS id1,amis.id2 AS id2,u1.pseudo AS pseudo1,u2.pseudo AS pseudo2 FROM amis INNER JOIN utilisateur u1 ON u1.id = amis.id1 INNER JOIN utilisateur u2 ON u2.id = amis.id2 WHERE pseudo1 = :pseudo1 OR pseudo = :pseudo2 ; ");
      $req->execute([
        "pseudo1" => $_SESSION['pseudo'],
        "pseudo2" => $_SESSION['pseudo']
      ]);

      $data = $req->fetchAll();

      if($_SESSION['pseudo']){
        $user_check[] = $_SESSION['pseudo'];
      }

    ?>
    <h2>Liste d'amis</h2>
        <p>
            <?php
              for ($i=0; $i < sizeof($data) ; $i++) {
                if($data[$i]['pseudo_1'] == $_SESSION['pseudo']){
                  echo $data[$i]['pseudo_2'] . "<a href='friend_action.php?action=delete&id=".$data[$i]['ida']."  '> Supprimer</a>";
                  $user_check[] = $data[$i]['pseudo_2'];

                  if($data[$i]['attente'] == true)
                    echo " (en attente d'être acceptée)</br>";
                }else{
                  if($data[$i]['attente'] == false){
                    echo $data[$i]['pseudo_1'] . "<a href='friend_action.php?action=delete&id=".$data[$i]['ida']." '> Supprimer</a>";
                      $user_check[] = $data[$i]['pseudo_1'];
                  }
                }
              }
              echo '</br>';
             ?>
        </p>
    <h2>Demande d'amis</h2>
        <p>
            <?php
            for ($i=0; $i < sizeof($data) ; $i++) {
              if($data[$i]['attente']== true && $data[$i]['pseudo_2'] == $_SESSION['pseudo']){
                echo $data[$i]['pseudo_1'] . "<a href='friend_action.php?action=accept&id=".$data[$i]['ida']." '> Accepter</a> <a href='friend_action.php?action=delete&id=".$data[$i]['id']." '>Refuser</a>";
                $user_check[] = $data[$i]['pseudo_1'];
              }
            }



            ?>
        </p>

    <h2>Autres utilisateurs</h2>
        <p>
            <?php
              $req2 = $db->query("SELECT * FROM utilisateur;");
              $data = $req2->fetchALL();

              for ($i=0; $i < sizeof($data) ; $i++) {
                if(!in_array($data[$i]['pseudo'],$user_check)){
                  echo $data[$i]['pseudo'] . "<a href='friend_action.php?action=add&pseudo=".$data[$i]['pseudo']." '> Demander en ami</a></br>";
                }
              }


             ?>
        </p>
</div>
