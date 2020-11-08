<!DOCTYPE html>
<html lang="en" dir="ltr" class="cover">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      include 'header.php';
      $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
    ?>
    <div class="corps">
    <div class="rubrique">
        <div class="titre_rubrique">ajouter un jeu</div>
        <form method="post" action="add_game.php" enctype="multipart/form-data">
          <label for="nom">Titre:</label>
          <input name="nom" type="text" maxlength="25" required/><br/>

          <label for="photo">Photo(format JPEG):</label>
          <input name="photo" type="file" accept=".jpg,.jpeg"required/><br/>

          <label for="editeur">Editeur:</label>
          <input name="editeur" type="text" maxlength="25" required/><br/>

          <label for="prix">Prix:</label>
          <input name="prix" type="number" step="0.01" required/><br/>

          <label for="description">description:<br/></label>
          <textarea name="description" cols="40" rows="5"></textarea><br/>

          <button type="submit" id="submit_corps">Ajouter le jeu</button>

        </form>
    </div>
    <?php
      if(isset($_GET['fail'])){
        echo('Ce jeu existe deja.');
      }
    ?>
    <div class="rubrique">
        <div class="titre_rubrique">Ajouter une catégorie à un jeu</div>
        <form method="post" action="link_game_category.php">
          <select name="categorie">
            <?php
            $sql = 'SELECT * FROM categorie';
            $req = $db->prepare($sql);
            $req->execute();
              $out = $req->fetch();
                while($out){
                  echo('<option value="'.$out['id'].'">'.$out['nom_categorie'].'</option>');
                  $out = $req->fetch();
                }
            ?>
          </select><br/>
          <select name="jeu">
            <?php
            $sql = 'SELECT id,nom FROM jeux';
            $req = $db->prepare($sql);
            $req->execute();
              $out = $req->fetch();
                while($out){
                  echo('<option value="'.$out['id'].'">'.$out['nom'].'</option>');
                  $out = $req->fetch();
                }
            ?>
          </select><br/><br/>

          <button type="submit" id="submit_corps">Ajouter la catégorie</button>

        </form>
    </div>
    <?php
      if(isset($_GET['fail2'])){
        echo('Cette catégorie est deja assigné');
      }
    ?>
    <div class="rubrique">
        <div class="titre_rubrique">Ajouter une catégorie</div>
        <form method="post" action="add_category.php">

          <label for="nom">Nom:</label>
          <input name="nom" type="text" maxlength="25" required/><br/><br/>

          <button type="submit" id="submit_corps">Ajouter la catégorie</button>

        </form>
        <?php
          if(isset($_GET['fail3'])){
            echo('Cette catégorie existe deja');
          }
          if(isset($_GET['succ'])){
            echo('Catégorie ajoutée avec succès');
          }
        ?>
    </div>

  </div>
  </body>
</html>
