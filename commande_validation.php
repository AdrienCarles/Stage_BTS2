<?php
    require('header.php');
    unset($_SESSION['commande']);
    unset($_SESSION['qte']);
?>
<h1>Les Silusins vous remercient pour votre commande</h1>

<?php
    echo("<a href='bon_de_commande_telecharger_pdf.php'>Telecharger la facture</a>");
    require('footer.php');
?>