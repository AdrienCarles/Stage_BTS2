<?php
    require('header.php');
    $c = $_GET['c'] ?? 0;

    if($c == 0){
        $commande = $_SESSION['commande'];    
        $utilisateur = isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur'] : '';
        $type_commande= isset($_SESSION['type_commande']) ? $_SESSION['type_commande'] : 'W';    
        $prix = isset($_SESSION['total_commande']) ? $_SESSION['total_commande'] : '';
        $mode_paiement = isset($_POST['mode_paiement']) ? $_POST['mode_paiement'] : '';
        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
        $classe = isset($_POST['classe']) ? $_POST['classe'] : '';
        $tel = isset($_POST['tel']) ? $_POST['tel'] : '';
        $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    
    
        $_SESSION['mode_paiement'] = $mode_paiement;
    
        $id_commande = $commande->get_id_commande();
        $commandeDAO = new CommandeDAO; 
        $commande2 = new Commande(array(
            'id_commande' => $commande->get_id_commande(),
            'num_commande' => $type_commande.$commande->get_id_commande(),
            'total_commande' => $prix,
            'nom_commande'=>$nom,
            'prenom_commande'=>$prenom,
            'classe_commande'=>$classe,
            'tel_commande'=>$tel,
            'mail_commande'=>$mail,
            'mode_paiement' => $mode_paiement,
            'id_statut'=>2,
        ));
        $commandeDAO->update($commande2); 
    
        $commande =$commandeDAO->find($id_commande);
        $_SESSION['id_commande'] = $commande->get_id_commande(); 
        $prix_total = 0;
        $produit_image_commandeDAO = new Produit_image_commandeDAO;
        $produit_image_commandes = $produit_image_commandeDAO->find_by_id_commande($id_commande);
        foreach ($produit_image_commandes as $produit_image_commande){
            $produit = new ProduitDAO;
            $produit = $produit->find($produit_image_commande->get_id_produit());
            $famille = new FamilleDAO;
            $famille = $famille->find($produit_image_commande->get_id_famille());
            $image = new ImageDAO;
            $image = $image->find($produit_image_commande->get_id_image());
            $prix_total = $prix_total + $produit->get_prix_produit()*$produit_image_commande->get_quantite();
        }
        if(!empty($utilisateur)){ 
            unset($_SESSION['commande']);
            unset($_SESSION['type_commande']);
            unset($_SESSION['commande']);
            unset($_SESSION['qte']);
            header('Location: administration.php');     
        }else{
            unset($_SESSION['commande']);
            unset($_SESSION['type_commande']);
            unset($_SESSION['commande']);
            unset($_SESSION['qte']);
            header('Location: commande_validation.php?c=1');     
        }   
    }elseif($c == 1){
        ?>
        <h1>Les Silusins vous remercient pour votre commande</h1>
        <div class="container">
            <div class="row card">
                <a class="vert" href='bon_de_commande_telecharger_pdf.php'>Telecharger la facture</a>
            </div>
        </div>
        <?php
    }
    require('footer.php');
?>