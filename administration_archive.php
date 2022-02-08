<?php
  require("header.php");
  $utilisateur = isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur'] : '';
  $role = $utilisateur->get_id_role();
  $commandes = $commandeDAO->findall();

    echo"<h1>Archive des commandes</h1>";

    if($role == 3){
?>
    <h2 class="text_center">Liste des commandes livrées (statut: Livrée)</h2>
    <table>
        <th>Numéro</th>
        <th>Date</th>
        <th>Prix total</th>
        <th>Mode de paiement</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Classe</th>
        <th>Tel</th>
        <th>Mail</th>
        <th>Détail</th>
        <?php
            foreach($commandes as $commande){
                $id_statut = $commande->get_id_statut();
                if($id_statut == 7){
                    echo("<tr>");
                        echo("<td>".$commande->get_num_commande()."</td>");
                        echo("<td>".$commande->get_date_commande()."</td>");
                        echo("<td>".$commande->get_total_commande()."€</td>");
                        echo("<td>".$commande->get_mode_paiement()."</td>");
                        echo("<td>".$commande->get_nom_commande()."</td>");
                        echo("<td>".$commande->get_prenom_commande()."</td>");
                        echo("<td>".$commande->get_classe_commande()."</td>");
                        echo("<td>".$commande->get_tel_commande()."</td>");
                        echo("<td>".$commande->get_mail_commande()."</td>");
                        echo("<td><a class='detail' href='detail.php?num_commande=".$commande->get_num_commande()."'>Detail</a></td>");
                    echo("</tr>");
                }
            }
    }
    ?>
</table>

<?php 
  require("footer.php");
?>

