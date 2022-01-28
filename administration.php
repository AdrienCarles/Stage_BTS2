<?php
  require("header.php");
  $commandeDAO = new CommandeDAO;
  $familleDAO = new FamilleDAO;
  $imageDAO = new ImageDAO;
  $utilisateurDAO = new UtilisateurDAO;
  $utilisateur = isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur'] : '';
  $role = $utilisateur->get_id_role();
  $commandes = $commandeDAO->findall();
  $cloture = isset($_GET["cloture"]) ? $_GET["cloture"] : '';
  $id_commande = isset($_GET["id_commande"]) ? $_GET["id_commande"] : '';

  /* Operation fausse */
  if($cloture == 1){
    $commandec = new Commande(array(
        'id_commande' => $id_commande,
        'id_statut'=>7,
    ));    
    $commandeDAO->update_statut($commandec); 
    header('Location: administration_admin.php');     
  }

  if($role == 3){
      echo"<h1>Portail administrateur</h1>";
  }else{
    echo"<h1>Portail controleur</h1>";
}

?>

<h2 class="text_center">Liste des commandes validées (statut: Validée)</h2>

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
    <th colspan="2">Action</th>
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
                    echo("<td><a href='administration.php?cloture=1&id_commande=".$commande->get_id_commande()."'>Conforme</a></td>");
                    echo("<td><a href='administration.php?cloture=1&id_commande=".$commande->get_id_commande()."'>Non conforme</a></td>");
                echo("</tr>");
            }
        }
    ?>
</table>
        
<h2 class="text_center">Liste des commandes controlées (statut: Conforme)</h2>

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
    <th>Nom controleur</th>    
    <th>Détail</th>
    <th colspan="2">Action</th>
    <?php
        foreach($commandes as $commande){
            $id_statut = $commande->get_id_statut();
            $id_user_controleur = $commande->get_id_user_controleur();
            $user = $utilisateurDAO->find($id_user_controleur);
            if($id_statut == 3){
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
                    echo("<td>".$user->get_prenom_user()."</td>");
                    echo("<td><a href='detail.php?num_commande=".$commande->get_num_commande()."'>Detail</a></td>");
                    echo("<td><a href='administration.php?cloture=1&id_commande=".$commande->get_id_commande()."'>Impression des visuels</a></td>");
                    echo("<td><a href='administration.php?cloture=1&id_commande=".$commande->get_id_commande()."'>Fabriquée</a></td>");

                echo("</tr>");
            }
        }
    ?>
</table>

<h2 class="text_center">Liste des commandes controlées (statut: Non conforme)</h2>

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
    <th>Nom controleur</th>    
    <th>Détail</th>
    <th colspan="2">Action</th>
    <?php
        foreach($commandes as $commande){
            $id_statut = $commande->get_id_statut();
            $id_user_controleur = $commande->get_id_user_controleur();
            $user = $utilisateurDAO->find($id_user_controleur);
            if($id_statut == 3){
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
                    echo("<td>".$user->get_prenom_user()."</td>");
                    echo("<td><a href='detail.php?num_commande=".$commande->get_num_commande()."'>Detail</a></td>");
                    echo("<td><a href='administration.php?cloture=1&id_commande=".$commande->get_id_commande()."'>Regulariser</a></td>");

                echo("</tr>");
            }
        }
    ?>
</table>

<h2 class="text_center">Liste des commandes fabriquées (statut: Fabriquée)</h2>

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
    <th>Nom controleur</th>    
    <th>Détail</th>
    <th>Action</th>
    <?php
        foreach($commandes as $commande){
            $id_statut = $commande->get_id_statut();
            $id_user_controleur = $commande->get_id_user_controleur();
            $user = $utilisateurDAO->find($id_user_controleur);
            if($id_statut == 3){
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
                    echo("<td>".$user->get_prenom_user()."</td>");
                    echo("<td><a href='detail.php?num_commande=".$commande->get_num_commande()."'>Detail</a></td>");
                    echo("<td><a href='administration.php?cloture=1&id_commande=".$commande->get_id_commande()."'>Livrée</a></td>");
                echo("</tr>");
            }
        }
    ?>
</table>

<?php
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
                        echo("<td><a href='detail.php?num_commande=".$commande->get_num_commande()."'>Detail</a></td>");
                    echo("</tr>");
                }
            }
    }
    ?>
</table>

<?php 
  require("footer.php");
?>

