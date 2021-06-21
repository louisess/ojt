<?php
require_once('pdf/TCPDF-main/tcpdf.php');

$servername = "localhost";
$username = "id16930867_admin";
$password = "LbYiw!I{E\GQq6wr";
$dbname = "id16930867_certdbase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


 // create new PDF document
			$pdf = new TCPDF('l', 'mm', 'A4', true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('University of Baguio');
			$pdf->SetTitle('Certificate');
			$pdf->SetSubject('');
			$pdf->SetKeywords('');

			// remove default header/footer
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

			// set auto page breaks
			//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

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

if (isset($_GET['pdf_report'])){

	$certid = $_GET['verify'];
	$select = "SELECT participants.*,certificates.* FROM participants,certificates WHERE CONCAT (certificates.certid,participants.pid) = '$certid'";

	$query = mysqli_query($conn, $select);
		while($row = mysqli_fetch_array($query)) {
			$eventid = $row['certid'];
		    $name = $row['name'];
		    $eventname = $row['eventname'];
		    $eventdate = $row['eventdate'];
		    $venue = $row['venue'];
		    $organizer1 = $row['organizer1'];
		    $organizer2 = $row['organizer2'];
		    $organizer3 = $row['organizer3'];
		    $signatory1 = $row['signatory1'];
		    $signatory2 = $row['signatory2'];
		    $signatory3 = $row['signatory3'];
		    $department = $row['department'];
		    $title = $row['title'];
		    $desc = $row['description'];
		    $pid = $row['pid'];
		    $recog = $row['recognition'];
		    $presline = $row['presentationline'];
		    $logo1 = $row['logo1'];
		    //$lastname = $row['lastname'];
		     
				}
			$pdf->AddPage();
			$pdf->Ln(-15);
            $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0)));
            $pdf->SetFillColor(255,255,255);
            $pdf->SetTextColor(0,0,0);
            $text="";

            $pdf->Cell(0, 177, $text, 1, 1, 'C', 1, 0);
            $signpath = 'uploads/';
            $logocert = $signpath.$logo1;
            $imageFile = K_PATH_IMAGES.'LOGO_UB.png';
            $emptyrow = ' ';
            if($logo1 == $emptyrow){
                $pdf->Image($imageFile, 110, 17, 70, '', 'PNG', '', 'M', false, 300, '', false, false, 0, false, false, false);
               
                
            }else if($logo1 !== $emptyrow){
                $pdf->Ln(-170);
                 $html = '<p style="text-align:center">
							<table>
						  <thead>
						  </thead>
						  <tbody>
						    <tr>
						      <td>
						        <img width="200px" height="50px" src="'. $imageFile .'">
						      </td>
						      <td>
						      <img width="200px" height="50px" src="'. $logocert .'">

						      </td>

						    </tr>
						    
						  </tbody>
						</table>
						</p>

				';
				$pdf->writeHTML($html, true, false, true, false, '');
            }
			
			
			$pdf->Ln(10);
			$pdf->SetFont('helvetica','','15');
			$html = '<p style="text-align:center">'. $department .'</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(-5);

			$pdf->SetFont('helvetica','','20');
			$html = '<span color="red"><p style="text-align:center">'. $title .'</p></span>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(-10);
			$pdf->SetFont('helvetica','','10');
			$pdf->Cell(265,4, $presline, 0, 1, 'C');
			$pdf->Ln(5);
			$pdf->SetFont('times','','30');
			$html = '<p style="text-align:center">'. $name . '</p>';

			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(5);
			$pdf->SetFont('helvetica','','10');
			$html = '<p style="text-align:center">'. $recog .'</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(5);
			$pdf->SetFont('helvetica', 'IB','18');
			$pdf->Cell(270,5, '"' . $eventname . '"',0,1,'C');
			$pdf->Ln(5);
			$pdf->SetFont('helvetica','','12');
				$html = '<p style="text-align:center">Held this '.$eventdate.'<br>  '. $desc .'</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(4);
			$pdf->SetFont('helvetica', 'I', 12);
			//Page Number
			date_default_timezone_set("Asia/Dhaka");
			$today = date("F j, Y");
			$html = '<p style="text-align:center">Given '. $today .'</p>';
// 			$givendate = array_pad(explode("to", $eventdate), 2, null);
// 			if($givendate[1] == null){
// 				$html = '<p style="text-align:center"> Given this ' .$givendate[0]. '</p>';
// 			}else{
// 				$html = '<p style="text-align:center"> Given this ' .$givendate[1]. '</p>';
// 			}
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(8);
			$pdf->SetFont('helvetica', '',10);
			$orgname1 = array_pad(explode(" - ", $organizer1), 2, null);
			$orgname2 = array_pad(explode(" - ", $organizer2), 2, null);
			$orgname3 = array_pad(explode(" - ", $organizer3), 2, null);
			
			$sign1 = $signpath.$signatory1;
			$sign2 = $signpath.$signatory2;
			$sign3 = $signpath.$signatory3;
			//$pdf->Image($sign1, '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
			if ($organizer1 !== ' - ' && $organizer2 == ' - ' && $organizer3 == ' - '){
				$html = '<p style="text-align:center">
							<table>
						  <thead>
						  </thead>
						  <tbody>
						    <tr>
						      <td>
						      
						      </td>
						      <td>
						      <img width="50px" height="30px" src="'. $sign1 .'">
						      <br>
						      '.$orgname1[0].'
						      <br>
						      <b>'.$orgname1[1].'</b></td>
						      <td>
						      
						      </td>

						    </tr>
						    
						  </tbody>
						</table>
						</p>

				';
				$pdf->writeHTML($html, true, false, true, false, '');
				// /$pdf->Ln(1);
				


			}else if($organizer1 !== null && $organizer2 !== null && $organizer3 == ' - '){
				$html = '
				<p style="text-align:center">
							<table>
						  <thead>
						  </thead>
						  <tbody>
						    <tr>
						      <td>
						      <img width="50px" height="30px" src="'. $sign1 .'">
						      <br>
						      '.$orgname1[0].'
						      <br>
						      <b>'.$orgname1[1].'</b>
						      </td>
						      <td>

						      </td>
						      <td>
						      <img width="50px" height="30px" src="'. $sign2 .'">
						      <br>
						      '.$orgname2[0].'
						      <br>
						      <b>'.$orgname2[1].'</b>
						      </td>

						    </tr>
						    
						  </tbody>
						</table>
						</p>';
				$pdf->writeHTML($html, true, false, true, false, '');
				
			}else if($organizer1 !== ' - ' && $organizer2 !== ' - ' && $organizer3 !== ' - '){
				$html = '
				<p style="text-align:center">
					<table>
						  <thead>
						  </thead>
						  <tbody>
						    <tr>
						      <td>   
						      '.$orgname1[0].'
						      <br>
						      <b>'.$orgname1[1].'</b>
						      </td>
						      
						      <td>
						      '.$orgname2[0].'
						      <br>
						      <b>'.$orgname2[1].'</b>
						      </td>
						      <td>
						      '.$orgname3[0].'
						      <br>
						      <b>'.$orgname3[1].'</b>
						      </td>

						    </tr>
						    
						  </tbody>
						</table>
						</p>
				';
				$pdf->writeHTML($html, true, false, true, false, '');
			}
			
			$pdf->Ln(-2);
			$pdf->SetFont('helvetica', 'I',8);
			$html = '<p style="text-align:center">Certificate Code: UB - '.$eventid.$pid.'
			</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output($eventname.'.pdf', 'I');


			}
//============================================================+
// END OF FILE
//============================================================+

?>
