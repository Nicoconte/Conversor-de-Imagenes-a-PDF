<?php

//Hay problemas al tratar de importar la clase PDF. Preferible usar funciones y llamarlas desde aca

require $_SERVER['DOCUMENT_ROOT'] . '/ConverterImgToPdf/vendor/autoload.php';
use Dompdf\Dompdf;

function deleteAllUploadedFilesAfterDownload()
{
	$filesFromDir = scandir($_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Uploads/");

	foreach($filesFromDir as $file)
	{
		unlink($_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Uploads/" . $file);
	}
}

function generatePDF($images, $configuration="", $password="")
{


	$config = explode(",", $configuration);

	$pdfName = empty($config[2]) ? "No le ha puesto ningun nombre a este archivo.pdf" : $config[2] . ".pdf";
	$typeOfPage = (empty($page)) ? "A4" : $config[0];
	$pageOrientation = (empty($orientation)) ? "vertical" : $config[1];
	$pdfPassword = (empty($passowrd)) ? "" : $password;

	$imageToPut = explode(",", $images);
		
	$pdf = new Dompdf();
	$pdf->set_option('isHtml5ParserEnabled', true);

	$htmlTemplate = "";

	foreach($imageToPut as $image) {
		$htmlTemplate .= "<img class='mt-1' src='../../Uploads/".$image."' style='width:80%; height:50%;'>";
	}

	$pdf->load_html($htmlTemplate);
	$pdf->set_paper($typeOfPage, $pageOrientation);

	$pdf->render();
	$pdf->stream($filename=$pdfName);

	deleteAllUploadedFilesAfterDownload();

}


generatePDF($_POST['images'], $_POST['config']);




?>