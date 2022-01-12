<?php
    // Initialisations
    require('init.php');
    $id_produit = isset($_GET['id_produit']) ? $_GET['id_produit'] : null;
    $id_famille = isset($_GET['id_famille']) ? $_GET['id_famille'] : null;
    $id_image = isset($_GET['id_image']) ? $_GET['id_image'] : null;
    $submit = isset($_POST['submit']);
    
    if (!$submit) {
        $produit =New ProduitDAO;
        $produit = $produit->find($id_produit);
    
        $famille =New FamilleDAO;
        $famille = $famille->find($id_famille);
        $lib_famille = $famille->get_lib_famille();
    
        $image =New ImageDAO;
        $image = $image->find($id_image);
        $img = $image->get_id_image();
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
        if (!$submit) {
            echo("<p class=''>".$produit->get_lib_produit()."</p>");
            $img_prod = $produit->get_id_produit();
            echo("<img class=' ' src='./img/Produits/$img_prod.jpg' alt='produit'>");
            echo("<p class=''>".$produit->get_prix()."€</p>");
            echo("<img class=' ' src='./img/Visuel/$lib_famille/$img.jpg' alt='image'>");
    ?>
    <br><br><br>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <label for="message">Votre message personnalisé</label><br>
        <textarea name="message" id="message" cols="30" rows="2"></textarea><br>
        <label for="qte">Quantitée</label><br>
        <input name="qte" id="qte" type="text" value=1 required/><br>
        <input type="submit" name="submit" value="Valider" class="">
    </form>
    <?php 
        }else{
            echo "patate";
        }; 
    ?>
</body>
</html>
