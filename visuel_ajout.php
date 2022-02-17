<?php
    require("header.php");

    $messages = array(); //message d'erreur

    // instantiation des variables DAO 
    $commandeDAO = new CommandeDAO;
    $familleDAO = new FamilleDAO;
    $imageDAO = new ImageDAO;
    $utilisateurDAO = new UtilisateurDAO;

    $formulaire = $_GET['formulaire'] ?? null;
    $lib = $_GET['lib'] ?? null;

    /*recupération des variables des formulaires */
    $lib_famille = isset($_POST['famille']) ? $_POST['famille'] : '';
    $promo_famille = isset($_POST['promo']) ? 1 : 0;
    $max = $_POST['max'] ?? NULL;
    $nb = $_POST['nb'] ?? NULL;


    $submit = isset($_POST['submit']);
    $submit2 = isset($_POST['submit2']);
    $submit3 = isset($_POST['submit3']);
    $submit4 = isset($_POST['submit4']);



    // formulaire numero 1
    if ($submit) {
        $famille = filter_input(INPUT_POST, "famille",FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty(trim($famille))){ 
            $messages[] = "Le nom de la famille est est obligatoire"; 
        }
        if (count($messages) == 0){
            $famille =new Famille(array(
                "lib_famille" => $lib_famille,
                "promo_famille" => $promo_famille,
            ));
            $familleDAO->insert($famille);
            $famille= $familleDAO->find_by_lib($lib_famille);
            $i = 1;
            while($i<=$max){
                $image = new Image(array(
                    "id_famille"=> $famille->get_id_famille(),
                    "id_image"=>$i,
                ));
                $imageDAO->insert($image);
                $i++;
            }
            $messages[] = "La famille ".$lib_famille." a été créé et contient ".$max." images";
        }
    }
    // formulaire numéro 2
    if ($submit2) {
        $lib_famille = filter_input(INPUT_POST, "famille",FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty(trim($lib_famille))){ 
            $messages[] = "Le nom de la famille est est obligatoire"; 
        }
        if (count($messages) == 0){
            $famille= $familleDAO->find_by_lib($lib_famille);
            $nb_image = $imageDAO->count_img_by_famille($famille->get_id_famille());
            $max = $nb_image + $nb;
            $nb_image++;
            while($nb_image<=$max){
                $image = new Image(array(
                    "id_famille"=> $famille->get_id_famille(),
                    "id_image"=>$nb_image,
                ));
                $imageDAO->insert($image);
                $nb_image++;
            }
            $messages[] = $nb." images ont été ajoutées de la famille ".$famille->get_lib_famille();
        }
    }
    // formulaire numéro 3
    if ($submit3) {
        $lib_famille = filter_input(INPUT_POST, "famille",FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty(trim($lib_famille))){ 
            $messages[] = "Le nom de la famille est est obligatoire"; 
        }
        if (count($messages) == 0){
            $famille= $familleDAO->find_by_lib($lib_famille);
            $famille2 = new Famille(array(
                "id_famille"=> $famille->get_id_famille(),
                "promo_famille"=>2,
            ));
            $familleDAO->update_promo_famille($famille2);
            $messages[] = "La famille ".$lib_famille." a été supprimmé";
        }
    }
    // formulaire numéro 3
    if ($submit4) {
        $lib_famille = filter_input(INPUT_POST, "famille",FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty(trim($lib_famille))){ 
            $messages[] = "Le nom de la famille est est obligatoire"; 
        }
        if (count($messages) == 0){
            $famille= $familleDAO->find_by_lib($lib_famille);
            $famille2 = new Famille(array(
                "id_famille"=> $famille->get_id_famille(),
                "promo_famille"=>$promo_famille,
            ));
            $familleDAO->update_promo_famille($famille2);
            $messages[] = "La famille ".$lib_famille." a été rajoutée";
        }
    } 
    ?>  
<h1 class="text_center">Gestion des visuels</h1>
<div class="container">
    <div class="row connexion_row">
    <?php // messages d'erreur
      if (count($messages) > 0) {
        echo "<ul>";
        foreach ($messages as $message) {
          echo "<li class='attention'>" . $message . "</li>";
        }
        echo "</ul>";
      }
    ?>
  </div>
</div>
<?php
if($formulaire == NULL){
?>
<div class="container">
    <div class="row card">
        <table>
            <th>Nom</th>
            <th>Nombre de visuel</th>
            <th>États</th>
            <th colspan = "3">Action</th>
            <?php
            $familles = $familleDAO->findAll();
            foreach($familles as $famille){
                $lib_famille = $famille->get_lib_famille();
                $nb = $imageDAO->count_img_by_famille($famille->get_id_famille());
                $num_etat = $famille->get_promo_famille();
                switch ($num_etat){
                    case 0: 
                        $etat = "Affiché";
                        break;
                    case 1:
                        $etat = "Promo Affiché";
                        break;
                    case 2:
                        $etat = "Caché";
                        break; 
                } 
                ?>
                <tr>
                <td class="text_center"><?=$lib_famille?></td>
                <td><?=$nb?></td>
                <td><?=$etat?></td>
                <td><a class="vert" href="visuel_ajout.php?formulaire=2&lib=<?=$lib_famille?>">Ajout de visuels</a></td>
                <td><a class="doree" href="visuel_ajout.php?formulaire=4&lib=<?=$lib_famille?>">Rajout de la famille</a></td>
                <td><a class="rouge" href="visuel_ajout.php?formulaire=3&lib=<?=$lib_famille?>">Retrait de la famille</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <br>
    <div class="row_centrer">
        <a class="bleu" href="visuel_ajout.php?formulaire=1">Ajouter une nouvelle famille</a>
    </div>
</div>
<?php
}if($formulaire == 1){
?>
<h2 class="text_center">Creation d'une famille et ajout de visuels</h2>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <div class="card visuel_ajout_procedure">
                <ol>
                    <li>Créer le dossier au nom de votre famille dans Stage_BTS2\img\Visuel</li>
                    <li>Créer les images dans le dossier précédement créer le format des images est le suivant</li>
                    <ul>
                        <li>Les images doivent être nommée avec des numéros</li>
                        <li>Les images doivent impérativement être au format JPG</li>
                    </ul>
                    <li>Rentrer dans le formulaire à droite les informations relatives a votre insertion</li>
                    <ul>
                        <li>Le nom de la famille doit être exactement le même</li>
                        <li>Il faut ensuite renseigner le deuxième champs du formulaire avec le nombre d'images présentes dans le dossier précédement créer </li>
                    </ul>
                    <li>La case à cocher permet de mettre la famille en avant</li>
                </ol>
            </div>
        </div>
        <div class="col-6 form_admin">
            <form class="card" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for="famille">Famille</label><br>
                    <input type="text" name='famille' id="famille"><br><br>
                    <label for="max">Nombre d'images</label><br>
                    <input type="number" name="max" id="max" min="1"><br><br>
                    <label for="promo">Famille promotionnel</label><br>
                    <input type="checkbox" name="promo" id="promo"><br><br>
                    <input type="submit" value="valider" name="submit">
            </form>
        </div>
    </div>    
</div>
<?php
}if($formulaire == 2){
?>
<h2 class="text_center">Ajout de visuels dans une famille déjà existante</h2>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <div class="card visuel_ajout_procedure">
                <ol>
                    <li>Créer les images dans le dossier de la famille, le format des images est le suivant</li>
                    <ul>
                        <li>Les images doivent être nommée avec des numéros</li>
                        <li>Les images doivent impérativement être au format JPG</li>
                    </ul>
                    <li>Rentrer dans le formulaire à droite les informations relatives a votre insertion</li>
                    <ul>
                        <li>Il faut ensuite renseigner le deuxième champs du formulaire avec le nombre d'images à ajouter dans la base de donée</li>
                    </ul>
                </ol>
            </div>
        </div>
        <div class="col-6 form_admin">
            <form class="card" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for=" ">Famille</label><br>
                    <input type="text" name=' ' id=" " value="<?=$lib?>" disabled><br><br>
                    <input type="text" name='famille' id="famille" value="<?=$lib?>" hidden>
                    <label for="nb">Nombre d'images a ajouter</label><br>
                    <input type="number" name="nb" id="nb" min="1"><br><br>
                    <input type="submit" value="valider" name="submit2">
            </form>
        </div>
    </div>    
</div>
<?php
}if($formulaire == 3){
?>
<h2 class="text_center">Suppression d'une famille</h2>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <div class="card visuel_ajout_procedure">
                <ol>
                    <li>La famille ne seras pas supprimé de a base de donnée</li>
                    <li>Elle ne seras juste plus affichée</li>
                </ol>
            </div>
        </div>
        <div class="col-6 form_admin">
            <form class="card" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for=" ">Famille</label><br>
                    <input type="text" name=' ' id=" " value="<?=$lib?>" disabled><br><br>
                    <input type="text" name='famille' id="famille" value="<?=$lib?>" hidden>
                    <input type="submit" value="valider" name="submit3">
            </form>
        </div>
    </div>    
</div>
<?php
}if($formulaire == 4){
    ?>
    <h2 class="text_center">Rajout d'une famille</h2>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card visuel_ajout_procedure">
                    <ol>
                        <li>La famille sera révélée dans le catalogue et la personnalisation</li>
                    </ol>
                </div>
            </div>
            <div class="col-6 form_admin">
                <form class="card" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <label for=" ">Famille</label><br>
                        <input type="text" name=' ' id=" " value="<?=$lib?>" disabled><br><br>
                        <input type="text" name='famille' id="famille" value="<?=$lib?>" hidden>
                        <label for="promo">Famille promotionnel</label><br>
                        <input type="checkbox" name="promo" id="promo"><br><br>
                        <input type="submit" value="valider" name="submit4">
                </form>
            </div>
        </div>    
    </div>
    <?php
    }
    require("footer.php");
?>