<?php
// Initialisations
require('init.php');

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
          echo("<a href='panier.php?id_produit=".$id_produit."&id_famille=".$id_famille."&id_image=".$img."'><img class=' ' src='./img/Visuel/$lib_famille/$img.jpg' alt='produit'></a>");
        }
        echo "<hr>";
      }
    }
  ?>
</body>
</html>
