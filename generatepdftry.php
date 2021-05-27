<?php
require_once('pdf/TCPDF-main/tcpdf.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "certdbase";

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

if (isset($_GET['pdf_report_generate'])){

	$certid = $_GET['certid'];
	$select = "SELECT participants.*,certificates.* FROM participants,certificates WHERE participants.eventid = '$certid' AND certificates.certid = '$certid'";

	$query = mysqli_query($conn, $select);
		while($row = mysqli_fetch_array($query)) {
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
		    $pid = $row['pid'];
		   

			// Add a page
			// This method has several options, check the source code documentation for more information.
			$pdf->AddPage();
			$imageFile = K_PATH_IMAGES.'LOGO_UB.png';
			$pdf->Image($imageFile, 110, 10, 70, '', 'PNG', '', 'M', false, 300, '', false, false, 0, false, false, false);
			$pdf->Ln(12);
			$pdf->SetFont('helvetica','','15');
			$html = '<p style="text-align:center">'. $department .'</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(-5);

			$pdf->SetFont('helvetica','','20');
			$html = '<span color="red"><p style="text-align:center">'. $title .'</p></span>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(-10);
			$pdf->SetFont('helvetica','','10');
			$pdf->Cell(265,4, 'is awarded to', 0, 1, 'C');
			$pdf->Ln(5);
			$pdf->SetFont('times','','25');
			$html = '<p style="text-align:center">Juan Dela Cruz</p>';

			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(5);
			$pdf->SetFont('helvetica','','15');
			$html = '<p style="text-align:center">for actively participating during the seminar entitled</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->SetFont('helvetica', 'IB','18');
			$pdf->Cell(270,5, '"'. $eventname . '"' ,0,1,'C');
			$pdf->Ln(5);
			$pdf->SetFont('helvetica','','10');
			$html = '<p style="text-align:center">'. $desc .'</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(4);
			$pdf->SetFont('helvetica', 'I', 15);
			//Page Number
			//date_default_timezone_set("Asia/Dhaka");
			//$today = date("F j, Y");
			$givendate = array_pad(explode("to", $eventdate), 2, null);
			if($givendate[1] == null){
				$html = '<p style="text-align:center"> Given this ' .$givendate[0]. '</p>';
			}else{
				$html = '<p style="text-align:center"> Given this ' .$givendate[1]. '</p>';
			}
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(20);
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
						      <img width="50px" height="20px" src="'. $sign1 .'">
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
						      <img width="50px" height="20px" src="'. $sign1 .'">
						      <br>
						      '.$orgname1[0].'
						      <br>
						      <b>'.$orgname1[1].'</b>
						      </td>
						      <td>

						      </td>
						      <td>
						      <img width="50px" height="20px" src="'. $sign2 .'">
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
			
			$pdf->Ln(3);
			$pdf->SetFont('helvetica', 'I',10);
			$html = '<p style="text-align:left">Certificate Code: UB - '.$certid.$pid.'<br>
			Visit certcheck.php to verify certificate using the provided code.
			</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			


			//$pdf->Cell(10,12,'Certificate Code: UB - '. $pid,0,1);
			//$pdf->SetFont('helvetica', '',9);
			//$html = '<p style="text-align:left">Visit verify.php to verify and download your certificate using the provided code.</p>';
			//$pdf->writeHTML($html, true, false, true, false, '');
			//$pdf->Cell(20,0,'Visit verify.php to verify and download your certificate using the provided code.',0,1);
			
			//$pdf->SetFont('helvetica', '',8);
			//$pdf->Cell(20,15,'DEAN, SIT',0,1);
			//ob_end_clean();
			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			
			// $pdf->Output("PDF Files/filename.pdf", "F"); //save the pdf to a folder setting `F`
			// require_once('phpmailer/class.phpmailer.php'); //where your phpmailer folder is
			// $mail = new PHPMailer();                    
			// $mail->From = "omgmaryknoll@gmail.com";
			// $mail->FromName = "Your name";
			// $mail->AddAddress("omgmaryknoll@gmail.com");
			// $mail->AddReplyTo("imnonomonster@gmail.com", "Your name");               
			// $mail->AddAttachment("PDF Files/filename.pdf");      
			// // attach pdf that was saved in a folder
			// $mail->Subject = "Email Subject";                  
			// $mail->Body = "Email Body";
			// if(!$mail->Send())
			// {
			//    echo "Message could not be sent. <p>";
			//    echo "Mailer Error: " . $mail->ErrorInfo;
			// }
			// else
			// {
			//    echo "Message sent";
			// } //`the end`
				}
				$pdf->Output('Certificate.pdf', 'I');


			}
//============================================================+
// END OF FILE
//============================================================+

?>
