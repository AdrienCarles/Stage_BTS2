<?php
require("header.php");
$ismessage = isset($_GET['ismessage']) ? $_GET['ismessage'] : '0';

if(!isset($_SESSION['qte'])){
    if($ismessage == 1){
        $qte = 1;
        $_SESSION['qte'] = $qte;
    }else
    $qte = isset($_POST['qte']) ? $_POST['qte'] :  ''; //recuperation de la quantitée ou valeur fixer
    $_SESSION['qte'] = $qte;
}else{
    $qte = $_SESSION['qte'];
}


$etape = isset($_GET['etape']) ? $_GET['etape'] : '0';
$date = date('Y/m/d');

$commandeDAO = new CommandeDAO;
$produit_image_commandeDAO = new Produit_image_commandeDAO;

$utilisateur = isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur'] : NULL; //récupération des objets contenus dans la session 
$commande = isset($_SESSION['commande']) ? $_SESSION['commande'] : NULL; //récupération des objets contenus dans la session 
$produit = isset($_SESSION['produit']) ? $_SESSION['produit'] : ''; //récupération des objets contenus dans la session 
$famille = isset($_SESSION['famille']) ? $_SESSION['famille'] : '';
$image = isset($_SESSION['image']) ? $_SESSION['image'] : '';
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';


?>
<h1>Validation</h1>
<?php

    echo ("<h2 class=''>Valider votre produit</h2>");
    echo("<p class=''>".$produit->get_lib_produit()."</p>");
    $img_produit = $produit->get_id_produit();
    echo("<img class=' ' src='./img/Produits/$img_produit.jpg' alt='produit'>");
    $lib_famille = $famille->get_lib_famille();
    $img_visuel = $image->get_id_image();
    echo("<img class=' ' src='./img/Visuel/$lib_famille/$img_visuel.jpg' alt='produit'>");
    if($etape == 0){
        if($message === ''){
            echo("<p class=''>Quantité : ".$qte."</p>");
            if($commande == NULL){
                echo ("<a href='validation.php?etape=1'>Valider</a>");
            }else{
                echo ("<a href='validation.php?etape=2'>Valider</a>");
            }        
        }else{
            echo("<p class=''>Quantité : ".$qte."</p>");
            echo("<p class=''>Message : ".$message."</p>");
            if($commande == NULL){
                echo ("<a href='validation.php?etape=1'>Valider</a>");
            }else{
                echo ("<a href='validation.php?etape=2'>Valider</a>");
            }
        }
    }
    if($etape == 1){
        if(isset($utilisateur)){
            $id_utilisateur = $utilisateur->get_id_user();
        }else{
            $id_utilisateur = 1;
        }
        if(empty($commande)){
            $commande = new Commande(array(
                'num_commande'=>NULL,
                'date_commande'=>$date,
                'total_commande'=>NULL,
                'mode_paiement'=>NULL,
                'nom_commande'=>NULL,
                'prenom_commande'=>NULL,
                'classe_commande'=>NULL,
                'tel_commande'=>NULL,
                'mail_commande'=>NULL,
                'id_user'=>$id_utilisateur,
                'id_statut'=>1,
            ));
        }
        $commandeDAO->insert_commande($commande); 
        if(isset($commande)){ 
            $commandeDAO = new CommandeDAO;
            $commande = $commandeDAO->find_max_id();
            $_SESSION["commande"] = $commande;  
            $id_commande = $commande->get_id_commande();
            $quantite = $_SESSION['qte'];
            $produit_image_commande = NEW Produit_image_commande(array(
                'id_produit'=>$produit->get_id_produit(),
                'id_famille'=>$famille->get_id_famille(),
                'id_image'=>$image->get_id_image(),
                'id_commande'=>$id_commande,
                'quantite'=>$quantite,
                'message'=>$message,
            ));
            $produit_image_commandeDAO->insert_produit_image_commande($produit_image_commande); 
            unset($_SESSION['produit']);
            unset($_SESSION['famille']);
            unset($_SESSION['image']);
            unset($_SESSION['message']);
            //unset($_SESSION['qte']);
            header("Location: panier.php"); //Redirection vers le panier
        }
    }
    if($etape == 2){
        $id_commande = $commande->get_id_commande();
            $quantite = $_SESSION['qte'];
            $produit_image_commande = new Produit_image_commande(array(
                'id_produit'=>$produit->get_id_produit(),
                'id_famille'=>$famille->get_id_famille(),
                'id_image'=>$image->get_id_image(),
                'id_commande'=>$id_commande,
                'quantite'=>$quantite,
                'message'=>$message,
            ));
            $produit_image_commandeDAO->insert_produit_image_commande($produit_image_commande); 
            unset($_SESSION['produit']);
            unset($_SESSION['famille']);
            unset($_SESSION['image']);
            unset($_SESSION['message']);
            //unset($_SESSION['qte']);
            header("Location: panier.php"); //Redirection vers le panier
    }

require("footer.php")
?>