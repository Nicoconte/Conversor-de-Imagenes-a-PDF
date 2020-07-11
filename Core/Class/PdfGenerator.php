<?php

include $_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Core/Autoloader.php";

require $_SERVER['DOCUMENT_ROOT'] . '/ConverterImgToPdf/vendor/autoload.php';
use Dompdf\Dompdf;

class PdfGenerator
{
	public function generatePDF($images, $configurations="")
	{	

		$template = new Template();
		$image = new Image();

		$config = explode(",", $configurations);
		
		$typeOfPage = (empty($config[0])) ? "A4" : $config[0];
		$pageOrientation = (empty($config[1])) ? "vertical" : $config[1];
		$name = (empty($config[2])) ? "Nombre predeterminado.pdf" : $config[2] . ".pdf";

		$pdf = new Dompdf();
		$pdf->set_option("isHtml5ParserEnabled", true);

		$pdf->load_html( $template->returnTemplate( $image->getImagesTag($images) ) );
		$pdf->set_paper($typeOfPage, $pageOrientation);

		$pdf->render();
		$pdf->stream($filename=$name);

		$image->deleteAllSessionImages($image->getVanillaImages($images));
	}
}

?>