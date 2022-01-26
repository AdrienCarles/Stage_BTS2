<?php
    require("header.php");
    $num_commande = isset($_GET["num_commande"]) ? $_GET["num_commande"] : '';
    $commandeDAO = new CommandeDAO;
    $produit_image_commandeDAO = new Produit_image_commandeDAO;

    $commande = $commandeDAO->find_num_commande($num_commande);
    $produit_image_commandes = $produit_image_commandeDAO->find_by_id_commande($commande->get_id_commande());
?>
    <h1>Detail de la commande <?=$commande->get_num_commande()?></h1>

    <p>Nom : <?=$commande->get_nom_commande()?></p>
    <p>Prenom : <?=$commande->get_prenom_commande()?></p>
    <p>Tèl : <?=$commande->get_tel_commande()?></p>
    <p>Mail : <?=$commande->get_mail_commande()?></p>

    <table>
        <th>Nom Produit</th>
        <th>Produit</th>
        <th>Visuel</th>
        <th>Ref Visuel</th>
        <th>Quantité</th>
        <th>Prix Individuel</th>
        <th>Message</th>
        <?php
            foreach($produit_image_commandes as $produit_image_commande){
                echo("<tr>");
                $produit = new ProduitDAO;
                $produit = $produit->find($produit_image_commande->get_id_produit());
                $famille = new FamilleDAO;
                $famille = $famille->find($produit_image_commande->get_id_famille());
                $image = new ImageDAO;
                $image = $image->find($produit_image_commande->get_id_image());

                $id_commande = $commande->get_id_commande();
                echo("<td>".$produit->get_lib_produit()."</td>");
                echo("<td><img class=' ' src='./img/Produits/".$produit->get_id_produit().".jpg' alt='produit'></td>");
                echo("<td><img class=' ' src='./img/Visuel/".$famille->get_lib_famille()."/".$image->get_id_image().".jpg' alt=''></td>");
                echo("<td>".$famille->get_lib_famille().$image->get_id_image()."</td>");
                echo("<td>".$produit_image_commande->get_quantite()."</td>");
                echo("<td>".$produit->get_prix_produit()."</td>");
                echo("<td>".$produit_image_commande->get_message()."</td>");
                echo("</tr>");
            }
        ?>
    </table>
<?php
    require("footer.php");
?>