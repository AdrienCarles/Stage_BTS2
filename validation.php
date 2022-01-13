<?php
    require('init.php');//initialisation VITAL!!!!
    session_start(); //demarage des sessions

    $qte = isset($_POST['qte']) ? $_POST['qte'] : '';

    $produit = isset($_SESSION['produit']) ? $_SESSION['produit'] : ''; //récupération des objets contenus dans la session 
    $famille = isset($_SESSION['famille']) ? $_SESSION['famille'] : '';
    $image = isset($_SESSION['image']) ? $_SESSION['image'] : '';
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
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
    <h1>Validation</h1>
    <?php
        echo("<p class=''>".$produit->get_lib_produit()."</p>");
        $img_produit = $produit->get_id_produit();
        echo("<img class=' ' src='./img/Produits/$img_produit.jpg' alt='produit'>");
        $lib_famille = $famille->get_lib_famille();
        $img_visuel = $image->get_id_image();
        echo("<img class=' ' src='./img/Visuel/$lib_famille/$img_visuel.jpg' alt='produit'>");
        if($message === ''){
            
        }
        
    ?>
</body>
</head>