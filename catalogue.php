<?php
  require("header.php");
  $produits =New ProduitDAO;
  $produits = $produits->findall();    


?>
<h1>Catalogue</h1>
<h2>Produits</h2>
<div class="container produits_container">
    <?php   
    foreach($produits as $produit){
      ?>
      <div class="row produits_row">
        <?php
        echo("<p class=''>".$produit->get_lib_produit()."</p>");
        $img = $produit->get_id_produit();
        echo("<img class=' ' src='./img/Produits/$img.jpg' alt='produit'>");
        echo("<p class=''>".$produit->get_prix_produit()."€</p>");
        echo("<p class=''>".$produit->get_diametre_produit()."mm</p>");
        ?>
      </div>
      <?php
    }
    ?>
</div>
<h2>Visuels</h2>
<?php
  $familles =New FamilleDAO;
  $familles = $familles->findAll_order_by_promo();
  foreach($familles as $famille){
    $id_famille = $famille->get_id_famille();
    $lib_famille = $famille->get_lib_famille();
    echo "<br>".$lib_famille."<br>";
    echo "<hr>";
    $images = New ImageDAO;
    $images = $images->find_by_id_famille($id_famille);
    foreach($images AS $image){  
      $img = $image->get_id_image();
      echo("<img class='visuel_img' src='./img/Visuel/$lib_famille/$img.jpg' alt=''>");
    }
  }
require("footer.php");
?> 

