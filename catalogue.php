<?php
// Initialisations
require('init.php');

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
  <h1>Images</h1>
  <?php include "menu.php"; ?>
  <?php
        $familles =New FamilleDAO;
        $familles = $familles->findall();
        foreach($familles as $famille){
            $lib_famille = $famille->get_lib_famille();
            echo $lib_famille."<br>";
            $images = New ImageDAO;
            $images = $images->findall();
            foreach($images AS $image){  
                $img = $image->get_id_image();
                echo("<img class='' src='./img/Visuel/$lib_famille/$img.jpg' alt='icon'>");
            }
        }
    ?>
</body>
</html>