<?php
// Include the main TCPDF library (search for installation path).
require_once('TCPDF-main/tcpdf.php');

/**
 * 
 */
class PDF extends TCPDF
{
	public function Header(){
		$imageFile = K_PATH_IMAGES.'LOGO_UB.png';
		$this->Image($imageFile, 110, 10, 70, '', 'PNG', '', 'M', false, 300, '', false, false, 0, false, false, false);
		$this->Ln(15);
		//$this->SetFont('helvetica','B','20');
		//Cell (189 total width of A4, height, border, line)
		//$this->Cell(260,5, 'SCHOOL OF INFORMATION  TECHNOLOGY', 0, 1, 'C');
		$this->SetFont('helvetica','','15');
		$html = '<p style="text-align:center">SCHOOL OF INFORMATION TECHNOLOGY</p>';
		//$this->Ln(10);
		$this->writeHTML($html, true, false, true, false, '');
		$this->SetFont('helvetica','','20');
		$html = '<span color="red"><p style="text-align:center">CERTIFICATE OF PARTICIPATION</p></span>';
		$this->writeHTML($html, true, false, true, false, '');
		$this->Ln(-10);
		$this->SetFont('helvetica','','10');
		$this->Cell(265,5, 'is awarded to', 0, 1, 'C');
		$this->Ln(10);
		$this->SetFont('times','','25');
		$html = '<p style="text-align:center">MARYKNOLL NAZARETH M. CABIGAS</p>';
		$this->writeHTML($html, true, false, true, false, '');
		$this->Ln(10);
		$this->SetFont('helvetica','','15');
		$html = '<p style="text-align:center">"for actively participating during the seminar entitled <br> "<b><i>Hackathon Survival Kit.</i></b>"</p>';
		$this->writeHTML($html, true, false, true, false, '');
		$this->Ln(10);
		$this->SetFont('helvetica','','10');
		$html = '<p style="text-align:center">Your continued and unwavering support has contributed to the attainment of the university and schools objectives and realization of its mission of providing a balanced quality education.</p>';
		$this->writeHTML($html, true, false, true, false, '');
		//$this->SetY(189);
		$this->Ln(5);
		$this->SetFont('helvetica', 'I', 10);
		//Page Number
		date_default_timezone_set("Asia/Dhaka");
		$today = date("F j, Y");
		$html = '<p style="text-align:center"> Given this ' .$today. '</p>';
		$this->writeHTML($html, true, false, true, false, '');
		//$this->Cell(25,5, 'Given this: ' .$today,0,0,'L');

		//$html = '<p style="text-align:center">is awarded to</p>';
		//$this->writeHTML($html, true, false, true, false, '');
		//$this->SetFont('helvetica','B','15');
		
		//$this->SetFont('helvetica','','10');
		//$this->Cell(260, 0, 'General Luna Road, Baguio City Philippines 2600', 0, 1, 'C');
		//$this->SetFont('helvetica','','8');
		//$this->Ln(1);
		//$this->Cell(260,5, 'Telefax No.: (074) 442-3071                  Website: www.ubaguio.edu                E-mail Address: ub@ubaguio.edu', 0, 1, 'C');
	}

	public function Footer(){
		
		//$this->Cell(164, 5, 'Page ')
		//$this->SetY(189);
		$this->Ln(-15);
		$this->SetFont('helvetica', '',12);
		$this->Cell(20,0,'Samantha Louise S. Magalong',0,0);
		$this->SetFont('helvetica', '',8);
		$this->Cell(20,15,'DEAN, SIT',0,1);



	}
}

// create new PDF document
$pdf = new PDF('l', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('University of Baguio');
$pdf->SetTitle('Certificate');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>