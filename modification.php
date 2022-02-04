<?php
    require("header.php");
    $num_commande = isset($_GET["num_commande"]) ? $_GET["num_commande"] : '';
    $commandeDAO = new CommandeDAO;
    $produit_image_commandeDAO = new Produit_image_commandeDAO;

    $commande = $commandeDAO->find_num_commande($num_commande);
    $_SESSION['commande'] = $commande;
    $produit_image_commandes = $produit_image_commandeDAO->find_by_id_commande($commande->get_id_commande());
?>
    <h1>Modification de la commande <?=$commande->get_num_commande()?></h1>
    <div class="container">
        <div class="row">
            <form class="col-12 form_modif_commande" action="">
                <label for="nom">NOM</label>
                <input type="text" name="nom" id="nom" value=" <?=$commande->get_nom_commande()?>"><br>
                <label for="nom">PRENOM</label>
                <input type="text" name="prenom" id="prenom" value=" <?=$commande->get_prenom_commande()?>"><br>
                <label for="nom">TEL</label>
                <input type="text" name="tel" id="tel" value=" <?=$commande->get_tel_commande()?>"><br>
                <label for="nom">MAIL</label>
                <input type="text" name="mail" id="mail" value=" <?=$commande->get_mail_commande()?>"><br>
                <input type="submit" class="regulariser" name="submit" value="Modifier" />
            </form>
        </div>
    </div>
    <br>

    <table>
        <th>Nom Produit</th>
        <th>Produit</th>
        <th>Visuel</th>
        <th>Ref Visuel</th>
        <th>Quantité</th>
        <th>Prix Individuel</th>
        <th>Message</th>
        <th colspan="2">Action</th>
        <?php
            foreach($produit_image_commandes as $produit_image_commande){
                echo("<tr>");
                $produitDAO = new ProduitDAO;
                $produit = $produitDAO->find($produit_image_commande->get_id_produit());
                $familleDAO = new FamilleDAO;
                $famille = $familleDAO->find($produit_image_commande->get_id_famille());
                $imageDAO = new ImageDAO;
                $image = $imageDAO->find($produit_image_commande->get_id_image());

                $id_commande = $commande->get_id_commande();
                echo("<td>".$produit->get_lib_produit()."</td>");
                echo("<td><img class=' ' src='./img/Produits/".$produit->get_id_produit().".jpg' alt='produit'></td>");
                echo("<td><img class='visuel' src='./img/Visuel/".$famille->get_lib_famille()."/".$image->get_id_image().".jpg' alt=''></td>");
                echo("<td>".$famille->get_lib_famille().$image->get_id_image()."</td>");
                echo("<td>".$produit_image_commande->get_quantite()."</td>");
                echo("<td>".$produit->get_prix_produit()."</td>");
                echo("<td>".$produit_image_commande->get_message()."</td>");
                echo("<td><a class='non_conforme' href='suppression.php?c=1&id_produit=".$produit->get_id_produit()."&lib_famille=".$famille->get_lib_famille()."&id_image=".$image->get_id_image()."'>Supprimer</a></td>");
                echo("</tr>");
            }
        ?>
    </table>
<?php
    require("footer.php");
?>