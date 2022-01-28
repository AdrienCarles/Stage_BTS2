<?php
    require_once('fpdf/fpdf.php');
    require('init.php');
    session_start();
    $commandeDAO = new CommandeDAO;
    $produit_image_commandeDAO = new Produit_image_commandeDAO;


    $id_commande = isset($_GET["id_commande"]) ? $_GET["id_commande"] : '';
    $commande = $commandeDAO->find($id_commande);   
    $produit_image_commandes = $produit_image_commandeDAO->find_by_id_commande($id_commande);
    


    $pdf = new FPDF('P','cm',);
    $pdf->SetAutoPageBreak(1,40);
    $pdf->SetTitle('Visuels'.$commande->get_num_commande(), true);  // déﬁnit le titre du document
    $pdf->SetAuthor( $commande->get_nom_commande(), true);  // déﬁnit le créateur du document
    $pdf->mon_fichier='Commande'.$commande->get_num_commande().'.pdf';

    $pdf->AddPage(); // Crée une nouvelle page
    $pdf->SetFont('Arial','B',20);  // Définit la police 
    $x =0;
    $y =0;
    foreach ($produit_image_commandes as $produit_image_commande){
        $produitDAO = new ProduitDAO;
        $famille = new FamilleDAO;
        $produit = $produitDAO->find($produit_image_commande->get_id_produit());
        $diametre = $produit->get_diametre_produit();
        $famille = $famille->find($produit_image_commande->get_id_famille());
        $chemin = "./img/Visuel/".$famille->get_lib_famille()."/".$produit_image_commande->get_id_image().".jpg";
        $quantite = $produit_image_commande->get_quantite();
        while ($quantite > 0 ){
            $pdf->SetXY($x,$y);
            $pdf->Image($chemin,$x,$y,$diametre,$diametre);
            if($diametre == 10){
                $y = $y+5;
            }
            $x = $x+$diametre;
            if($x > 15){
                $y = $y+$diametre;
                $x = 0;
                if($y > 20){
                    $pdf->AddPage(); // Crée une nouvelle page
                    $x =0;
                    $y =0;                
                }
            }
            $quantite = $quantite-1;
        }
    }
    $pdf->Output('d','./pdf/'.$pdf->mon_fichier, 'UTF-8');
?>
