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
              $critic_cap=10;
              #Cette variable place un certain cap définit par les administrateurs du site qui permet de définir à partir de combien de up on considère une critique tendance
              #Ce nombre pourait être généré aléatoirement car il dépend de la fréquence de visite du site, du nombre d'utilisateurs, des habitudes des utilisateurs, etc.
              $date_cap=1; #cette variable est le cap de jour maximum duquel on remonte à partir d'aujourd'hui pour trover des critiques ( on l'augmente si nécessaire)
              $iteration=0; #On va alterner l'augmentation du périmètre de recherche à chaque itération de la boucle : quand itération est pair on augmente le nombre de jours, sur les impairs on diminue le critic cap
              $today = date("Y-m-d"); #la date du jour au format utilisé par MySql
              $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");

              $nb_displayed=0; #variable indiquant le nombre de critiques affichées sur la page, pour le moment on va fixer le nombre de critiques max à 3

              echo'<ul>';
              do{

                  $req_critics = $db->prepare("SELECT link_utilisateur_score.value,date_crit,critiques.content,critiques.nom,jeux.nom,pseudo  FROM critiques INNER JOIN link_utilisateur_score ON link_utilisateur_score.id_critiques = critiques.id INNER JOIN utilisateur ON link_utilisateur_score.id_utilisateur = utilisateur.id INNER JOIN jeux ON critiques.id_jeu = jeux.id;");
                  $req_critics->execute();
                  $line = $req_critics->fetch();
                  while($line && $nb_displayed<3){
                      if($line['date_crit']>$today-$date_cap && $line['link_utilisateur_score.value']>$critic_cap){
                          $crit_display = str_split($line['critiques.content'],200);
                          echo '
                        <li class="rubrique">
                            <div class="titre_rubrique">',$line['critiques.nom'],'</div><br>
                            <div class="nom_auteur">par ',$line['pseudo'],'</div><br>
                            <p class="texte_corps">',$crit_display[0];
                          if(strlen($line['critiques.content'])>200){
                              echo '
                                ...<a href=#><br> Lire la suite</a></p>
                            </li>
                          ';
                          } else{
                              echo '</p></li>';
                          }
                          $nb_displayed++;
                      }
                      $nb_displayed=5;
                      $line = $req_critics->fetch();
                  }
                  if($iteration%2 ==0){
                      $date_cap+=7;
                  } else{
                      $critic_cap-=5;
                  }

                  $iteration++;
              } while($nb_displayed<3);
              echo '</ul>';
          ?>
      </div>

    </body>
</html>
