<?php
/**
 * Classe héritant de fpdf
 * On s'en sert pour pouvoir ajouter une entête et un bas de page
 */
class Mon_pdf extends FPDF {

  var $mon_fichier='???'; 

  function Footer() {
    //Variables nécessaire au footer 
    $mode_paiement = $_SESSION['mode_paiement'];  
    $prix = $_SESSION['total_commande']; 
    //definition des constantes date qui renvois la date du jour et EURO qui atribut le signe €
    date_default_timezone_set('Europe/Paris'); //instanciation du fuseau horaire
    $date = date('d/m/Y');
    

    //  
    $this->SetY(-35);
    $this->SetFont('Arial','',12);  // Définit la police 
    $this->RoundedRect(22.5,260,50,30,5,"D");
    $this->Cell(17.5, 5, utf8_decode(" "),0,0,'L');
    $this->SetFont('Arial','UB',12);  // Définit la police 
    $this->Cell(40, 5, utf8_decode("Date et signature : "),0,0,'C');
    $this->SetFont('Arial','',12);  // Définit la police 
    $this->RoundedRect(80,260,50,30,5,"D");
    $this->SetFont('Arial','',12);  // Définit la police 
    $this->Cell(17.5, 5, utf8_decode(" "),0,0,'L');
    $this->SetFont('Arial','UB',12);  // Définit la police 
    $this->Cell(40, 5, utf8_decode("Mode de paiement : "),0,0,'C');
    $this->RoundedRect(137.5,260,50,30,5,"D");
    $this->SetFont('Arial','',12);  // Définit la police 
    $this->Cell(15, 5, utf8_decode(" "),0,0,'L');
    $this->SetFont('Arial','UB',12);  // Définit la police 
    $this->Cell(45, 5, utf8_decode("Prix Total :"),0,1,'C');
    $this->SetFont('Arial','',12);  // Définit la police 
    $this->Cell(17.5, 5, utf8_decode(" "),0,0,'L');
    $this->Cell(40,8,utf8_decode($date),0,0,"C");
    $this->SetFont('Arial','',12);  // Définit la police 
    $this->Cell(75, 5, utf8_decode(" "),0,0,'L');
    $this->SetFont('Arial','',10);  // Définit la police 
    $this->MultiCell(40, 5, utf8_decode("(à payer au moment\nde la commande) :"),0,'C');
    $this->SetFont('Arial','',12);  // Définit la police 
    $this->Cell(75, 5, utf8_decode(" "),0,0,'L'); 
    if ($mode_paiement == "especes"){
        $this->SetFont('Arial','',12);  // Définit la police 
        $this->Cell(40, 5, utf8_decode("Espèces"),0,2,'C');
    }elseif($mode_paiement == "cheque"){
        $this->SetFont('Arial','',12);  // Définit la police 
        $this->MultiCell(40, 5, utf8_decode("Chèque\nà l'ordre de L'OCCE"),0,'C');
    }
    $this->SetXY(140,-15);
    $this->Cell(40, 5, utf8_decode($prix.EURO),0,0,'C');
  }

}