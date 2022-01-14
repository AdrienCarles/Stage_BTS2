<?php
  require("header.php");
  $id_produit = isset($_GET['id_produit']) ? $_GET['id_produit'] : '';

  if(!isset($_SESSION['produit'])){
    $produit =New ProduitDAO;
    $produit = $produit->find($id_produit);  
    $_SESSION["produit"] = $produit;  
  }

?>
<h1>Catalogue</h1>
<?php
  if(!isset($_GET['id_produit'])){
    session_unset();
    $produits =New ProduitDAO;
    $produits = $produits->findall();    
    foreach($produits as $produit){
      echo("<p class=''>".$produit->get_lib_produit()."</p>");
      $img = $produit->get_id_produit();
      echo("<a href='catalogue.php?id_produit=".$img."'><img class=' ' src='./img/Produits/$img.jpg' alt='produit'></a>");
      echo("<p class=''>".$produit->get_prix()."€</p>");
    }
  }else{
    $id_produit =$_GET['id_produit'];
    $familles =New FamilleDAO;
    $familles = $familles->findall();
    foreach($familles as $famille){
      $id_famille = $famille->get_id_famille();
      $lib_famille = $famille->get_lib_famille();
      echo $lib_famille."<br>";
      $images = New ImageDAO;
      $images = $images->findall();
      foreach($images AS $image){  
        $img = $image->get_id_image();
        echo("<img class=' ' src='./img/Visuel/$lib_famille/$img.jpg' alt='produit'>");
      }
      echo "<hr>";
    }
  }
  require("footer.php");
?>

