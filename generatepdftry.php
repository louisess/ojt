<?php
require_once('pdf/TCPDF-main/tcpdf.php');

$servername = "localhost";
$username = "root";
$password = "";
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
			$pdf->SetTitle('Certificates');
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
			$pdf->AddPage();

if (isset($_GET['pdf_report_generate'])){

	$certid = $_GET['certid'];
	$select = "SELECT certificates.* FROM certificates WHERE certificates.certid = '$certid'";

	$query = mysqli_query($conn, $select);
	//	while($row = mysqli_fetch_array($query)) {
	       $row = mysqli_fetch_array($query);
		    //$name = $row['name'];
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
		    $recog = $row['recognition'];
		    $presline = $row['presentationline'];
		    $logo1 = $row['logo1'];
		    $logo2 = $row['logo2'];
		    $logo3 = $row['logo3'];
		    //$pid = $row['pid'];
		    date_default_timezone_set("Asia/Dhaka");
			$today = date("F j, Y");
		   

			$pdf->Ln(-15);
            $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0)));
            $pdf->SetFillColor(255,255,255);
            $pdf->SetTextColor(0,0,0);
            $text="";
            $pdf->Cell(0, 177, $text, 1, 1, 'C', 1, 0);
            $pdf->Ln(-173);
            $signpath = 'uploads/';
            
            $logocert1 = $signpath.$logo1;
            $logocert2 = $signpath.$logo2;
            $logocert3 = $signpath.$logo3;
            //$imageFile = K_PATH_IMAGES.'LOGO_UB.png';
            $emptyrow = ' ';
            
            $html = '<p style="text-align:center">
						<table align="center" style="width:100%">
						  <tbody>
						    <tr>
						      <td>
						      <!--logo 1-->
						      <img align="center" width="210px" height="55px" src="'. $logocert1 .'">
						      </td>
						      
						      <td>
						      <!--logo 2-->
						      <img align="left" width="210px" height="55px" src="'. $logocert2 .'">
	                           </td>
	                           
						      <td>
						      <!--logo 3-->
						      <img align="center" width="210px" height="55px" src="'. $logocert3 .'">
						      </td>

						    </tr>
						    
						  </tbody>
						</table>
						</p>

				';
				$pdf->writeHTML($html, true, false, true, false, '');
           
            
            $pdf->Ln(-3);
			$pdf->SetFont('helvetica','','12');
			$html = '<p style="text-align:center">'. $department .'</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			
			$pdf->Ln(3);
			$pdf->SetFont('helvetica','','10');
			$pdf->Cell(265,4, 'This', 0, 1, 'C');
			
			$pdf->Ln(-10);
			$pdf->SetFont('helvetica','','20');
			$html = '<span color="red"><p style="text-align:center">'. $title .'</p></span>';
			$pdf->writeHTML($html, true, false, true, false, '');
			
			$pdf->Ln(-10);
			$pdf->SetFont('helvetica','','10');
			$pdf->Cell(265,4, $presline, 0, 1, 'C');
			
			$pdf->Ln(5);
			$pdf->SetFont('times','','30');
			$html = '<p style="text-align:center">Juan Dela Cruz</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			
			$pdf->Ln(5);
			$pdf->SetFont('helvetica','','10');
			$html = '<p style="text-align:center">'. $recog .'</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			
			$pdf->Ln(5);
			$pdf->SetFont('helvetica', 'IB','18');
			$pdf->Cell(270,5, '"'. $eventname . '"' ,0,1,'C');
			
			$pdf->Ln(5);
			$pdf->SetFont('helvetica','','12');
			$html = '<p style="text-align:center">Held on '.$eventdate.'<br>  '. $desc .'</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			
			$pdf->Ln(8);
			$pdf->SetFont('helvetica', '',10);
			$orgname1 = array_pad(explode(" - ", $organizer1), 2, null);
			$orgname2 = array_pad(explode(" - ", $organizer2), 2, null);
			$orgname3 = array_pad(explode(" - ", $organizer3), 2, null);
			$signpath = 'uploads/';
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
						      <b>'.$orgname1[0].'</b>
						      <br>
						      '.$orgname1[1].'</td>
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
						      <b>'.$orgname1[0].'</b>
						      <br>
						      '.$orgname1[1].'
						      </td>
						      <td>

						      </td>
						      <td>
						      <img width="50px" height="30px" src="'. $sign2 .'">
						      <br>
						      <b>'.$orgname2[0].'</b>
						      <br>
						      '.$orgname2[1].'
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
						      <b>'.$orgname1[0].'</b>
						      <br>
						      '.$orgname1[1].'
						      </td>
						      
						      <td>
						      <b>'.$orgname2[0].'</b>
						      <br>
						      '.$orgname2[1].'
						      </td>
						      <td>
						      <b>'.$orgname3[0].'</b>
						      <br>
						      '.$orgname3[1].'
						      </td>

						    </tr>
						    
						  </tbody>
						</table>
						</p>
				';
				$pdf->writeHTML($html, true, false, true, false, '');
			}
			
			$pdf->Ln(8);
			$pdf->SetFont('helvetica', 'I',7);
			
			$dategiventmp = array_pad(explode("to", $eventdate), 2, null);
			$formonth = array_pad(explode(" ", $eventdate), 2, null);
		    $month = $formonth[0];
			if($dategiventmp[1] == null){
			    $dategiven = $dategiventmp[0];
			}else{
			    
			    
			     $firstpart = $dategiventmp[1];
			    $dategiven1 = array_pad(explode(" ", $firstpart), 2, null);
			    //$month = $dategiven1[0];
			    $fordate = $dategiventmp[1];
			    $dategiven = $month.$fordate;
			    
			    
			}
			$html = '<p style="text-align:left">    Verify at <a href="certcheck.php">certicreateojt.000webhostapp.com/certcheck.php</a><br>
			    Certificate Code: UB - 1234 <br>
			    Date Given: '.$dategiven.'
			</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
	
			$pdf->Output('Certificate.pdf', 'I');   
            }



			
//============================================================+
// END OF FILE
//============================================================+

?>
