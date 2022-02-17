<?php
       require('init.php');//initialisation VITAL!!!!
       session_start(); //demarage des sessions

       $commandeDAO = new CommandeDAO;
       $familleDAO = new FamilleDAO;
       $imageDAO = new ImageDAO;
       $utilisateurDAO = new UtilisateurDAO;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Les Silusins</title>
  <link rel="icon" type="./img/x-icon" href="./img/favicon.ico">
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
<div class="main">
<div class="container-fluid menu">       
  <div class="col-3">
    <a href="index.php"><img class="menu_logo" src="./img/logo.jpg" alt=""></a>
  </div>
  <div class="col-6">
    <h2 class="text_center">Les Silusins</h2>
  </div>
  <div class="col-3 row row_menu">
    <?php
    if (!isset($_SESSION['utilisateur'])){ //Si il n'y a aucun utilisateur connecté
      ?>
      <p class='menu_legende'>Catalogue<a href="catalogue.php"><img class="img_menu " src="./img/catalogue.png" alt=""></a></p>
      <p class='menu_legende'>Création<a href="creation.php"><img class="img_menu " src="./img/gear.png" alt=""></a></p>
      <?php
        if(isset($_SESSION['commande'])){
          ?>
            <p class='menu_legende'>Panier<a href="panier.php"><img class="img_menu " src="./img/cart.png" alt=""></a></p>
          <?php
        }
      ?>
      <p class='menu_legende'>Connexion<a href="connexion.php"><img class="img_menu " src="./img/log-in.png" alt=""></a></p>
      <?php
    }else{
      $role = $_SESSION['utilisateur']->get_id_role();
      if($role == 1){
        ?>   
          <p class='menu_legende'>Catalogue<a href="catalogue.php"><img class="img_menu " src="./img/catalogue.png" alt=""></a></p>
          <p class='menu_legende'>Création<a href="creation.php"><img class="img_menu " src="./img/gear.png" alt=""></a></p>
          <p class='menu_legende'>Connexion<a href="connexion.php"><img class="img_menu " src="./img/log-in.png" alt=""></a></p>
        <?php  
      }
      if($role == 2){
      ?>   
          <p class='menu_legende'>Administration<a href="administration.php"><img class="img_menu " src="./img/book.png" alt=""></a></p>
          <p class='menu_legende'>Création<a href="creation.php"><img class="img_menu " src="./img/gear.png" alt=""></a></p>
          <?php
        if(isset($_SESSION['commande'])){
          ?>
          <p class='menu_legende'>Panier<a href="panier.php"><img class="img_menu " src="./img/cart.png" alt=""></a></p>
        <?php
        }
        ?>
        <p class='menu_legende'>Déconnexion<a href="deconnexion.php"><img class="img_menu " src="./img/deconnexion.png" alt=""></a></p>
      <?php
      }
      if($role == 3){
        ?>
        <p class='menu_legende'>Inscription<a href="inscription.php"><img class="img_menu" src="./img/add-user.png" alt=""></a></p>
        <p class='menu_legende'>Administration<a href="administration.php"><img class="img_menu" src="./img/book.png" alt=""></a></p>
        <p class='menu_legende'>Visuel<a href="visuel_ajout.php"><img class="img_menu" src="./img/add-image.png" alt=""></a></p>
        <p class='menu_legende'>Déconnexion<a href="deconnexion.php"><img class="img_menu " src="./img/deconnexion.png" alt=""></a></p>
        <?php
      }
    }
    ?>
  </div> 
</div>
