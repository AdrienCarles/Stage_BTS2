<?php
       require('init.php');//initialisation VITAL!!!!
       session_start(); //demarage des sessions
       print_r($_SESSION);
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
      <ul class="container-fluid menu">
        <div class="nav_right">
          <li><a href="index.php">Accueil</a></li>
        </div>
        <div class="nav_left">
          <li class="li_nav_left"><a href="catalogue.php">Catalogue</a></li>
          <li class="li_nav_left"><a href="creation.php">Création</a></li>
          <li class="li_nav_left"><a href="inscription.php">Inscription</a></li>
          <li class="li_nav_left"><a href="connexion.php">Connexion</a></li>
        </div>
      </ul>
      <?php
    }else{
      $role = $_SESSION['utilisateur']->get_id_role();
      if($role == 1){
        ?> 
        <ul class="container-fluid menu">
          <div class="nav_right">
            <li><a href="index.php">Accueil</a></li>
          </div>
          <div class="nav_left">
            <li><a href="deconnexion.php">Deconnexion</a></li>
          </div>
        </ul>
      <?php
      }
      if($role == 2){
        ?>    
        <ul class="container-fluid menu"> 
          <div class="nav_right">
            <li><a href="index.php">Accueil</a></li>
          </div>
          <div class="nav_left">
            <li><a href="administration.php">Administration</a></li>
            <li><a href="controleur_creation.php">Création</a></li>
            <li><a href="deconnexion.php">Deconnexion</a></li>
          </div>
        </ul>
      <?php
      }
      if($role == 3){
        ?>    
        <ul class="container-fluid menu">       
          <div class="nav_right">
            <li><a href="index.php">Accueil</a></li>
          </div>
          <div class="nav_left">
            <li><a href="administration.php">Administration des commandes</a></li>
            <li><a href="visuel_ajout.php">Gestions des visuels</a></li>
            <li><a href="deconnexion.php">Deconnexion</a></li>
          </div> 
        </ul>
      <?php
      }
    }
  ?>