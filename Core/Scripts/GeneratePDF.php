<?php
include $_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Core/Autoloader.php";

$pdf = new PdfGenerator();

$pdf->generatePDF($_POST['images'], $_POST['config']);


?>