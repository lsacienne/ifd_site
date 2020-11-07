<?php
  //This file adds a new account in the database with the data from a post
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  //checking if the input mail/pseudo is allready used
  $req1 = $db->prepare("SELECT pseudo,email FROM utilisateur;");
  $req1->execute();
  $line = $req1->fetch();
  //Goes through the database to find a match
  while($line && ($line['pseudo']!=$_POST['uname'] && $line['email']!=$_POST['mail'])){
    $line = $req1->fetch();
  }
  if($line){
    header("location: create_account.php?failed");//if the variable is set, a message will display on the account creating page
  }else{
    //get the data
    $lastname = $_POST['lastname'];
    $name = $_POST['name'];
    $uname = $_POST['uname'];
    $birthdate = $_POST['birthdate'];
    $bio = str_replace('\'','\'\'',$_POST['bio']);//used so that ' displays properly
    $mail = $_POST['mail'];
    $pwd = password_hash($_POST['pwd'],PASSWORD_DEFAULT,['cost'=>12]);//Hash the password so it's not stored in clear in the data base
    //insert it into the database
    $sql = "INSERT INTO utilisateur (pseudo,mdp,nom,prenom,bio,date_de_naissance,email) VALUES ('$uname','$pwd','$lastname','$name','$bio','$birthdate','$mail');";
    $req2 = $db->prepare($sql);
    $req2->execute();
    header('location: login.php?success');//will display a message on the login page
  }
?>
