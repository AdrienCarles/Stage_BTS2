<?php
    require_once('fpdf/fpdf.php');
    require('init.php');
    session_start();
    $commandeDAO = new CommandeDAO;
    $produit_image_commandeDAO = new Produit_image_commandeDAO;


    $id_commande = isset($_GET["id_commande"]) ? $_GET["id_commande"] : '';
    $commande = $commandeDAO->find($id_commande);   
    $produit_image_commandes = $produit_image_commandeDAO->find_by_id_commande($id_commande);
    


    $pdf = new FPDF('P','mm',);
    $pdf->SetTitle('Visuels'.$commande->get_num_commande(), true);  // déﬁnit le titre du document
    $pdf->SetAuthor( $commande->get_nom_commande(), true);  // déﬁnit le créateur du document
    $pdf->mon_fichier='Commande'.$commande->get_num_commande().'.pdf';

    $pdf->AddPage(); // Crée une nouvelle page
    $pdf->SetFont('Arial','B',20);  // Définit la police 
    $x =10;
    $y =10;
    $diametre_x = 0;
    $pdf->SetXY($x,$y);
    foreach ($produit_image_commandes as $produit_image_commande){
        $produitDAO = new ProduitDAO;
        $familleDAO = new FamilleDAO;
        $produit = $produitDAO->find($produit_image_commande->get_id_produit());
        $diametre = $produit->get_diametre_produit()+1;
        $famille = $familleDAO->find($produit_image_commande->get_id_famille());
        $chemin = "./img/Visuel/".$famille->get_lib_famille()."/".$produit_image_commande->get_id_image().".jpg";
        $quantite = $produit_image_commande->get_quantite();
        for($quantite; $quantite > 0; $quantite--){
            $diametre_x = $diametre_x+$diametre;
            if($x < 140){
                $pdf->Image($chemin,$x,$y,$diametre,$diametre);
                $x = $x+$diametre+10;
            }
            if($x > 140){
                $y = $y+100;
                $x = 10;
                $diametre_x = 0;
                $pdf->SetXY($x,$y);
                if($y > 214){
                    $pdf->AddPage(); // Crée une nouvelle page
                    $x =10;
                    $y =10;                
                }
            }
        }
    }
    $pdf->Output('d','./pdf/'.$pdf->mon_fichier, 'UTF-8');
?>