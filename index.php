<?php
  require("header.php");
  $connexion = isset($_GET['connexion']) ? $_GET['connexion'] : '1';
  session_unset(); // Détruit toutes les variables de session
  session_destroy(); // Détruit la session (mais pas le cookie)
  setcookie(session_name(),'',-1,'/'); // Détruit le cookie de session
?>
<h1 class="">Les silusins</h1>

<?php 
  if($connexion == 0){
    echo "Vous êtes déconnecter";
  }
  require("footer.php");
?>
