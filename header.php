<link rel="stylesheet" type="text/css" href="style_site.css">
<div id="header">

  <?php
    session_start();
    if($_SESSION['login']){
      echo '
         <form action="logout.php"> <div class="form_header">',
           $_SESSION['uname'],'         <input type="submit" class="bouton_log_sign" value="Logout"/> </div> <img src="arts/logo/logo_site_ifd.png" id="logo">
         </form> 
        ';
    }else{
      header('location: login.php');
    }
  ?>
</div>