<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
include ('db/dbcon.php');
include ('db/dbFunction.php');

require_once('fpdf/fpdf.php');
require_once('fpdi2/src/autoload.php');



$select = "SELECT * FROM organizers ORDER BY id";
$stmt = $this->conn->prepare($sql);
$stmt->execute();

//$result = $conn->query($select);

$pdf = new Fpdi();

$pageCount = $pdf->setSourceFile('pdf1.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage('L');
//L for landscape
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at position 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx, 10, 10, 100);

$pdf->SetFont('Arial','B',14);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  $id = $row->id;
  $name = $row->fname;
  $address = $row->lname;
  $phone = $row->email;
  $pdf->Cell(20,10,$id,1);
  $pdf->Cell(40,10,$fname,1);
  $pdf->Cell(80,10,$address,1);
  $pdf->Cell(40,10,$phone,1);
  $pdf->Ln();
}
$pdf->Output();

// now write some text above the imported page
/**
$pdf->SetFont('Helvetica');
$pdf->SetTextColor(255, 0, 0);
$pdf->SetXY(30, 30);
$pdf->Write(0, 'Hello this is a message');

$files = $pdf->Output('I', 'generated.pdf');

$zip = new ZipArchive();
$zip_name = time().".zip"; // Zip name
$zip->open($zip_name,  ZipArchive::CREATE);
foreach ($files as $file) {
  echo $path = "uploadpdf/".$file;
  
  if(file_exists($path)){
  $zip->addFromString(basename($path),  file_get_contents($path));  
  }
  else{
   echo"file does not exist";
  }
}
$zip->close();

$pdf = new FPDF();
$pdf->AddPage();
**/






?>