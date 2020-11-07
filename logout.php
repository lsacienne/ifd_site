<?php
  //destry the session, effectively logging the user out, and sending him back to the login page
  session_start();
  session_destroy();
  header('location: login.php');
?>
