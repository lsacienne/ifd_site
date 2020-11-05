<link rel="stylesheet" type="text/css" href="style_site.css">
<div id="header">

  <?php
    //1Jeux>
    //-Liste des jeux
    //-Découvrir un jeu (affiche un jeu aléatoire)
    //-Rechercher un jeu (recherche approfondi par fourchette de prix, éditeur, ect);
    //-Ajouter un jeu
    //
    //Critiques>
    //-Dernière critique
    //-Critique aléatoire
    //-Critiques tendances (la page home)
    //
    //[PSEUDO]>
    //-profile
    //-se déconnecter
    //-supprimer son compte
    session_start();
    if($_SESSION['login']){
      /***********Friends system********************/
      include 'usert.php';
      echo '
        <nav>
            <ul>
                <li><a href="#"><img src="arts/menus/menus_icone.png" width="50"> </a>
                  <ul class="sous">
                    <li><div class="title">Jeux</div></li>
                    <li><a href="#">Tout les jeux</a></li>
                    <li><a href="random.php?content=1">Découvrir un jeu</a></li>
                    <li><a href="#">Rechercher un jeu</a></li>

                    <li><div class="title">Critiques</div></li>
                    <li><a href="last.php">Dernière critique</a></li>
                    <li><a href="random.php?content=2">Critique aléatoire</a></li>
                    <li><a href="home.php">Critiques tendances</a></li>
                    <li><a href="critics_input.php">Ajouter une critique</a></li>

                    <li><div class="title">'.$_SESSION['pseudo'].'</div></li>
                    <li><a href="profile.php?id='.$_SESSION['id'].'">Profil</a></li>
                    <li><a href="logout.php">Se déconnecter</a></li>
                    <li><a href="delete.php">Supprimer son compte</a></li>
                  </ul>
                </li>
            </ul>
        </nav>
         <form action="logout.php"> <div class="form_header">',
           $_SESSION['pseudo'],'         <input type="submit" class="bouton_log_sign" value="Logout"/> </div> <a href="home.php"><img src="arts/logo/logo_site_ifd.png" id="logo"></a>
         </form>

         <form method="post" action="search.php" class="barre_recherche" >
             <label for="recherche"></label>
             <input name="recherche" type="text" placeholder="Rechercher un jeu..."/>
             <button type="submit">Rechercher</button>
         </form>
        ';
    }else{
      header('location: login.php');
    }
  ?>
</div>
