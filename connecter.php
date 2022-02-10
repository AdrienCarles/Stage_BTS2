<?php
  require_once("header.php");
  $utilisateur = $_SESSION['utilisateur'];
  $nom = $utilisateur->get_nom_user();
  $prenom = $utilisateur->get_prenom_user();
?>
<h1>Bienvenue</h1>
<h2 class="text_center"><?=$nom.' '.$prenom?></h2>
<?php 
  require("footer.php");
?>

