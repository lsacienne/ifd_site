<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="style_site.css">
  <html lang="fr" dir="ltr" class="cover">

    <head>
      <meta charset="utf-8">
      <title>Homepage</title>
    </head>
    <body>

      <?php
        include 'header.php';
      ?>
      <div class="corps">
          <div class="titre_page">Tendances</div>
          <?php
              $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");

              $nb_displayed=0; #variable indiquant le nombre de critiques affichées sur la page, pour le moment on va fixer le nombre de critiques max à 3

              echo'<ul class="home">';

              $req_critics = $db->prepare("SELECT critiques.id AS crit, date_crit,SUM(link_utilisateur_score.value) AS up,critiques.content AS contenu,critiques.nom AS nom_critique,jeux.nom AS nom_jeu,pseudo
FROM critiques INNER JOIN link_utilisateur_score ON critiques.id = link_utilisateur_score.id_critiques INNER JOIN utilisateur ON critiques.id_utilisateur = utilisateur.id INNER JOIN jeux ON critiques.id_jeu = jeux.id
GROUP BY critiques.id ORDER BY date_crit DESC, up DESC");

              $req_critics->execute();
              $line = $req_critics->fetch();
              while($line && $nb_displayed<3){
                  $crit_display = str_split($line['contenu'],200);
                  echo '
                <li class="rubrique">
                    <div class="titre_rubrique"><a href="critique.php?id= '.$line['crit'].'"><br>',$line['nom_critique'],'</a></div><br>
                    <div class="nom_auteur">par ',$line['pseudo'],'</div><br>
                    <p class="texte_corps">',$crit_display[0];
                  if(strlen($line['contenu'])>200){
                      echo '
                        ...<a href="critique.php?id= '.$line['crit'].'"><br> Lire la suite</a></p>
                    </li>
                  ';
                  } else{
                      echo '</p></li>';
                  }
                  $nb_displayed++;

                  $line = $req_critics->fetch();
              }

              echo '</ul>';


          ?>
      </div>
    </body>
</html>
