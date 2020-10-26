<?php
  include 'functions.php';
  session_start();
  $_SESSION['uname'] = $_POST['uname'];
  $_SESSION['pwd'] = $_POST['pwd'];
  $_SESSION['login'] = true;
  header("location: home.php");
 ?>
