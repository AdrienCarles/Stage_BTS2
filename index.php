<?php
  require("header.php");
  $connexion = isset($_GET['connexion']) ? $_GET['connexion'] : '1';
?>
<div class="container">
  <div class="row row_index">
    <img class='card_index' src="./img/silusins.png" alt="garde">
  </div>
</div>
<?php 
  if($connexion == 0){
    echo "Vous êtes déconnecter";
  }
  require("footer.php");
?>
