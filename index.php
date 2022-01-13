<?php
  require("header.php");
?>
<h1>Les silusins</h1>

<?php 
  include "menu.php"; 
  session_unset();
  session_destroy();
  setcookie(session_name(),'',-1,'/');
  require("footer.php");
?>
