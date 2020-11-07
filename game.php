<!DOCTYPE html>
<html lang="en" dir="ltr">
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
        echo("<h1>Cette page n'existe pas, sorry bebou</h1>");//to fix
      }else{
        //get the game's data from the table
        $id = $_GET['id'];
        $db = new PDO( "mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
        $sql = "SELECT id,nom,editeur,prix,description FROM jeux WHERE id='$id';";
        $req = $db->prepare($sql);
        $req->execute();
        $game = $req->fetch();
        //check is the game exists (==if the id was indeed the id of a game)
        if($game){
          //display the informations about the game
          echo('
            <h1>'.$game['nom'].'</h1><br/>
            <b>Editeur: </b>'.$game['editeur'].'<br/>
            <b>Prix: </b>'.$game['prix'].' €<br/>
            <b>Description: </b>'.$game['description'].'<br/>
          ');
          //get some data for all the review for the game
          $sql = "SELECT critiques.id AS crit_id,critiques.nom AS nom,pseudo,date_crit,note FROM utilisateur INNER JOIN critiques ON utilisateur.id = critiques.id_utilisateur WHERE critiques.id_jeu = $id";
          $req2 = $db->prepare($sql);
          $req2->execute();
          $line = $req2->fetch();
          //display this data in a table
          echo"
            <h1>Critiques:</h1>
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
        }else{
          //display an error message if the id was wrong
          echo("<h1>Cette page n'existe pas, sorry bebou</h1>");// to fix
        }
      }
    ?>
  </body>
</html>
