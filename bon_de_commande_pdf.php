<?php
    require_once('fpdf/fpdf.php');
    require('init.php');
    session_start(); //demarage des sessions
    $commande = $_SESSION['commande'];    
    $utilisateur = isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur'] : '';
    $type_commande= isset($_SESSION['type_commande']) ? $_SESSION['type_commande'] : 'W';    
    $prix = isset($_SESSION['total_commande']) ? $_SESSION['total_commande'] : '';
    $mode_paiement = isset($_POST['mode_paiement']) ? $_POST['mode_paiement'] : '';
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $classe = isset($_POST['classe']) ? $_POST['classe'] : '';
    $tel = isset($_POST['tel']) ? $_POST['tel'] : '';
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';


    $id_commande = $commande->get_id_commande();
    $commandeDAO = new CommandeDAO; 
    $commande2 = new Commande(array(
        'id_commande' => $commande->get_id_commande(),
        'num_commande' => $type_commande.$commande->get_id_commande(),
        'total_commande' => $prix,
        'nom_commande'=>$nom,
        'prenom_commande'=>$prenom,
        'classe_commande'=>$classe,
        'tel_commande'=>$tel,
        'mail_commande'=>$mail,
        'mode_paiement' => $mode_paiement,
        'id_statut'=>2,
    ));
    $commandeDAO->update($commande2); 
    $commande =$commandeDAO->find($id_commande);
    $_SESSION['id_commande'] = $commande->get_id_commande(); 
    //definition des constantes date qui renvois la date du jour et EURO qui atribut le signe €
    define('EURO'," ".utf8_encode(chr(128))); 

    $pdf = new Mon_PDF();
    $pdf->SetAutoPageBreak(1,40);
    $pdf->SetTitle('Commande'.$commande->get_num_commande(), true);  // déﬁnit le titre du document
    $pdf->SetAuthor( $commande->get_nom_commande(), true);  // déﬁnit le créateur du document
    $pdf->mon_fichier='Commande'.$commande->get_num_commande().'.pdf';


    $pdf->AddPage(); // Crée une nouvelle page
    $pdf->SetFont('Arial','B',20);  // Définit la police 
    $pdf->Image('img/logo.jpg',10,10,50,50); //Logo
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
    $pdf->Cell(40, 5, utf8_decode("Tél : ".$commande->get_tel_commande()),0,0,'L');
    $pdf->Cell(25, 5, utf8_decode(" "),0,0,'L');
    $pdf->Cell(0, 5, utf8_decode("Mail : ".$commande->get_mail_commande()),0,0,'L');

    $pdf->Ln(10); //Saut de lignes

    $pdf->SetFont('Arial','B',18);  // Définit la police 
    $pdf->SetXY(10,65);
    $pdf->Cell(0, 12.5, utf8_decode("Bon de commande WEB : ".$commande->get_num_commande()),1,0,'C');
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
    $pdf->Output('f','./pdf/'.$pdf->mon_fichier);
    // Redirection vers une autre page
    if(!empty($utilisateur)){
        if($utilisateur->get_id_role() == 2){
            header('Location: administration.php');     
        }elseif($utilisateur->get_id_role() == 3){
            header('Location: administration.php');     
        }
    }else{
        header('Location: commande_validation.php');     
    }   
?>