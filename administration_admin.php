<?php
  require("header.php");
  $commandeDAO = new CommandeDAO;
  $familleDAO = new FamilleDAO;
  $imageDAO = new ImageDAO;
  $utilisateurDAO = new UtilisateurDAO;
  $commandes = $commandeDAO->findall();
  $cloture = isset($_GET["cloture"]) ? $_GET["cloture"] : '';
  $id_commande = isset($_GET["id_commande"]) ? $_GET["id_commande"] : '';

  if($cloture == 1){
    $commandec = new Commande(array(
        'id_commande' => $id_commande,
        'id_statut'=>7,
    ));    
    $commandeDAO->update_statut($commandec); 
    header('Location: administration_admin.php');     
  }

  $lib_famille = isset($_POST['famille']) ? $_POST['famille'] : '';
  $max = isset($_POST['max']) ? $_POST['max'] : '';

  $submit = isset($_POST['submit']);

  if ($submit) {
    $famille =new Famille(array(
        "lib_famille" => $lib_famille,
    ));
    $familleDAO->insert($famille);
    $famille= $familleDAO->find_by_lib($lib_famille);
    $i = 1;
    var_dump($i);
    while($i<=$max){
        $image = new Image(array(
            "id_famille"=> $famille->get_id_famille(),
            "id_image"=>$i,
        ));
        $imageDAO->insert($image);
        $i++;
    }
    echo "Rajouter";
  }


?>
<h1>Portail administrateur</h1>

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
                    echo("<td><a href='administration_admin.php?cloture=1&id_commande=".$commande->get_id_commande()."'>Archiver</a></td>");
                echo("</tr>");
            }
        }
    ?>
</table>

<h2 class="text_center">Liste des commandes valider par un controleur</h2>

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
    <th>Cloturer</th>
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
                    echo("<td><a href='administration_admin.php?cloture=1&id_commande=".$commande->get_id_commande()."'>Archiver</a></td>");
                echo("</tr>");
            }
        }
    ?>
</table>


<h2 class="text_center">Liste des commandes archivé</h2>
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
    ?>
</table>

<h2 class="text_center">Insertion de nouveaux visuel</h2>
<div class="form_admin">
    <form class="card" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="famille">Famille</label><br>
            <input type="text" name='famille' id="famille"><br><br>
            <label for="max">Nombre d'images</label><br>
            <input type="number" name="max" id="max"><br><br>
            <input type="submit" value="valider" name="submit">
    </form>
</div>
<?php 
  require("footer.php");
?>

