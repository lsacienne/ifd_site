<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Critiques</title>
  </head>
  <body>
    <?php
      include 'header.php';
    ?>
    <h1>Saisir critique</h1><br/>
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
      </select><br/><br/>


      <label for="content">Avis:</label><br /><br />
	    <textarea name="content" cols="40" rows="10"></textarea><br /><br />

      <button type="submit">Poster</button>
    </form>
    <?php
      if(isset($_GET['failed'])){
        echo("<br/>L'envoie à échoué. Vous avez probablement déjà posté une critique sur ce jeu !<br/>");
      }
      else{
        echo("<br/>Votre critique a bien été posté !<br/>");
      }
    ?>
  </body>
</html>
