<?php
    require_once("header.php");

    $etape = isset($_GET['etape']) ? $_GET['etape'] : null;//definition de la condition d'affichage
    if(!isset($etape)){
        $etape = 0;
    }//point 0
    
    //etape 2
    $id_produit = isset($_GET['id_produit']) ? $_GET['id_produit'] : ''; //récuperation de l'id du produit séléctionné grace a l'url (alimente la session)

    if(!isset($_SESSION['produit'])){
        $produit =New ProduitDAO;
        $produit = $produit->find($id_produit);  
        $_SESSION["produit"] = $produit;  
    }// création de la session produit contenant l'objet Produit d'id selectionné

    //etape 3
    $id_famille = isset($_GET['id_famille']) ? $_GET['id_famille'] : ''; //récuperation de l'id de la famille séléctionné grace a l'url (alimente la session)
    $id_image = isset($_GET['id_image']) ? $_GET['id_image'] : ''; //récuperation de l'id de l'image séléctionné grace a l'url (alimente la session)

    $produit = isset($_SESSION['produit']) ? $_SESSION['produit'] : ''; //récupération des objets contenus dans la session 
    $famille = isset($_SESSION['famille']) ? $_SESSION['famille'] : '';
    $image = isset($_SESSION['image']) ? $_SESSION['image'] : '';

    $submit = isset($_POST['submit']); //validation de formulaire de l'étape 3

    if($submit){
        $message = isset($_POST['message']) ? $_POST['message'] : ''; //récupération du message depuis le formulaire 
        $_SESSION["message"] = $message;  
        header("Location: creation.php?etape=4"); //Redirection vers l'etape 4 
    }

    if(!isset($_SESSION['famille'])){
        $famille =New FamilleDAO;
        $famille = $famille->find($id_famille);  
        $_SESSION["famille"] = $famille;  
    }// création de la session famille contenant l'objet Fammille d'id selectionné
    if(!isset($_SESSION['image'])){
        $image =New ImageDAO;
        $image = $image->find($id_image);  
        $_SESSION["image"] = $image;  
    }// création de la session image contenant l'objet Image d'id selectionné

    //etape 4 
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';

    // Point 0
    if($etape == 0){
        echo "<h1>Créer le votre</h1>";   
        echo "<br>";
        echo "<a href='creation.php?etape=1'>C'est parti</a>";
    }
    // Etape 1
    if($etape == 1){
        echo "<h1>Choisissez un produit</h1>";
        if(!isset($_GET['id_produit'])){
            unset($_SESSION['produit']);
            unset($_SESSION['famille']);
            unset($_SESSION['image']);
            unset($_SESSION['message']);
            unset($_SESSION['qte']);
            $produits =New ProduitDAO;
            $produits = $produits->findall();    
            foreach($produits as $produit){
              echo("<p class=''>".$produit->get_lib_produit()."</p>");
              $img = $produit->get_id_produit();
              echo("<a href='creation.php?etape=2&id_produit=".$img."'><img class=' ' src='./img/Produits/$img.jpg' alt='produit'></a>");
              echo("<p class=''>".$produit->get_prix_produit()."€</p>");
            }
        }
    }
    // Etape 2
    if($etape == 2){
        $familles =New FamilleDAO;
        $familles = $familles->findall();
        foreach($familles as $famille){
          $id_famille = $famille->get_id_famille();
          $lib_famille = $famille->get_lib_famille();
          echo $lib_famille."<br>";
          $images = New ImageDAO;
          $images = $images->find_by_id_famille($id_famille);
          foreach($images AS $image){  
            $img = $image->get_id_image();
            echo("<a href='creation.php?etape=3&id_famille=".$id_famille."&id_image=".$img."'><img class=' ' src='./img/Visuel/$lib_famille/$img.jpg' alt=''></a>");
          }
          echo "<hr>";
        }
    }
    // Etape 3
    if($etape == 3){
        echo ('<h1>Choisissez un message personnalisée</h1>');  
        echo("<p class=''>".$produit->get_lib_produit()."</p>");
        $img_prod = $produit->get_id_produit();
        echo("<img class=' ' src='./img/Produits/$img_prod.jpg' alt='produit'>");
        echo("<img class=' ' src='./img/Visuel/".$famille->get_lib_famille()."/".$image->get_id_image().".jpg' alt='image'>");
    ?>
    <br><br><br>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <label for="message">Votre message personnalisé</label><br>
        <textarea name="message" id="message" cols="30" rows="2"></textarea><br>
        <input type="submit" name="submit" value="Valider" class="">
    </form>
    <?php
    }
    //etape 4 
    if($etape == 4){
        if($message === ''){
            echo ('<h1>Choisissez une quantité</h1>');  
            echo("<p class=''>".$produit->get_lib_produit()."</p>");
            $img_prod = $produit->get_id_produit();
            echo("<img class=' ' src='./img/Produits/$img_prod.jpg' alt='produit'>");
            echo("<img class=' ' src='./img/Visuel/".$famille->get_lib_famille()."/".$image->get_id_image().".jpg' alt='image'>");   
            ?>
            <form action="validation.php" method="post">
                <label for="qte">Quantité</label><br>
                <input name="qte" id="qte" type="number" value=1 required/><br>
                <input type="submit" name="submit2" value="Valider" class="">
            </form>
            <?php
        }else{
            header("Location: validation.php"); //Redirection vers validation
        }
    }
    require("footer.php");
?>


