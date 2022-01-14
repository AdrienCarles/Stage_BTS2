<?php
    require("header.php");
    $commande = isset($_SESSION['commande']) ? $_SESSION['commande'] : '';
    $id_commande = $commande->get_id_commande();
    $produit_image_commandeDAO = new Produit_image_commandeDAO;
    $produit_image_commandes = $produit_image_commandeDAO->findall();

    echo "<h1>Panier de ".$commande->get_prenom_commande()." ".$commande->get_nom_commande()."</h1>";
    
    foreach($produit_image_commandes as $produit_image_commande){
        $famille = new FamilleDAO;
        $famille = $famille->find($produit_image_commande->get_id_famille());

        $id_commande = $commande->get_id_commande();

        echo("<img class=' ' src='./img/Produits/".$produit_image_commande->get_id_produit().".jpg' alt='produit'>");
        echo("<img class=' ' src='./img/Visuel/".$famille->get_lib_famille()."/".$produit_image_commande->get_id_image().".jpg' alt=''>");

    }
    require("footer.php");
?>
