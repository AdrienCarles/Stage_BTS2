<?php
  require("header.php");
  $commandeDAO = new CommandeDAO;
  $familleDAO = new FamilleDAO;
  $imageDAO = new ImageDAO;
  $utilisateurDAO = new UtilisateurDAO;
  $utilisateur = $_SESSION['utilisateur'];
  $commandes = $commandeDAO->findall();
  $cloture = isset($_GET["cloture"]) ? $_GET["cloture"] : '';
  $id_commande = isset($_GET["id_commande"]) ? $_GET["id_commande"] : '';

  if($cloture == 1){
    $commandec = new Commande(array(
        'id_commande' => $id_commande,
        'id_statut'=>3,
        'id_user_controleur'=>$utilisateur->get_id_user(),
    ));    
    $commandeDAO->update_statut_id_controleur($commandec); 
    header('Location: administration_controleur.php');     
  }

?>
<h1>Portail Controleur</h1> 

<h2 class="text_center">Liste des commandes à valider</h2>

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
    <th>Cloturer</th>
    <th>PDF</th>
    <?php
        foreach($commandes as $commande){
            $id_statut = $commande->get_id_statut();
            if($id_statut == 2){
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
                    echo("<td><a href='detail.php?num_commande=".$commande->get_num_commande()."'>Detail</a></td>");
                    echo("<td><a href='administration_controleur.php?cloture=1&id_commande=".$commande->get_id_commande()."'>Archiver</a></td>");
                    echo("<td><a href='bon_de_commande_telecharger_pdf.php?id_commande=".$commande->get_id_commande()."'>Télécharger</a></td>");
                echo("</tr>");
            }
        }
    ?>
</table>

<h2 class="text_center">Liste des commandes valider</h2>

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
    <th>Cloturer</th>
    <th>PDF</th>
    <?php
        foreach($commandes as $commande){
            $id_statut = $commande->get_id_statut();
            $id_user_controleur = $commande->get_id_user_controleur();
            $user = $utilisateurDAO->find($id_user_controleur);
            if($id_statut == 3 && $id_user_controleur == $user->get_id_user()){
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
                    echo("<td><a href='detail.php?num_commande=".$commande->get_num_commande()."'>Detail</a></td>");
                    echo("<td><a href='administration_controleur.php?cloture=1&id_commande=".$commande->get_id_commande()."'>Archiver</a></td>");
                    echo("<td><a href='bon_de_commande_telecharger_pdf.php?id_commande=".$commande->get_id_commande()."'>Télécharger</a></td>");
                echo("</tr>");
            }
        }
    ?>
</table>
<?php 
  require("footer.php");
?>

