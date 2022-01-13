<?php
// Initialisations
require('init.php');
session_start();
$id_produit = isset($_GET['id_produit']) ? $_GET['id_produit'] : '';

if(!isset($_SESSION['produit'])){
  $produit =New ProduitDAO;
  $produit = $produit->find($id_produit);  
  $_SESSION["produit"] = $produit;  
}

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
  <h1>Catalogue</h1>
  <?php include "menu.php"; ?>
  <?php
    if(!isset($_GET['id_produit'])){
      session_unset();
      $produits =New ProduitDAO;
      $produits = $produits->findall();    
      foreach($produits as $produit){
        echo("<p class=''>".$produit->get_lib_produit()."</p>");
        $img = $produit->get_id_produit();
        echo("<a href='catalogue.php?id_produit=".$img."'><img class=' ' src='./img/Produits/$img.jpg' alt='produit'></a>");
        echo("<p class=''>".$produit->get_prix()."€</p>");
      }
    }else{
      $id_produit =$_GET['id_produit'];
      $familles =New FamilleDAO;
      $familles = $familles->findall();
      foreach($familles as $famille){
        $id_famille = $famille->get_id_famille();
        $lib_famille = $famille->get_lib_famille();
        echo $lib_famille."<br>";
        $images = New ImageDAO;
        $images = $images->findall();
        foreach($images AS $image){  
          $img = $image->get_id_image();
          echo("<img class=' ' src='./img/Visuel/$lib_famille/$img.jpg' alt='produit'>");
        }
        echo "<hr>";
      }
    }
  ?>
</body>
</html>
