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




if (isset($_GET['pdf_report_generate'])){

	$certid = $_GET['certid'];
	$select = "SELECT participants.*,certificates.* FROM participants,certificates WHERE participants.eventid = '$certid' AND certificates.certid = '$certid'";

	$query = mysqli_query($conn, $select);
		while($row = mysqli_fetch_array($query)) {
		    $name = $row['name'];
		    $eventname = $row['eventname'];
		    //$lastname = $row['lastname'];

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

			// Add a page
			// This method has several options, check the source code documentation for more information.
			$pdf->AddPage();
			$imageFile = K_PATH_IMAGES.'LOGO_UB.png';
			$pdf->Image($imageFile, 110, 10, 70, '', 'PNG', '', 'M', false, 300, '', false, false, 0, false, false, false);
			$pdf->Ln(12);
			$pdf->SetFont('helvetica','','15');
			$html = '<p style="text-align:center">SCHOOL OF INFORMATION TECHNOLOGY</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->SetFont('helvetica','','20');
			$html = '<span color="red"><p style="text-align:center">CERTIFICATE OF PARTICIPATION</p></span>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(-10);
			$pdf->SetFont('helvetica','','10');
			$pdf->Cell(265,5, 'is awarded to', 0, 1, 'C');
			$pdf->Ln(10);
			$pdf->SetFont('times','','25');
			$html = '<p style="text-align:center">'. $name . '</p>';

			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(10);
			$pdf->SetFont('helvetica','','15');
			$html = '<p style="text-align:center">for actively participating during the seminar entitled</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Cell(270,5, $eventname,0,1,'C');
			$pdf->Ln(10);
			$pdf->SetFont('helvetica','','10');
			$html = '<p style="text-align:center">Your continued and unwavering support has contributed to the attainment of the university and schools objectives and realization of its mission of providing a balanced quality education.</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(5);
			$pdf->SetFont('helvetica', 'I', 10);
			//Page Number
			date_default_timezone_set("Asia/Dhaka");
			$today = date("F j, Y");
			$html = '<p style="text-align:center"> Given this ' .$today. '</p>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Ln(15);
			$pdf->SetFont('helvetica', '',12);
			$pdf->Cell(20,0,'Samantha Louise S. Magalong',0,0);
			$pdf->SetFont('helvetica', '',8);
			$pdf->Cell(20,15,'DEAN, SIT',0,1);
			//ob_end_clean();
			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output('Certificate.pdf', 'I');

			$pdf->Output("PDF Files/filename.pdf", "F"); //save the pdf to a folder setting `F`
			require_once('phpmailer/class.phpmailer.php'); //where your phpmailer folder is
			$mail = new PHPMailer();                    
			$mail->From = "omgmaryknoll@gmail.com";
			$mail->FromName = "Your name";
			$mail->AddAddress("omgmaryknoll@gmail.com");
			$mail->AddReplyTo("imnonomonster@gmail.com", "Your name");               
			$mail->AddAttachment("PDF Files/filename.pdf");      
			// attach pdf that was saved in a folder
			$mail->Subject = "Email Subject";                  
			$mail->Body = "Email Body";
			if(!$mail->Send())
			{
			   echo "Message could not be sent. <p>";
			   echo "Mailer Error: " . $mail->ErrorInfo;
			}
			else
			{
			   echo "Message sent";
			} //`the end`
				}

			}
//============================================================+
// END OF FILE
//============================================================+

?>
