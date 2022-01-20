<?php
  require("header.php");
  session_unset(); // Détruit toutes les variables de session
  session_destroy(); // Détruit la session (mais pas le cookie)
  setcookie(session_name(),'',-1,'/'); // Détruit le cookie de session
?>
<p>Vous êtes déconnecté</p>
<a href="index.php">Accueil</a>
<?php
  require("footer.php");
?>
