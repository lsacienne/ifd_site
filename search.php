<!DOCTYPE html>
<html lang="en" dir="ltr" class="cover">
  <head>
    <meta charset="utf-8">
    <title>Search</title>
  </head>
  <body>
    <?php
      include 'header.php';
      if(isSet($_POST["recherche"] )){
         $recherche = strtolower($_POST['recherche']);
          $_SESSION['recherche'] = strtolower($_POST['recherche']);
       }
      else $recherche = $_SESSION['recherche'];

      $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");

    ?>
    <div class="corps">
        <h2>Résultats</h2>

        <form name="form1" method="post" action="search.php">
          <strong>Editeurs</strong></br><input type="radio" name="editeur" value="Mattel" > Mattel</br>
          <input type="radio" name="editeur" value="Edge Entertainment" > Edge Entertainment</br></br>
          <strong>Catégories</strong></br><input type="radio" name="categorie" value="Carte" > Carte</br>
          <input type="radio" name="categorie" value="Chance" > Chance</br>
          <input type="radio" name="categorie" value="Humoristique" > Humoristique</br></br>
          <button type="submit" id="submit_corps">Filtrer</button>
        </form></br>

        <form method="post" action="search.php" onChange="submit()">
        <label for="tris">Trier par:</label>
        <select name="tris">
        <option <?php if(empty($_POST['tris']) || $_POST['tris'] == "prix") echo "selected";?> value="prix">prix</option>
        <option <?php if(!empty($_POST['tris']) && $_POST['tris'] == "note") echo "selected";?> value="note">note</option>
        </select><br/><br/>
        </form>
            <?php
            /***********Filtres******************/
            if(isSet($_POST['editeur'])){
              $editeurF = $_POST['editeur'];
            } else $editeurF = NULL;

            if(isSet($_POST['categorie'])){
              $categorieF = $_POST['categorie'];
            } else $categorieF = NULL;


            /***********Tris*********************/
            if(!empty($_POST['tris'])) $t = $_POST['tris'];

            /**************Games sorted by price*******************************************/

            if(empty($t) || $t == "prix"){

              $sql = "SELECT jeux.id AS id,picture,jeux.nom AS nom,prix,editeur,nom_categorie FROM jeux INNER JOIN link_categorie_jeux
              ON jeux.id = link_categorie_jeux.id_jeux INNER JOIN categorie ON categorie.id = link_categorie_jeux.id_categorie
              WHERE ('$recherche' = jeux.nom OR '$recherche' = jeux.editeur OR '$recherche' = categorie.nom_categorie) ORDER BY jeux.prix;";


            }


            /********Games sorted by note**********************/
            if(!empty($t) && $t == "note"){

              $sql = "SELECT DISTINCT jeux.id AS id,picture,jeux.nom AS nom,prix,editeur,nom_categorie FROM jeux INNER JOIN link_categorie_jeux ON jeux.id = link_categorie_jeux.id_jeux
              INNER JOIN categorie ON categorie.id = link_categorie_jeux.id_categorie INNER JOIN critiques ON critiques.id_jeu = jeux.id
              WHERE ('$recherche' = jeux.nom OR '$recherche' = jeux.editeur OR '$recherche' = categorie.nom_categorie)
              ORDER BY (SELECT AVG(note) FROM critiques WHERE critiques.id_jeu = jeux.id) DESC;";
            }
            $jeux = $db->prepare($sql);
            $jeux->execute();
            $line = $jeux->fetch();

        /**************Users query*******************************************/
        $users = $db->prepare("SELECT id,pseudo,nom,prenom FROM utilisateur WHERE
        ('$recherche' = utilisateur.pseudo OR '$recherche' = utilisateur.prenom OR '$recherche' = utilisateur.nom);");
        $users->execute();
        $tmp2 = $users->fetch();

        /******************Displaying results**********************************/
        if($recherche != ""){
        $in = FALSE; //To avoid displaying the same game several times
        $test = NULL; //To avoid displaying the same game several times
        while($line){
            $picture = $line['picture'];
            $nom = $line['nom'];
            $editeur = $line['editeur'];
            $prix = $line['prix'];


            $jeux_id = $line['id']; // Game id

            $filtres = [
               "E" => $editeurF,
               "C" => $categorieF,
            ];


            /************Query for getting the game's categories**************/
            $categories = $db->prepare("SELECT nom_categorie FROM categorie INNER JOIN link_categorie_jeux
            ON categorie.id = link_categorie_jeux.id_categorie INNER JOIN jeux ON link_categorie_jeux.id_jeux = jeux.id
            WHERE jeux.nom = '$nom';");
            $categories->execute();
            $tmp3= $categories->fetch();
            $categorie = $tmp3['nom_categorie'];
            $tmp3 = $categories->fetch();

            /************Concatenating categories' name**********************/
            while($tmp3){
              $categorie = $categorie . ', ' . $tmp3['nom_categorie'];
              $tmp3 = $categories->fetch();
            }

            /*********Query for getting the average note*********************/
              $avgnote = $db->prepare("SELECT DISTINCT AVG(note) as average FROM critiques INNER JOIN jeux
              ON critiques.id_jeu = jeux.id WHERE jeux.nom = '$nom'; ");
              $avgnote->execute();
              $tmp = $avgnote->fetch();

          /************Checking if a game has already been displayed******/
          if( ($test != $nom) ){
            $in = FALSE;
            $test  = $nom;
          }

        /***********Displaying the game********************/

          if((!$in)){
            if($filtres['E'] != NULL OR $filtres['C'] != NULL){
              if($filtres['E'] == NULL) $filtres['E'] = $editeur;
              if($filtres['C'] == NULL) $filtres['C'] = $categorie;
              if(strtolower($filtres['E']) == strtolower($editeur) AND strstr($categorie,$filtres['C']) == TRUE){
                echo('</br><a href="game.php?id='.$jeux_id.'"><img src="data:image/jpeg;base64, '.base64_encode($picture).'" alt="Image" height="80" width = "80"> </a><br/>');
                $in = TRUE;
                echo('<b>'. $nom . '</b>' . ' - ' . round($tmp['average'],1) . '/10' . '</br>');
                echo("Par $editeur - $prix euros</br>");
                echo ("$categorie</br>");
            }
          }else{
            echo('</br></br><a href="game.php?id='.$jeux_id.'"><img src="data:image/jpeg;base64, '.base64_encode($picture).'" alt="Image" height="80" width = "80"> </a><br/>');
            $in = TRUE;
            echo('<b>'. $nom . '</b>' . ' - ' . round($tmp['average'],1) . '/10' . '</br>');
            echo("Par $editeur - $prix euros</br>");
            echo ("$categorie</br>");

          }

          }

          $line = $jeux->fetch();

        }

        /***********Displaying user********************/

        while($tmp2){
          $pseudo = $tmp2['pseudo'];
          $nom = $tmp2['nom'];
          $prenom = $tmp2['prenom'];

          echo '<strong>Utilisateur(s)</strong></br>'
          ?>
          <br /><a href="profile.php?id=<?=$tmp2['id']?>"><?=$pseudo?> </a>
          <?php
          echo ("- $prenom $nom");
          $tmp2 = $users->fetch();
        }
      }
        ?>
    </div>
  </body>
</html>
