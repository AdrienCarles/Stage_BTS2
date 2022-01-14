<?php
    require("header.php");
    $date = date('Y/m/d');

    $qte = isset($_POST['qte']) ? $_POST['qte'] : '1';
    $etape = isset($_GET['etape']) ? $_GET['etape'] : '';


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
        $prix = $produit->get_prix()*$_SESSION['qte'];  //revoir le calcul du prix
        $commande = new Commande(array(
            'num_commande'=>"W1000", //gerer le numero de commande
            'date_commande'=>$date,
            'total_comande'=>$prix,
            'mode_paiement'=>NULL,
            'nom_commande'=>$nom,
            'prenom_commande'=>$prenom,
            'classe_commande'=>$classe,
            'tel_commande'=>$tel,
            'mail_commande'=>$mail,
            'id_user'=>1,
            'id_statut'=>1,
        ));
        $commandeDAO->insert_commande($commande); 
    }

    if(isset($commande)){ 
        $commande =New CommandeDAO;
        $commande = $commande->find_by_nom_commande($nom);  
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
            echo "<a href='validation.php?etape=1'>Valider</a>";
        }else{
            echo("<p class=''>Quantité : 1</p>");
            echo("<p class=''>Message : ".$message."</p>");
            echo ("<a href='validation.php?etape=1'>Valider</a>");
        }
    }else{
        echo ("<h2 class=''>Veillez entrez vos identifiants de commande</h2>");
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
    }
require("footer.php")
?>
