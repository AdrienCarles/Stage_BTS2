<?php
    require("header.php");
    $commande = isset($_SESSION['commande']) ? $_SESSION['commande'] : '';
    $id_commande = $commande->get_id_commande();
    $produit_image_commandeDAO = new Produit_image_commandeDAO;
    echo "<h1>Suppression du produit</h1>";

    // Lecture du formulaire
    $submit = isset($_POST['submit']);
    // Suppression dans la base
    if ($submit) {
        // Formulaire validé : on supprime l'enregistrement
        $id_produit = isset($_POST['id_produit']) ? $_POST['id_produit'] : '';
        $id_image = isset($_POST['id_image']) ? $_POST['id_image'] : '';
        $id_commande = isset($_POST['id_commande']) ? $_POST['id_commande'] : '';
        // Suppression
        $produit_image_commandeDAO->delete($id_produit,$id_image,$id_commande);
        header("Location: panier.php");
    }else{
        $id_produit = isset($_GET['id_produit']) ? $_GET['id_produit'] : '';
        $lib_famille = isset($_GET['lib_famille']) ? $_GET['lib_famille'] : '';
        $id_image = isset($_GET['id_image']) ? $_GET['id_image'] : '';
    }       
    echo ("<img class=' ' src='./img/Produits/".$id_produit.".jpg' alt='produit'>");
    echo ("<img class=' ' src='./img/Visuel/".$lib_famille."/".$id_image.".jpg' alt=''>");
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input name="id_produit" id="id_produit" type="hidden" value="<?php echo $id_produit; ?>" />
    <input name="id_image" id="id_image" type="hidden" value="<?php echo $id_image; ?>" />
    <input name="id_commande" id="id_commande" type="hidden" value="<?php echo $id_commande; ?>" />
    <input type="submit" name="submit" value="Supprimer"/>
</form>
<?php
    require("footer.php");
?>
