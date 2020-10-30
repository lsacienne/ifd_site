<link rel="stylesheet" type="text/css" href="style_site.css">
<div id="header">

  <?php
    session_start();
    if($_SESSION['login']){
      echo '
        <nav>
            <ul>
                <li><a href="#"><img src="arts/menus/menus_icone.png" width="50"> </a>
                  <ul class="sous">
                    <li><div class="title">genre</div></li>
                    <li><a href="#">Cartes</a></li>
                    <li><a href="#">apéro</a></li>
                    <li><a href="#">argent</a></li>
                    <li><a href="#">...</a></li>
                    
                    <li><div class="title">durée</div></li>
                    <li><a href="#">5-10 minutes</a></li>
                    <li><a href="#">15-30 minutes</a></li>
                    <li><a href="#">45 minutes - 1 heure</a></li>
                    <li><a href="#">+ de 1 heure</a></li>
                    
                    <li><div class="title">âges</div></li>
                    <li><a href="#">0-3 ans</a></li>
                    <li><a href="#">3-7 ans</a></li>
                    <li><a href="#">7-10 ans</a></li>
                    <li><a href="#">10-13 ans</a></li>
                    <li><a href="#">18 ans et +</a></li>
                  </ul>
                </li>
            </ul>
        </nav>
         <form action="logout.php"> <div class="form_header">',
           $_SESSION['uname'],'         <input type="submit" class="bouton_log_sign" value="Logout"/> </div> <img src="arts/logo/logo_site_ifd.png" id="logo">
         </form> 
        ';
    }else{
      header('location: login.php');
    }
  ?>
</div>