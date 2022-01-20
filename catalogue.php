<?php
  require("header.php");
  $produits =New ProduitDAO;
  $produits = $produits->findall();    


?>
<h1>Catalogue</h1>
<h2>Produits</h2>
<table>
  <tr>
    <th>Nom du produit</th>
    <th>Image</th>
    <th>Prix</th>
  </tr>
  <?php
  foreach($produits as $produit){
    echo("<tr>");
    echo("<td>".$produit->get_lib_produit()."</td>");
    $img = $produit->get_id_produit();
    echo("<td><img class=' ' src='./img/Produits/$img.jpg' alt='produit'></td>");
    echo("<td>".$produit->get_prix()."€</td>");
    echo("</tr>");
  }
  ?>  
</table>
<h2>Visuels</h2>
<?php
  $familles =New FamilleDAO;
  $familles = $familles->findall();
  foreach($familles as $famille){
    $id_famille = $famille->get_id_famille();
    $lib_famille = $famille->get_lib_famille();
    echo "<br>".$lib_famille."<br>";
    echo "<hr>";
    $images = New ImageDAO;
    $images = $images->find_by_id_famille($id_famille);
    foreach($images AS $image){  
      $img = $image->get_id_image();
      echo("<img class=' ' src='./img/Visuel/$lib_famille/$img.jpg' alt=''>");
    }
  }
require("footer.php");
?> 

