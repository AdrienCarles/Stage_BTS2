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
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
  <?php
    if (!isset($_SESSION['utilisateur'])){ //Si il n'y a aucun utilisateur connecté
      ?>
      <ul class="container-fluid menu">
        <div class="nav_right">
          <a href="index.php"><img src="./img/logo.jpg" alt=""></a>
        </div>
        <div class="nav_left">
          <li class="li_nav_left"><p class='menu_legende'>Catalogue</p><a href="catalogue.php"><img class="img_menu " src="./img/catalogue.png" alt=""></a></li>
          <li class="li_nav_left"><p class='menu_legende'>Création</p><a href="creation.php"><img class="img_menu " src="./img/gear.png" alt=""></a></li>
          <?php
            if(isset($_SESSION['commande'])){
              ?>
                <li class="li_nav_left"><p class='menu_legende'>Panier</p><a href="panier.php"><img class="img_menu " src="./img/cart.png" alt=""></a></li>
              <?php
            }
          ?>
          <li class="li_nav_left"><p class='menu_legende'>Connexion</p><a href="connexion.php"><img class="img_menu " src="./img/log-in.png" alt=""></a></li>
        </div>
      </ul>
      <?php
    }else{
      $role = $_SESSION['utilisateur']->get_id_role();
      if($role == 2){
        ?>    
        <ul class="container-fluid menu"> 
          <div class="nav_right">
            <li><a href="index.php"><img src="./img/logo.jpg" alt=""></a></li>
          </div>
          <div class="nav_left">
            <li class="li_nav_left"><p class='menu_legende'>Administration</p><a href="administration.php"><img class="img_menu " src="./img/book.png" alt=""></a></li>
            <li class="li_nav_left"><p class='menu_legende'>Création</p><a href="creation.php"><img class="img_menu " src="./img/gear.png" alt=""></a></li>
            <?php
              if(isset($_SESSION['commande'])){
                ?>
                  <li class="li_nav_left"><p class='menu_legende'>Panier</p><a href="panier.php"><img class="img_menu " src="./img/cart.png" alt=""></a></li>
                <?php
              }
            ?>
            <li class="li_nav_left"><p class='menu_legende'>Déconnexion</p><a href="deconnexion.php"><img class="img_menu " src="./img/deconnexion.png" alt=""></a></li>
          </div>
        </ul>
      <?php
      }
      if($role == 3){
        ?>    
        <ul class="container-fluid menu">       
          <div class="nav_right">
            <li><a href="index.php"><img src="./img/logo.jpg" alt=""></a></li>
          </div>
          <div class="nav_left">
            <li class="li_nav_left"><p class='menu_legende'>Inscription</p><a href="inscription.php"><img class="img_menu" src="./img/add-user.png" alt=""></a></li>
            <li class="li_nav_left"><p class='menu_legende'>Administration</p><a href="administration.php"><img class="img_menu" src="./img/book.png" alt=""></a></li>
            <li class="li_nav_left"><p class='menu_legende'>Visuel</p><a href="visuel_ajout.php"><img class="img_menu" src="./img/add-image.png" alt=""></a></li>
            <li class="li_nav_left"><p class='menu_legende'>Déconnexion</p><a href="deconnexion.php"><img class="img_menu " src="./img/deconnexion.png" alt=""></a></li>
          </div> 
        </ul>
      <?php
      }
    }
  ?>