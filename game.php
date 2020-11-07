<!DOCTYPE html>
<html lang="en" dir="ltr" class="cover">
  <head>
    <meta charset="utf-8">
    <title>Jeu</title>
  </head>
  <body>
    <?php
      include 'header.php';
      if (!(isset($_GET['id']))){
        echo("<h1>Cette page n'existe pas, sorry bebou</h1>");
      }else{
        echo'<div class="corps"><div class="page_jeux">             
        ';
        $id = $_GET['id'];
        $db = new PDO( "mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
        $sql = "SELECT id,nom,editeur,prix,description FROM jeux WHERE id='$id';";
        $req = $db->prepare($sql);
        $req->execute();
        $game = $req->fetch();
        $nom = $game['nom'];
        $editeur = $game['editeur'];
        $prix = $game['prix'];
        $description = $game['description'];
        if($game){
          echo('<div class="presentation_generale">');
          echo("<div class='titre'>$nom</div><br/>");
          echo("<b>Editeur: </b>$editeur<br/>");
          echo("<b>Prix: </b>$prix €<br/>");
          echo("<b>Description: </b>$description<br/>");
          $sql = "SELECT critiques.id AS crit_id,critiques.nom AS nom,pseudo,date_crit,note FROM utilisateur INNER JOIN critiques ON utilisateur.id = critiques.id_utilisateur WHERE critiques.id_jeu = $id";
          $req2 = $db->prepare($sql);
          $req2->execute();
          $line = $req2->fetch();
          echo"
            </div></br>
            <div class='sous_titre'>Critiques:</div></br>
            <table style=\"border: 1px solid black\">
            <tr>
              <th>Par</th>
              <th>Titre</th>
              <th>Date</th>
              <th>Note</th>
              <th>Lien</th>
            </tr>";
          while($line) {
            echo'
                <tr>
                  <td>' . $line['pseudo'] . '</td>
                  <td>' . $line['nom'] . '</td>
                  <td>' . $line['date_crit'] . '</td>
                  <td>' . $line['note'] . '/10'.'</td>
                  <td><a href="critique.php?id='.$line['crit_id'].'">Cliquez ici!</a></td>
                </tr>';
            $line = $req2->fetch(); //passer à la ligne suivante
          }
          echo "</table>";
          echo'</div></div>';
        }else{
          echo("<h1>Cette page n'existe pas, sorry bebou</h1>");
        }
      }
    ?>
  </body>
</html>
