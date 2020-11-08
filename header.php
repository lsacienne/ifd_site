<link rel="stylesheet" type="text/css" href="style_site.css">
<div id="header">

  <?php
    //This file is included in almost every other file. It check if the user is logged in and sent it back to the login page if not.
    //It also display the username, as well as a menu to navigate through the website, and a global search bar.
    session_start();
    //check if the user is logged in
    if($_SESSION['login']){
      /***********Friends system********************/
      include 'usert.php';
      //side menu, logout button and search bar
      echo '
        <nav>
            <ul>
                <li><a href="#"><img src="arts/menus/menus_icone.png" width="50"> </a>
                  <ul class="sous">
                    <li><div class="title">Jeux</div></li>
                    <li><a href="games_display.php">Tous les jeux</a></li>
                    <li><a href="random.php?content=1">Découvrir un jeu</a></li>
                    <li><a href="#">Rechercher un jeu</a></li>
                    <li><a href="input_game.php">Ajouter un jeu</a></li>

                    <li><div class="title">Critiques</div></li>
                    <li><a href="last.php">Dernière critique</a></li>
                    <li><a href="random.php?content=2">Critique aléatoire</a></li>
                    <li><a href="home.php">Critiques tendances</a></li>
                    <li><a href="critics_input.php">Ajouter une critique</a></li>

                    <li><div class="title">'.$_SESSION['pseudo'].'</div></li>
                    <li><a href="profile.php?id='.$_SESSION['id'].'">Profil</a></li>
                    <li><a href="stats.php">Statistiques du site</a></li>
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
             <input name="recherche" type="text" placeholder="Rechercher un jeu ou un utilisateur..."/>
             <button type="submit">Rechercher</button>
         </form>
        ';
    }else{
      header('location: login.php');
    }
  ?>
</div>
