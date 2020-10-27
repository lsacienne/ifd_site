<?php
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  $req1 = $db->prepare("SELECT pseudo,email FROM utilisateur;");
  $req1->execute();
  $line = $req1->fetch();
  while(($line['pseudo']!=$_POST['uname'] && $line['email']!=$_POST['mail']) && $line){
    $line = $req1->fetch();
  }
  if($line){
    header("location: create_account.php?failed");
  }else{
    $lastname = $_POST['lastname'];
    $name = $_POST['name'];
    $uname = $_POST['uname'];
    $birthdate = $_POST['birthdate'];
    $bio = str_replace('\'','\'\'',$_POST['bio']);
    $mail = $_POST['mail'];
    $pwd = $_POST['pwd'];
    $sql = "INSERT INTO utilisateur (pseudo,nom,prenom,bio,date_de_naissance,email) VALUES ('$uname','$lastname','$name','$bio','$birthdate','$mail');";
    $req2 = $db->prepare($sql);
    $req2->execute();
    header("location: login.php?success");
  }
?>
