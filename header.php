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
  <?php include "menu.php"; ?>
  <ul>
    <li>Page d'<a href="index.php">accueil</a></li>
    <li><a href="creation.php">Création</a></li>
    <li><a href="panier.php">Panier</a></li>
  </ul>