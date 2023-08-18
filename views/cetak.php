<?php
include('../assets/library/tcpdf.php');

$pdf = new TCPDF('P', 'mm', 'A4');

$pdf->AddPage();

$pdf->Output();
