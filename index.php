<?php
  require("header.php");
  $connexion = isset($_GET['connexion']) ? $_GET['connexion'] : '1';
?>
<h1 class="">Les silusins</h1>

<?php 
  if($connexion == 0){
    echo "Vous êtes déconnecter";
  }
  require("footer.php");
?>
