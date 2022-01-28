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
<h1 class="text_center">Ajout de visuels</h1>
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