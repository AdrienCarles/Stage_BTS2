<?php
// Initialisations
require('init.php');
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Les Silusins</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
  <h1>Les silusins</h1>
  
  <?php include "menu.php"; 
  session_unset();
  session_destroy();
  setcookie(session_name(),'',-1,'/');
  ?>
</body>
</html>