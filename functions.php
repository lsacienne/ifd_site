<?php
  function loadDb(){
    return new PDO( "mysql:host=localhost;dbname=td_php;charset=utf8","root","");
  }
?>
