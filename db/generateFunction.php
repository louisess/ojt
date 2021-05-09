<?php
//session_start();  
class generateFunction extends FPDF{  


            
    function __construct($db){
        $this->conn = $db;
    }

    function generateCert(){
        require('fpdf.php');

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hello World!');
        $pdf->Output();
    }


}

?>