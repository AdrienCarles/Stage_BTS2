<?php
    require("header.php");

    $qte = isset($_POST['qte']) ? $_POST['qte'] : '';
    $etape = isset($_GET['etape']) ? $_GET['etape'] : '';

    $produit = isset($_SESSION['produit']) ? $_SESSION['produit'] : ''; //récupération des objets contenus dans la session 
    $famille = isset($_SESSION['famille']) ? $_SESSION['famille'] : '';
    $image = isset($_SESSION['image']) ? $_SESSION['image'] : '';
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';

    $commandeDAO = new CommandeDAO;

    //récuperation des données du formulaire
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $classe = isset($_POST['classe']) ? $_POST['classe'] : '';
    $tel = isset($_POST['tel']) ? $_POST['tel'] : '';
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';

    $submit = isset($_POST['submit']);

?>
<h1>Validation</h1>
<?php
    if($etape === ''){
        echo ("<h2 class=''>Valider votre produit</h2>");
        echo("<p class=''>".$produit->get_lib_produit()."</p>");
        $img_produit = $produit->get_id_produit();
        echo("<img class=' ' src='./img/Produits/$img_produit.jpg' alt='produit'>");
        $lib_famille = $famille->get_lib_famille();
        $img_visuel = $image->get_id_image();
        echo("<img class=' ' src='./img/Visuel/$lib_famille/$img_visuel.jpg' alt='produit'>");
        if($message === ''){
            echo("<p class=''>Quantité : ".$qte."</p>");
            echo "<a href='validation.php?etape=1'>Valider</a>";
        }else{
            echo("<p class=''>Quantité : 1</p>");
            echo("<p class=''>Message : ".$message."</p>");
            echo ("<a href='validation.php?etape=1'>Valider</a>");
        }
    }else{
        echo ("<h2 class=''>Veillez entrez vos identifiants de commande</h2>");
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="nom">Nom</label><br>
            <input type="text" name="nom"><br><br>
            <label for="prenom">Prenom</label><br>
            <input type="text" name="prenom"><br><br>
            <label for="classe">Clasee</label><br>
            <input type="text" name="classe"><br><br>
            <label for="tel">Téléphone</label><br>
            <input type="text" name="tel"><br><br>
            <label for="mail">Mail</label><br>
            <input type="text" name="mail"><br><br>
            <input type="submit">
        </form>
        <?php
    }
require("footer.php");
?>
