<?php
    require("header.php");
    $prix_total = 0;
    $commande = isset($_SESSION['commande']) ? $_SESSION['commande'] : '';
    $id_commande = $commande->get_id_commande();
    $produit_image_commandeDAO = new Produit_image_commandeDAO;
    $produit_image_commandes = $produit_image_commandeDAO->findall();

    echo "<h1>Panier de ".$commande->get_prenom_commande()." ".$commande->get_nom_commande()."</h1>";
    ?>
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

                $id_commande = $commande->get_id_commande();
                echo("<td>".$produit->get_lib_produit()."</td>");
                echo("<td><img class=' ' src='./img/Produits/".$produit->get_id_produit().".jpg' alt='produit'></td>");
                echo("<td><img class=' ' src='./img/Visuel/".$famille->get_lib_famille()."/".$image->get_id_image().".jpg' alt=''></td>");
                echo("<td>".$famille->get_lib_famille().$image->get_id_image()."</td>");
                echo("<td>".$produit_image_commande->get_quantite()."</td>");
                echo("<td>".$produit->get_prix()."</td>");
                $prix_total = $prix_total +($produit->get_prix()*$produit_image_commande->get_quantite());
                echo("<td>".$produit_image_commande->get_message()."</td>");
                echo("<td><a href='suppression.php?id_produit=".$produit->get_id_produit()."&lib_famille=".$famille->get_lib_famille()."&id_image=".$image->get_id_image()."'>Supprimer</a></td>");
                echo("</tr>");
            }
        }
    ?>
    </table>
<?php
    echo "<p>Total a payer : ".$prix_total."</p>";
    echo "<a href='bon_de_commande_pdf.php'>Validation de la commande</a>";
    require("footer.php");
?>
