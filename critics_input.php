<!DOCTYPE html>
<html lang="en" dir="ltr" class="cover">
  <head>
    <meta charset="utf-8">
    <title>Critiques</title>
  </head>
  <body>
    <?php
      include 'header.php';
    ?>
    <div class="corps">
        <div class="rubrique">
            <div class="titre_rubrique">Saisir critique</div><br/>
            <form method="post" action="add_critic.php">

              <label for="jeux">Jeux:</label>
              <select id="jeux" name="jeux">
              <?php
                $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
                $req = $db->prepare("SELECT nom,id FROM jeux;");
                $req->execute();
                $line = $req->fetch();

                while($line){

                ?>
                <option value="<?php echo $line['id']; ?>"> <?php echo $line['nom']; ?></option>
                <?php
                  $line = $req->fetch();
                }
                ?>
                </select><br/><br/>

                <label for="titre">Titre:</label>
                <input name="titre" type="text" required/> <br /><br />


              <label for="note">Note:</label>
              <select id="note" name="note">
              <?php
              for ($i = 0; $i <= 10; $i++) {
              ?>
              <option value="<?=$i?>"><?=$i?></option>
              <?php
              }?>
              </select><br/><br />


              <label for="content">Avis:</label><br />
                <textarea name="content" cols="40" rows="10"></textarea><br />

                <div class="center"><button type="submit" id="submit_corps">Poster</button></div>
            </form>
            <?php
              if(isset($_GET['failed'])){
                echo("<br/>L'envoie à échoué. Réessayez !<br/>");
              }
            ?>
        </div>
    </div>
  </body>
</html>
