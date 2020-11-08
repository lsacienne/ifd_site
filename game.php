<!DOCTYPE html>
<html lang="en" dir="ltr" class="cover">
  <head>
    <meta charset="utf-8">
    <title>Jeu</title>
  </head>
  <body>
    <?php
      //This file is used to display a specific game with its id sent through the url
      include 'header.php';
      //check if the id was sent through succesfully
      if (!(isset($_GET['id']))){
        echo("<h1>Cette page n'existe pas</h1>");//to fix
      }else{
        echo'<div class="corps"><div class="page_jeux">';

        //get the game's data from the table

        $id = $_GET['id'];
        $db = new PDO( "mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
        $sql = "SELECT id,nom,editeur,prix,description,picture FROM jeux WHERE id='$id';";
        $req = $db->prepare($sql);
        $req->execute();
        $game = $req->fetch();
        //check is the game exists (==if the id was indeed the id of a game)
        if($game){

          //display the informations about the game
          echo('<div class="presentation_generale">');
          echo("<div class='titre'>".$game['nom']."</div><br/>");
          echo('</br><img src="data:image/jpeg;base64, '.base64_encode($game['picture']).'" height="120" name="image"/><br/>');
          echo("<b>Editeur: </b>".$game['editeur']."<br/>");
          echo("<b>Prix: </b>".$game['prix']." €<br/>");
          echo("<b>Description: </b>".$game['description']."<br/>");

          //get some data for all the review for the game
          //get the categories
          $categories = $db->prepare("SELECT nom_categorie FROM link_categorie_jeux INNER JOIN categorie ON categorie.id = link_categorie_jeux.id_categorie WHERE link_categorie_jeux.id_jeux =".$game['id']);
          $categories->execute();
          $categorie = "";
          $tmp2= $categories->fetch();
          /************Concatenating categories' name**********************/
          while($tmp2){
            $categorie = $categorie . ' / ' . $tmp2['nom_categorie'];
            $tmp2 = $categories->fetch();
          }
          echo("<b>Catégories: </b>".$categorie."<br/>");

          $sql = "SELECT critiques.id AS crit_id,critiques.nom AS nom,pseudo,date_crit,note FROM utilisateur INNER JOIN critiques ON utilisateur.id = critiques.id_utilisateur WHERE critiques.id_jeu = $id";
          $req2 = $db->prepare($sql);
          $req2->execute();
          $line = $req2->fetch();
          //display this data in a table
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
          //display an error message if the id was wrong
          echo("<h1>Cette page n'existe pas</h1>");
        }
      }
    ?>
  </body>
</html>
