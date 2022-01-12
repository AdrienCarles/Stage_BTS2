<?php
// Initialisations
require('init.php');
$id_produit =$_GET['id_produit'];
$id_famille =$_GET['id_famille'];
$id_image =$_GET['id_image'];

$produit =New ProduitDAO;
$produit = $produit->find($id_produit);

$famille =New FamilleDAO;
$famille = $famille->find($id_famille);
$lib_famille = $famille->get_lib_famille();

$image =New ImageDAO;
$image = $image->find($id_image);
$img = $image->get_id_image();
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
        echo("<p class=''>".$produit->get_lib_produit()."</p>");
        $img_prod = $produit->get_id_produit();
        echo("<img class=' ' src='./img/Produits/$img_prod.jpg' alt='produit'>");
        echo("<p class=''>".$produit->get_prix()."€</p>");
        echo("<img class=' ' src='./img/Visuel/$lib_famille/$img.jpg' alt='image'>");
    ?>
</body>
</html>
