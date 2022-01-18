<?php
    require_once('fpdf/fpdf.php');
    require('init.php');
    session_start(); //demarage des sessions
    $commande = $_SESSION['commande'];    
    $mode_paiement = isset($_POST['mode_paiement']) ? $_POST['mode_paiement'] : '';
    $prix = isset($_POST['prix']) ? $_POST['prix'] : '';

    $pdf = new FPDF();
    //definition des constantes date qui renvois la date du jour et EURO qui atribut le signe €
    date_default_timezone_set('Europe/Paris'); //instanciation du fuseau horaire
    $date = date('d/m/Y');
    define('EURO'," ".utf8_encode(chr(128))); 

    $pdf->SetTitle('Bon de commande les Silusins pdf', true);  // déﬁnit le titre du document
    $pdf->SetAuthor( $commande->get_nom_commande(), true);  // déﬁnit le créateur du document

    $pdf->AddPage(); // Crée une nouvelle page
    $pdf->SetFont('Arial','',20);  // Définit la police 
    $pdf->Image('img/20.jpg',10,10,50,50); //Logo
    $pdf->Cell(0, 20, utf8_decode("SILUSIN"),0,1,'C');
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
    $pdf->Rect(22.5,62,50,30,"D");
    $pdf->Cell(17.5, 5, utf8_decode(" "),0,0,'L');
    $pdf->Cell(40, 5, utf8_decode("Date et signature : "),0,0,'C');
    $pdf->Rect(80,62,50,30,"D");
    $pdf->Cell(17.5, 5, utf8_decode(" "),0,0,'L');
    $pdf->Cell(40, 5, utf8_decode("Mode de paiement : "),0,0,'C');
    $pdf->Rect(137.5,62,50,30,"D");
    $pdf->Cell(15, 5, utf8_decode(" "),0,0,'L');
    $pdf->Cell(45, 5, utf8_decode("Prix Total :"),0,1,'C');
    $pdf->Cell(17.5, 5, utf8_decode(" "),0,0,'L');
    $pdf->Cell(40,8,utf8_decode($date),0,0,"C");
    $pdf->Cell(75, 5, utf8_decode(" "),0,0,'L');
    $pdf->SetFont('Arial','',10);  // Définit la police 
    $pdf->MultiCell(40, 5, utf8_decode("(à payer au moment\nde la commande) :"),0,'C');
    if ($mode_paiement == "especes"){
        $pdf->SetFont('Arial','',12);  // Définit la police 
        $pdf->SetXY(85,75);
        $pdf->Cell(40, 5, utf8_decode("Espèces"),0,0,'C');
    }else{
        $pdf->SetFont('Arial','',12);  // Définit la police 
        $pdf->SetXY(85,72.5);
        $pdf->MultiCell(40, 5, utf8_decode("Chèque \nà l'ordre de l'OCCE"),0,'C');
    }
    
    // Génération du document PDF
    $pdf->Output('f','./pdf/commande.pdf' );
    // Redirection vers une autre page
    header('Location: panier.php'); 
?>