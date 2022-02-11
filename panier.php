<?php
    require("header.php");
    $prix_total = 0;
    $commande = isset($_SESSION['commande']) ? $_SESSION['commande'] : '';
    $etape = isset($_GET['etape']) ? $_GET['etape'] : null;
    $commandeDAO = new CommandeDAO;
    $id_commande = $commande->get_id_commande();
    $produit_image_commandeDAO = new Produit_image_commandeDAO;
    $produit_image_commandes = $produit_image_commandeDAO->findall();
    $erreur = 0;
    
    ?>
    <h1>Panier</h1>
    <?php
    if($etape == null){
            ?>    
        <div class="container">
            <div class="row">
                <div class="col-12 panier_creation"><a href="creation.php?etape=1" class="ciel">Continuer mes achats</a></div>
                <h2 class="col-12">Liste des produits sélectionnés</h2>
            </div>
        </div>

        <table>
            <th>Nom Produit</th>
            <th>Produit</th>
            <th>Visuel</th>
            <th>Ref Visuel</th>
            <th>Quantité</th>
            <th>Prix Individuel</th>
            <th>Message</th>
            <th>Action</th>
        <?php
            foreach($produit_image_commandes as $produit_image_commande){
                $id_produit_image_commande = $produit_image_commande->get_id_commande();
                if($id_produit_image_commande == $id_commande){
                    echo("<tr>");
                    $produit = new ProduitDAO;
                    $produit = $produit->find($produit_image_commande->get_id_produit());
                    $famille = new FamilleDAO;
                    $famille = $famille->find($produit_image_commande->get_id_famille());
                    $image = new ImageDAO;
                    $image = $image->find($produit_image_commande->get_id_image());
                    echo("<td>".$produit->get_lib_produit()."</td>");
                    echo("<td><img class=' ' src='./img/Produits/".$produit->get_id_produit().".jpg' alt='produit'></td>");
                    echo("<td><img class='visuel_img' src='./img/Visuel/".$famille->get_lib_famille()."/".$image->get_id_image().".jpg' alt=''></td>");
                    echo("<td>".$famille->get_lib_famille().$image->get_id_image()."</td>");
                    echo("<td>".$produit_image_commande->get_quantite()."</td>");
                    echo("<td>".$produit->get_prix_produit()."</td>");
                    $prix_total = $prix_total +($produit->get_prix_produit()*$produit_image_commande->get_quantite());
                    if($produit_image_commande->get_quantite()< 0){
                        $erreur = 1;
                    }
                    echo("<td>".$produit_image_commande->get_message()  ."</td>");
                    echo("<td><a class='rouge' href='suppression.php?id_produit=".$produit->get_id_produit()."&lib_famille=".$famille->get_lib_famille()."&id_image=".$image->get_id_image()."'>Supprimer</a></td>");
                    echo("</tr>");
                }
            }
            $commande2 = new Commande(array(
                'id_commande' => $commande->get_id_commande(),
                'total_commande' => $prix_total,
            ));
            $commandeDAO->update_prix($commande2); 
            $_SESSION['total_commande'] = $commande2->get_total_commande(); 
        ?>
        </table>
        <p class='text_center'>Prix Total : <?=$_SESSION['total_commande']?>€</p>
        <?php
            if($_SESSION['total_commande'] > 0 && $erreur == 0){
                ?>
                <div class="container">
                    <div class="row">
                        <a class="vert" href='panier.php?etape=1'>Valider la commande</a>
                    </div>
                </div>
                <?php
            }
    }
    if ($etape == 1){
    ?>
    <div class="container">
        <div class="row_centrer">
            <h2 class="">Entrez vos identifiants de commandes</h2>
        </div>
        <div class="row_centrer card">
            <form action="commande_validation.php" method='post'>
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
                <label for="mode_paiement">Mode de paiement :</label><br>
                <input type="radio" name="mode_paiement" id="mode_paiement" value="especes" checked>Espèces<br>
                <input type="radio" name="mode_paiement" id="mode_paiement" value="cheque">Chèque à l'ordre de l'OCCE<br><br>
                <div class="row_centrer">
                    <input class='vert' type="submit" value="Envoyer"><br>
                </div>
            </form>
        </div>
    </div>
<?php
    }    
    require("footer.php");
?>
