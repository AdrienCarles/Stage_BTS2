<?php
  require("header.php");
  session_unset(); // Détruit toutes les variables de session
  session_destroy(); // Détruit la session (mais pas le cookie)
  setcookie(session_name(),'',-1,'/'); // Détruit le cookie de session

  header('location: index.php?connexion=0');

  require("footer.php");
?>
