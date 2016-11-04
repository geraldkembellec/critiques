<?php
require('tfpdf.php');
$pdf = new tFPDF();
$pdf->SetAuthor('Catherine MENEUX');
$pdf->SetTitle('Biographie de Roger MARX');
$pdf->SetSubject('Biographie de Roger MARX');
$pdf->SetKeywords('Biographie, Roger MARX, critique d\'art');
$pdf->AddPage();
$pdf->Image('../images/logo_cap.png',10,6,60);
$pdf->SetFont('Arial','',32);
$pdf->Ln(100);
$pdf->Write(100,"Biographie de Roger MARX");
$pdf->AddPage();
$pdf->SetFont('Arial','',24);
$pdf->Write(5,"Biographie de Roger MARX");
$pdf->Ln(100);
$pdf->Cell(190,10,'Lien vers la page de la Base Critiques d\'Art',1,0,C,false,'http://critiquesdart.univ-paris1.fr/annuaire_critiques.php?lettre=Marx');
$pdf->Ln(50);
$pdf->Ln();
$pdf->SetFont('Times','I',18);
// Ajoute une police Unicode (utilise UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSans.ttf',true);
$pdf->SetFont('DejaVu','',14);
//$pdf->SetFont('Arial','',14);
// Charge une chaîne UTF-8 à partir d'un fichier
$txt = file_get_contents('../critiques/Roger_MARX/bio.txt');
//$pdf->Write(8,$txt);
$pdf->MultiCell(0,5,$txt,0,'J',false);
$pdf->Ln(50);
$pdf->MultiCell(180,10,utf8_encode('Biographie rédigée par Catherine MENEUX.'),0,'R',false);
$pdf->Ln(100);
$pdf->Output('Biographie.pdf', 'I');
?>