<?php
       require('init.php');//initialisation VITAL!!!!
       session_start(); //demarage des sessions
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Les Silusins</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
  <?php
    if (!isset($_SESSION['utilisateur'])){ //Si il n'y a aucun utilisateur connecté
      ?>    
      <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="creation.php">Création</a></li>
        <li><a href="inscription.php">Inscription</a></li>
        <li><a href="connexion.php">Connexion</a></li>
      </ul>
      <?php
    }else{
      $role = $_SESSION['utilisateur']->get_id_role();
      if($role == 1){
        ?> 
        <p>Utilisateur</p>   
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="deconnexion.php">Deonnexion</a></li>
        </ul>
      <?php
      }
      if($role == 2){
        ?>    
        <p>controleur</p>
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="deconnexion.php">Deonnexion</a></li>
        </ul>
      <?php
      }
      if($role == 3){
        ?>    
        <p>administrateur</p>
        <ul>        
          <li><a href="index.php">Accueil</a></li>
          <li><a href="administration.php">Administration</a></li>
          <li><a href="deconnexion.php">Deonnexion</a></li>
        </ul>
      <?php
      }
    }
       print_r($_SESSION);
  ?>