<?php

// Définition facultative du répertoire des polices systèmes
// Sinon tFPDF utilise le répertoire [chemin vers tFPDF]/font/unifont/
// define("_SYSTEM_TTFONTS", "C:/Windows/Fonts/");

require('tfpdf.php');

$pdf = new tFPDF();
$pdf->AddPage();

// Ajoute une police Unicode (utilise UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSans.ttf',true);
$pdf->SetFont('DejaVu','',14);
//$pdf->SetFont('Arial','',14);
// Charge une chaîne UTF-8 à partir d'un fichier
$txt = file_get_contents('Roger_MARX.txt');
$pdf->Write(8,$txt);

// Sélectionne une police standard (utilise windows-1252)

$pdf->Ln(10);
$pdf->Write(5,"----------");

$pdf->Output();
?>
