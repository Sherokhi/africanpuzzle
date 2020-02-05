<?php
//*********************************************************
// Societe: ETML
// Auteur : Lanz Romain
// Date : inconnue
// But : Afficher les suivis
//*********************************************************
// Modifications:
// Date : 20.05.2014
// Auteur : Lukyantsev  Vladislav
// Raison : Ajout du lien imprimer dans le menu option + ajouter la modalbox d'impression
//          ainsi que les class css "print-hidden" afin de masquer les elements non voulu lors d el'impression
//          Ajout de la gestion des droits dans le menu option
//*********************************************************

require('assets/fpdf/fpdf.php');

$GLOBALS['Logo'] = 'img/logo.png';

$marginLeft = 10;
$cursorY = 30;

//fonts
$fontSize = 12;
$titleSize = 15;
$lineHeight = 5;
$font = 'Times';

class PDF extends FPDF
{
	// En-tête
	function Header(){
		// Logo
		$this->Image($GLOBALS['Logo'],10,10,26);
		// Police Arial gras 15
		$this->SetFont('Arial','B',15);
		// Décalage à droite
		$this->Cell(80);
		// Titre
		$this->Cell(30,10,"Mes Suivis");
		// Saut de ligne
		$this->Ln(20);
	}

	// Pied de page
	function Footer(){
		// Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		// Police Arial italique 8
		$this->SetFont('Arial','I',8);
		// Numéro de page
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	
	function Title($title,$fontSize, $titleSize, $font){
		$this->SetFont($font,'',$titleSize);
		$this->Cell( 0, 0, $title, 0, 0, 'L' );
		$this->SetDrawColor(23,45,123);
		$this->Line(10, $this->GetY() + 3, 200, $this->GetY() + 3 );
		$this->SetFont($font,'',$fontSize);
	}
	
	function InfoLine($desc, $val, $pos, $align = 'R'){
		$this->Cell( 0, 0, '', 0, 0, $align );
		$this->SetTextColor(23,45,123);
		$this->Cell( -50, $pos, $desc, 0, 0, $align );
		$this->SetTextColor(0,0,0,'DF');
		$this->Cell( 0, $pos,$val, 0, 0, $align );
	}
	
	function writeArray($infos, $x, $h, &$cursorY){
		$y = 0;
		for($i = 0; $i < count($infos); $i++){
			$y = $x + $h * $i;
			$this->InfoLine($infos[$i][0],$infos[$i][1], $y);
		}
		$cursorY = $y;
	}
}


//init
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont($font,'',$fontSize);
 


foreach($follows as $follow){
	$pdf->SetY($cursorY);
	$pdf->SetX($marginLeft);
	$pdf->Title(utf8_decode("Le ".date_format($follow->add_date(), 'j F Y')." concernant ".$follow->student_first_name().' '.$follow->student_name())  ,$fontSize, $titleSize, $font);	
	
	$cursorY+= 7;
	
	$pdf->SetY($cursorY);
	
	$pdf->SetX($marginLeft + 10);
	$pdf->MultiCell(0,$lineHeight,utf8_decode($follow->content()),0,'J');
	
	if ($follow->mod_colleague_id()){
		$pdf->SetTextColor(23,45,123);
		
		$cursorY = $pdf->GetY()+3;
		
		$pdf->SetY($cursorY);
		
		$pdf->SetX($marginLeft + 10);
		$pdf->MultiCell(0,$lineHeight,'Modifié le '.date_format($follow->mod_date(), 'j F Y').' par '.$follow->mod_colleague_first_name().' '.$follow->mod_colleague_name(),0,'J');
		$pdf->SetTextColor(0,0,0,'DF');
	}
	
	$cursorY = $pdf->GetY() + 12;
	$pdf->SetY($cursorY);

	
}
     
$pdf->Output();


$this->_helper->viewRenderer->setNoRender(true);
$this->_helper->layout->disableLayout();