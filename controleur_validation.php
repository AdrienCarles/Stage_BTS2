<?php
    require("header.php");
    $date = date('Y/m/d');
    $qte = isset($_POST['qte']) ? $_POST['qte'] : '1';
    $etape = isset($_GET['etape']) ? $_GET['etape'] : '';

    $commande = isset($_SESSION['commande']) ? $_SESSION['commande'] : NULL; //récupération des objets contenus dans la session 
    $produit = isset($_SESSION['produit']) ? $_SESSION['produit'] : ''; //récupération des objets contenus dans la session 
    $famille = isset($_SESSION['famille']) ? $_SESSION['famille'] : '';
    $image = isset($_SESSION['image']) ? $_SESSION['image'] : '';
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';

    $commandeDAO = new CommandeDAO;
    $produit_image_commandeDAO = new Produit_image_commandeDAO;

    //récuperation des données du formulaire
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $classe = isset($_POST['classe']) ? $_POST['classe'] : '';
    $tel = isset($_POST['tel']) ? $_POST['tel'] : '';
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';

    $submit = isset($_POST['submit']);

    $id_produit = $produit->get_id_produit();
    $id_famille = $famille->get_id_famille();
    $id_image = $image->get_id_image();

    if ($submit) {
        $commande = new Commande(array(
            'num_commande'=>NULL,
            'date_commande'=>$date,
            'total_commande'=>NULL,
            'mode_paiement'=>NULL,
            'nom_commande'=>$nom,
            'prenom_commande'=>$prenom,
            'classe_commande'=>$classe,
            'tel_commande'=>$tel,
            'mail_commande'=>$mail,
            'id_user'=>$_SESSION['utilisateur']->get_id_user(),
            'id_statut'=>1,
        ));
        $commandeDAO->insert_commande($commande); 
        if(isset($commande)){ 
            $commandeDAO =New CommandeDAO;
            $commande = $commandeDAO->find_by_nom_prenom_commande($nom,$prenom);  
            $_SESSION["commande"] = $commande;  
            $id_commande = $commande->get_id_commande();
            $quantite = $_SESSION['qte'];
            $produit_image_commande = NEW Produit_image_commande(array(
                'id_produit'=>$id_produit,
                'id_famille'=>$id_famille,
                'id_image'=>$id_image,
                'id_commande'=>$id_commande,
                'quantite'=>$quantite,
                'message'=>$message,
            ));
            $produit_image_commandeDAO->insert_produit_image_commande($produit_image_commande); 
            unset($_SESSION['produit']);
            unset($_SESSION['famille']);
            unset($_SESSION['image']);
            unset($_SESSION['message']);
            unset($_SESSION['qte']);
            header("Location: panier.php"); //Redirection vers le panier
        }
    }
?>
<h1>Validation</h1>
<?php
    if($etape === ''){
        $_SESSION['qte'] = $qte;
        echo ("<h2 class=''>Valider votre produit</h2>");
        echo("<p class=''>".$produit->get_lib_produit()."</p>");
        $img_produit = $produit->get_id_produit();
        echo("<img class=' ' src='./img/Produits/$img_produit.jpg' alt='produit'>");
        $lib_famille = $famille->get_lib_famille();
        $img_visuel = $image->get_id_image();
        echo("<img class=' ' src='./img/Visuel/$lib_famille/$img_visuel.jpg' alt='produit'>");
        if($message === ''){
            echo("<p class=''>Quantité : ".$qte."</p>");
            echo ("<a href='validation.php?etape=1'>Valider</a>");
        }else{
            echo("<p class=''>Quantité : 1</p>");
            echo("<p class=''>Message : ".$message."</p>");
            if($commande == NULL){
                echo ("<a href='controleur_validation.php?etape=1'>Valider</a>");
            }else{
                echo ("<a href='controleur_validation.php?etape=2'>Valider</a>");
            }
        }
    }else{
        if($commande == NULL){
            echo ("<h2 class=''>Veillez entrez les identifiants de la commande</h2>");
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="nom">Nom</label><br>
                <input type="text" name="nom"><br><br>
                <label for="prenom">Prenom</label><br>
                <input type="text" name="prenom"><br><br>
                <label for="classe">Classe</label><br>
                <input type="text" name="classe"><br><br>
                <label for="tel">Téléphone</label><br>
                <input type="text" name="tel"><br><br>
                <label for="mail">Mail</label><br>
                <input type="text" name="mail"><br><br>
                <input type="submit"name="submit" value="Envoyer" />
            </form>
            <?php
        }else{
            $id_commande = $commande->get_id_commande();
            $quantite = $_SESSION['qte'];
            $produit_image_commande = new Produit_image_commande(array(
                'id_produit'=>$id_produit,
                'id_famille'=>$id_famille,
                'id_image'=>$id_image,
                'id_commande'=>$id_commande,
                'quantite'=>$quantite,
                'message'=>$message,
            ));
            $produit_image_commandeDAO->insert_produit_image_commande($produit_image_commande); 
            unset($_SESSION['produit']);
            unset($_SESSION['famille']);
            unset($_SESSION['image']);
            unset($_SESSION['message']);
            unset($_SESSION['qte']);
            header("Location: panier.php"); //Redirection vers le panier
        }
    }
require("footer.php")
?>
