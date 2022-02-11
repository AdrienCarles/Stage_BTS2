<?php
    require_once("header.php");
    /*Recuperation des variables dans les URL ($_GET)*/
    $etape = isset($_GET['etape']) ? $_GET['etape'] : null;//definition de la condition d'affichage
    $type_commande = isset($_GET['type_commande']) ? $_GET['type_commande'] : NULL; //récuperation du type de commande grace a l'url (alimente la session)
    $id_produit = isset($_GET['id_produit']) ? $_GET['id_produit'] : ''; //récuperation de l'id du produit séléctionné grace a l'url (alimente la session)
    $id_famille = isset($_GET['id_famille']) ? $_GET['id_famille'] : ''; //récuperation de l'id de la famille séléctionné grace a l'url (alimente la session)
    $id_image = isset($_GET['id_image']) ? $_GET['id_image'] : ''; //récuperation de l'id de l'image séléctionné grace a l'url (alimente la session)

    /*Création des variables de session ($_SESSION)*/
    $utilisateur = isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur'] : null;
    if(isset($type_commande)){
        $_SESSION["type_commande"] = $type_commande;  // création de la session type_commande contenant le type WEB ou physique de la commande a saisir
    }// création de la session produit contenant le type de la commande P ou W 
    if(!isset($_SESSION['produit'])){
        $produit =New ProduitDAO;
        $produit = $produit->find($id_produit);  
        $_SESSION["produit"] = $produit;  
    }// création de la session produit contenant l'objet Produit d'id selectionné
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

    $produit = isset($_SESSION['produit']) ? $_SESSION['produit'] : ''; //récupération des objets contenus dans la session 
    $famille = isset($_SESSION['famille']) ? $_SESSION['famille'] : '';
    $image = isset($_SESSION['image']) ? $_SESSION['image'] : '';

    /*Création des variables recuperer depuis les formulaires ($_POST)*/

    $submit = isset($_POST['submit']); //validation de formulaire
    if($submit){
        $message = isset($_POST['message']) ? $_POST['message'] : ''; //récupération du message depuis le formulaire 
        $_SESSION["message"] = $message;  //creation de la session message 
        header("Location: creation.php?etape=4"); //Redirection vers l'etape 4 
    }
    
    $submit2 = isset($_POST['submit2']); //validation de formulaire

    if($submit2){
        $etape = isset($_POST['etape']) ? $_POST['etape'] : null;//definition de la condition d'affichage
        if($etape == 2){
            $produit = NULL;
            $_SESSION["produit"] = $produit;  
        }
        if($etape == 3){
            $image = NULL;
            $_SESSION["image"] = $image;  
            $famille = NULL;
            $_SESSION["famille"] = $famille;  
        }
        $etape--;
        header("Location: creation.php?etape=".$etape); //Redirection vers l'etape 4 
    }

    $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';

    if(!isset($etape)){
        $etape = 0;
    }//point 0

    // Point 0
    if($etape == 0 && !isset($utilisateur)){
        ?>
        <h1>Créer votre objet personalisée</h1>
        <div class="container">
            <div class="card">
                <div class="col-12"><h3 class="text_center">4 étapes</h3></div>
                <div class="col_12"><p class="text_center">Etape 1 : Choisir son objet</p></div>
                <div class="col_12"><p class="text_center">Etape 2 : Choisir son visuel parmis ceux proposés</p></div>
                <div class="col_12"><p class="text_center">Etape 3 : Choisir son message personalisée (optionel)</p></div>
                <div class="col-12"><p class="text_center">Etape 4 : Choisir une quantité (si pas de message)</p></div>
                <div class="col-12"><p class="text_center attention">ATTENTION : La gestion des doublons n'est pas correctement prisent en compte de ce fait il est interdit de sélectionner deux fois la même combinaison produit image dans une commande</p></div>
                <div class="col-12"><p class="text_center attention">Pour passer outre ce problème il faut générer deux commandes</p></div>
                <div class="col_12 div_bouton_creation"><a class="vert" href='creation.php?etape=1'>C'est parti</a></div>
            </div>
        </div>
        <?php
    }elseif($etape == 0 && !isset($_SESSION["type_commande"])){
        ?>
        <h1>Choisissez un type de commande</h1>
        <div class='container'>
            <div class="row controleur_type_commande">
                <a class='ciel' href='creation.php?etape=1&type_commande=W'>Commande WEB</a>
            </div>
            <div class="row controleur_type_commande">
                <a class='vert' href='creation.php?etape=1&type_commande=P'>Commande Physique</a>
            </div>
            <div class="row">
                <div class="col-12"><p class="text_center attention">ATTENTION : La gestion des doublons n'est pas correctement prisent en compte de ce fait il est interdit de sélectionner deux fois la même combinaison produit image dans une commande</p></div>
                <div class="col-12"><p class="text_center attention">Pour passer outre ce problème il faut générer deux commandes</p></div>
            </div>
        </div>
    <?php
    }elseif($etape == 0 ){
        header("Location: creation.php?etape=1"); 
    }
    // Etape 1
    if($etape == 1){
        echo "<h1>Etape 1 :Choisissez un produit</h1>";
        echo "<p class='text_center'>Cliquez sur l'image du produit que vous souhaitez</p>";
        if(!isset($_GET['id_produit'])){
            unset($_SESSION['produit']);
            unset($_SESSION['famille']);
            unset($_SESSION['image']);
            unset($_SESSION['message']);
            unset($_SESSION['qte']);
            $produitDAO =New ProduitDAO;
            $produits = $produitDAO->findall(); 
            ?>
            <div class="container">
                <div class="produits_container card">
                    <?php   
                    foreach($produits as $produit){
                        ?>
                        <div class="row produits_row">
                            <?php
                                echo("<p class=''>".$produit->get_lib_produit()."</p>");
                                $img = $produit->get_id_produit();
                                echo("<a href='creation.php?etape=2&id_produit=".$img."'><img class=' ' src='./img/Produits/$img.jpg' alt='produit'></a>");
                                echo("<p class=''>".$produit->get_prix_produit()."€</p>");
                                echo("<p class=''>".$produit->get_diametre_produit()."mm</p>");
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php 
        }
    }
    // Etape 2
    if($etape == 2){
        echo "<h1>Etape 2 :Choisissez un visuel</h1>";
        echo "<p class='text_center'>Cliquez sur l'image du visuel que vous souhaitez</p>";
        $familles =New FamilleDAO;
        $familles = $familles->findAll_order_by_promo();
        foreach($familles as $famille){
          $id_famille = $famille->get_id_famille();
          $lib_famille = $famille->get_lib_famille();
          ?>
          <h3 class="text_center"><?=$lib_famille?></h3>
          <?php 
          $images = New ImageDAO;
          $images = $images->find_by_id_famille($id_famille);
          ?>
          <div class="container_fluid">
            <div class="row_centrer card_visuel">
                <?php       
                foreach($images AS $image){  
                  $img = $image->get_id_image();
                  ?>
                  <a href='creation.php?etape=3&id_famille=<?=$id_famille?>&id_image=<?=$img?>'><img class='visuel_img' src='./img/Visuel/<?=$lib_famille."/".$img?>.jpg' alt=''></a>
                  <?php 
                }
                ?>
            </div>
          </div>
          <?php 
        }
    }
    // Etape 3
    if($etape == 3){
        ?>
        <h1>Etape 3 :Choisissez un message personnalisée</h1> 
        <div class="container">
            <div class="card">
                <div class="row creation_row">
                    <p class=''><?=$produit->get_lib_produit()?></p>
                </div>
                <div class="row creation_row">
                    <?php
                        $img_prod = $produit->get_id_produit();
                    ?>
                    <img class='produit_img' src='./img/Produits/<?=$img_prod?>.jpg' alt='produit'>
                    <img class='visuel_img' src='./img/Visuel/<?=$famille->get_lib_famille()?>/<?=$image->get_id_image()?>.jpg' alt='image'>
                </div>
                <br>
                <div class="row creation_row">
                    <form class="creation_form" action="creation.php?etape=4" method="post">
                        <label class="text_center" for="message">Votre message personnalisé</label>
                        <textarea name="message" id="message" cols="30" rows="2"></textarea><br>
                        <input class="vert" type="submit" name="submit" value="Valider" class="">
                    </form>
                </div>
            </div>
        </div>
    <?php
    }
    //etape 4 
    if($etape == 4){
        if($message === ''){
            ?>
        <h1>Etape 4 :Choisissez une quantité</h1> 
        <div class="container">
            <div class="card">
                <div class="row creation_row">
                    <p class=''><?=$produit->get_lib_produit()?></p>
                </div>
                <div class="row creation_row">
                    <?php
                        $img_prod = $produit->get_id_produit();
                    ?>
                    <img class='produit_img' src='./img/Produits/<?=$img_prod?>.jpg' alt='produit'>
                    <img class='visuel_img' src='./img/Visuel/<?=$famille->get_lib_famille()?>/<?=$image->get_id_image()?>.jpg' alt='image'>
                </div>
                <br>
                <div class="row creation_row">
                    <form class="creation_form" action="validation.php" method="post">
                        <label class="text_center" for="qte">Quantité</label><br>
                        <input name="qte" id="qte" type="number" value=1 required/><br><br>
                        <input class="vert" type="submit" name="submit" value="Valider" class="">
                    </form>
                </div>
            </div>
        </div>
            <?php
        }else{
            header("Location: validation.php?ismessage=1"); //Redirection vers validation
        }
    }
    if($etape >= 1){
    ?>
    <br>
    <div class="container">
        <div class="row creation_row">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="etape" value="<?=$etape?>" hidden>
                <input class="doree" type="submit" name="submit2" value="Retour à l'étape precédente">
            </form>
        </div>
    </div>
    <?php
    }
    require("footer.php");
?>


