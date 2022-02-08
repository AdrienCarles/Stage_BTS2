<?php
    require("header.php");
    $commandeDAO = new CommandeDAO;
    $familleDAO = new FamilleDAO;
    $imageDAO = new ImageDAO;
    $utilisateurDAO = new UtilisateurDAO;

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
        while($i<=$max){
            $image = new Image(array(
                "id_famille"=> $famille->get_id_famille(),
                "id_image"=>$i,
            ));
            $imageDAO->insert($image);
            $i++;
        }
    }
?>  
<h1 class="text_center">Gestion des visuels</h1>
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
                </ol>
            </div>
        </div>
        <div class="col-6 form_admin">
            <form class="card" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for="famille">Famille</label><br>
                    <input type="text" name='famille' id="famille"><br><br>
                    <label for="max">Nombre d'images</label><br>
                    <input type="number" name="max" id="max"><br><br>
                    <input type="submit" value="valider" name="submit">
            </form>
        </div>
    </div>    
</div>
<?php
    require("footer.php");
?>