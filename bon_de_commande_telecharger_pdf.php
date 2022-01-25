<?php
    require_once('fpdf/fpdf.php');
    require('init.php');
    session_start(); //demarage des sessions
    $id_commande = $_SESSION['id_commande'];
    $commandeDAO = new CommandeDAO;
    $commande = $commandeDAO->find($id_commande);   
    $pdf = new FPDF();
    //definition des constantes date qui renvois la date du jour et EURO qui atribut le signe €
    date_default_timezone_set('Europe/Paris'); //instanciation du fuseau horaire
    $date = date('d/m/Y');
    define('EURO'," ".utf8_encode(chr(128))); 

    $pdf->SetTitle( 'Bon de commande'.$commande->get_num_commande(), true);  // déﬁnit le titre du document
    $pdf->SetAuthor( $commande->get_nom_commande(), true);  // déﬁnit le créateur du document

    $pdf->AddPage(); // Crée une nouvelle page
    $pdf->SetFont('Arial','B',20);  // Définit la police 
    $pdf->Image('img/20.jpg',10,10,50,50); //Logo
    $pdf->Cell(0, 20, utf8_decode("SILUSINS"),0,1,'C');
    $pdf->SetFont('Arial','',12);  // Définit la police 
    $pdf->Cell(60, 5, utf8_decode(" "),0,0,'L');
    $pdf->Cell(50, 5, utf8_decode("NOM : ".$commande->get_nom_commande()),0,0,'L');
    $pdf->Cell(0, 5, utf8_decode("Prénom : ".$commande->get_prenom_commande()),0,0,'L');
    $pdf->Ln(7.5); //Saut de lignes
    $pdf->Cell(60, 5, utf8_decode(" "),0,0,'L');
    $pdf->Cell(0, 5, utf8_decode("Classe : ".$commande->get_classe_commande()),0,0,'L');
    $pdf->Ln(7.5); //Saut de lignes
    $pdf->Cell(60, 5, utf8_decode(" "),0,0,'L');
    $pdf->Cell(0, 5, utf8_decode("Tél : ".$commande->get_tel_commande()),0,0,'L');
    $pdf->Ln(7.5); //Saut de lignes
    $pdf->Cell(60, 5, utf8_decode(" "),0,0,'L');
    $pdf->Cell(0, 5, utf8_decode("Mail : ".$commande->get_mail_commande()),0,0,'L');

    $pdf->Ln(10); //Saut de lignes
    $pdf->RoundedRect(22.5,62,50,30,5,"D");
    $pdf->Cell(17.5, 5, utf8_decode(" "),0,0,'L');
    $pdf->Cell(40, 5, utf8_decode("Date et signature : "),0,0,'C');
    $pdf->RoundedRect(80,62,50,30,5,"D");
    $pdf->Cell(17.5, 5, utf8_decode(" "),0,0,'L');
    $pdf->Cell(40, 5, utf8_decode("Mode de paiement : "),0,0,'C');
    $pdf->RoundedRect(137.5,62,50,30,5,"D");
    $pdf->Cell(15, 5, utf8_decode(" "),0,0,'L');
    $pdf->Cell(45, 5, utf8_decode("Prix Total :"),0,1,'C');
    $pdf->Cell(17.5, 5, utf8_decode(" "),0,0,'L');
    $pdf->Cell(40,8,utf8_decode($date),0,0,"C");
    $pdf->Cell(75, 5, utf8_decode(" "),0,0,'L');
    $pdf->SetFont('Arial','',10);  // Définit la police 
    $pdf->MultiCell(40, 5, utf8_decode("(à payer au moment\nde la commande) :"),0,'C');
    if ($commande->get_mode_paiement() == "especes"){
        $pdf->SetFont('Arial','',12);  // Définit la police 
        $pdf->SetXY(85,75);
        $pdf->Cell(40, 5, utf8_decode("Espèces"),0,2,'C');
    }else{
        $pdf->SetFont('Arial','',12);  // Définit la police 
        $pdf->SetXY(85,72.5);
        $pdf->MultiCell(40, 5, utf8_decode("Chèque\nà l'ordre de L'OCCE"),0,'C');
    }
    $pdf->SetXY(155,80);
    $pdf->Cell(75, 5, utf8_decode($commande->get_total_commande().EURO),0,0,'L');
    $pdf->SetFont('Arial','B',18);  // Définit la police 
    $pdf->SetXY(10,100);
    $pdf->Cell(0, 12.5, utf8_decode("Bon de commande WEB ".$commande->get_num_commande()." - Les Silusins"),1,0,'C');
    $pdf->Ln(20);//Saut de lignes
    $pdf->SetFont('Arial','',12);  // Définit la police 
    //Tableau
    //Entêtes
    $pdf->Cell(50,10,"Produit",1,0,"C"); 
    $pdf->Cell(25,10,"Ref Visuel",1,0,"C"); 
    $pdf->Cell(20,10,utf8_decode("Quantité"),1,0,"C"); 
    $pdf->Cell(50,10,"Message",1,0,"C"); 
    $pdf->Cell(25,10,"Prix unitaire",1,0,"C"); 
    $pdf->Cell(20,10,"Prix tot",1,0,"C"); 
    $pdf->Ln(10);//Saut de lignes

    $id_commande = $commande->get_id_commande();
    $prix_total = 0;
    $produit_image_commandeDAO = new Produit_image_commandeDAO;
    $produit_image_commandes = $produit_image_commandeDAO->find_by_id_commande($id_commande);
    foreach ($produit_image_commandes as $produit_image_commande){
        $produit = new ProduitDAO;
        $produit = $produit->find($produit_image_commande->get_id_produit());
        $famille = new FamilleDAO;
        $famille = $famille->find($produit_image_commande->get_id_famille());
        $image = new ImageDAO;
        $image = $image->find($produit_image_commande->get_id_image());
        $pdf->Cell(50, 10, utf8_decode($produit->get_lib_produit()),1,0,"C");
        $pdf->Cell(25, 10, utf8_decode($famille->get_lib_famille().$image->get_id_image()),1,0,"C");
        $pdf->Cell(20, 10, utf8_decode($produit_image_commande->get_quantite()),1,0,"C");
        $pdf->Cell(50, 10, utf8_decode($produit_image_commande->get_message()),1,0,"C");
        $pdf->Cell(25, 10, utf8_decode($produit->get_prix_produit().EURO),1,0,"C");
        $pdf->Cell(20, 10, utf8_decode($produit->get_prix_produit()*$produit_image_commande->get_quantite().EURO),1,1,"C");
        $prix_total = $prix_total + $produit->get_prix_produit()*$produit_image_commande->get_quantite();
    }
    $pdf->Ln(10);//Saut de lignes
    $pdf->SetX(140);
    $pdf->Cell(30, 10, utf8_decode("Prix Total"),1,0,"C");
    $pdf->Cell(30, 10, utf8_decode($prix_total.EURO),1,1,"C");
    $pdf->Ln(10);//Saut de lignes
    $pdf->SetFont('Arial','UB',12);  // Définit la police 
    $pdf->Cell(30, 10, utf8_decode("Les SILUSINS "),0,0,"R");
    $pdf->SetFont('Arial','U',12);  // Définit la police 
    $pdf->Cell(0, 10, utf8_decode(": ULIS du collège Pierre Suc à Saint-Sulpice-la-Pointe"),0,0,"L");
    
    // Génération du document PDF
    unset($_SESSION['id_commande']);
    $pdf->Output('d','./pdf/Bon de commande'.$commande->get_num_commande().'.pdf', 'UTF-8');
    // Redirection vers une autre page
?>