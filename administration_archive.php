<?php
    require("header.php");
    $utilisateur = isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur'] : '';
    $role = $utilisateur->get_id_role();
    /*recupération des variables du formulaire de recherche*/
    $mot = $_POST['mot'] ?? null;

    $submit = isset($_POST['submit']) ? $_POST['submit'] : '';
    if($submit){
        if($_POST['date1']){
            $date1 = new DateTime(null, new DateTimeZone('Europe/Paris'));
            $date1 = $_POST['date1'];
        }else{
            $date1 = NULL;
        }
        if($_POST['date2']){
            $date2 = new DateTime(null, new DateTimeZone('Europe/Paris'));
            $date2 = $_POST['date2'];
        }else{
            $date2 = NULL;
        }
            
        if(isset($mot)){
            $commandes = $commandeDAO->find_by_critere($mot);
        }if(isset($date1 ,$date2)){
            $commandes = $commandeDAO->find_by_periode($date1,$date2);
        }
    }else{
        $commandes = $commandeDAO->findall();
    }

    $reset = $_POST['reset'] ?? null;
    if($reset){
        $mot = NULL;
        $date1 = NULL;
        $date2 = NULL;
    }


    echo"<h1>Archive des commandes</h1>";

    if($role == 3){
?>
    <div class="container card" style="max-width:300px">
        <div class="row creation_row">
            <h3>Recherche</h3>
        </div>
        <div class="row creation_row">
            <form class="form_archive" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label class="text_center" for="mot">Mots-Clés</label>
                <input name="mot" id="mot" type="text" value="<?=$mot?>"><br>
                <label class="text_center" for="date">Periode</label>
                <input name="date1" id="date1" type="date" value="<?=$date1?>"><br>
                <input name="date2" id="date2" type="date" value="<?=$date2?>"><br>
                <input class="vert" type="submit" name="submit" value="Valider">
                <br>
                <input class="doree" type="submit" name="reset" value="Réinitialiser">
            </form>
        </div>
    </div>
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
        <th colspan="2">Détail</th>
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
                        echo("<td><a class='bleu' href='detail.php?c=1&num_commande=".$commande->get_num_commande()."'>Detail</a></td>");
                        echo("<td><a class='ciel' href='bon_de_commande_pdf.php?id_commande=".$commande->get_id_commande()."'>Facture</a></td>");
                    echo("</tr>");
                }
            }
    }
    ?>
</table>

<?php 
  require("footer.php");
?>

