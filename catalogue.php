<?php
  require("header.php");
  $produits =New ProduitDAO;
  $produits = $produits->findall();    


?>
<h1>Catalogue</h1>
<h2 class="text_center">Produits</h2>
<div class="container">
  <div class="produits_container card">
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
</div>

<h2 class="text_center">Visuels</h2>
<?php
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
            <img class='visuel_img' src='./img/Visuel/<?=$lib_famille."/".$img?>.jpg' alt='visuel'>
          <?php 
        }
        ?>
      </div>
    </div>
    <?php 
  }
require("footer.php");
?> 

