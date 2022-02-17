<?php
    require("header.php");
    $c = $_GET['c'] ?? '';
    $commande = $_SESSION['commande'] ?? '';
    $id_commande = $commande->get_id_commande();
    $produit_image_commandeDAO = new Produit_image_commandeDAO;
    $prix = $_GET['prix'] ?? null;
    echo "<h1>Suppression du produit</h1>";
    // Lecture du formulaire
    $submit = isset($_POST['submit']);
    // Suppression dans la base
    if ($submit) {
        // Formulaire validé : on supprime l'enregistrement
        $id_produit = $_POST['id_produit'] ?? '';
        $id_image = $_POST['id_image'] ?? '';
        $id_commande = isset($_POST['id_commande']) ? $_POST['id_commande'] : '';
        $c = isset($_POST['c']) ? $_POST['c'] : '';
        $prix = $_POST['prix'] ?? NULL;
        // Suppression
        $produit_image_commandeDAO->delete($id_produit,$id_image,$id_commande);
        $nb = $produit_image_commandeDAO->count_by_id_commande($id_commande);
        if($nb>0){
            $nouv_prix = $commande->get_total_commande()-$prix;
            $commandeDAO = new CommandeDAO;
            $commande2 = new Commande(array(
                'id_commande' => $id_commande,
                'total_commande' => $nouv_prix,
            ));
            $commandeDAO->update_prix($commande2);
            if ($c == 1){
                header("Location: modification.php?cloture=1&num_commande=".$commande->get_num_commande()."");
            }else{
                header("Location: panier.php");
            }
        }else{
            if ($c == 1){
                $commandeDAO = new CommandeDAO;
                $commandeDAO->delete($id_commande);
                unset($_SESSION['commande']);
                header("Location: administration.php?cloture=1");
            }
            else{
                $commandeDAO = new CommandeDAO;
                $commandeDAO->delete($id_commande);
                unset($_SESSION['commande']);
                header("Location: creation.php");
            }
        }
    }else{
        $id_produit = isset($_GET['id_produit']) ? $_GET['id_produit'] : '';
        $lib_famille = isset($_GET['lib_famille']) ? $_GET['lib_famille'] : '';
        $id_image = isset($_GET['id_image']) ? $_GET['id_image'] : '';
    }   
?>        
<div class="container">
    <div class="card">
        <div class="row creation_row">
            <img class='produit_img' src='./img/Produits/<?=$id_produit?>.jpg' alt='produit'>
            <img class='visuel_img' src='./img/Visuel/<?=$lib_famille?>/<?=$id_image?>.jpg' alt='visuel'>
        </div>
        <br>
        <div class="row creation_row">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input name="id_produit" id="id_produit" type="hidden" value="<?php echo $id_produit; ?>" />
                <input name="c" id="c" type="hidden" value="<?php echo $c; ?>" />
                <input name="id_image" id="id_image" type="hidden" value="<?php echo $id_image; ?>" />
                <input name="id_commande" id="id_commande" type="hidden" value="<?php echo $id_commande; ?>" />
                <input name="prix" id="prix" type="hidden" value="<?php echo $prix; ?>" />
                <input class="rouge" type="submit" name="submit" value="Supprimer"/>
            </form>
        </div>
    </div>
</div>
<?php
    require("footer.php");
?>
