<?php

include $_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Core/Autoloader.php";

class Template 
{
	private $templateHtml = null;

	/*
	Ver si hacerlo dinamico y permitir templates externos o si dejarlo asi
	public function generateTemplateFile($html)
	{
		$file = fopen($_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Core/Templates/template.php", "a+");
		fwrite($file, $html);
	}

	public function deleteTemplateAfterDownload()
	{
		unlink($_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Core/Templates/template.php");
	}*/

	public function returnTemplate($imagesTagToPut)
	{
		$this->templateHtml = "<!DOCTYPE html>
				<html lang='en'>
				<head>
				<style>
					.genericPDFTemplate-container{
						width:100%;
						height:auto;
						background-color:red;
						display:flex;
						justify-content: center;
						align-items: center;
						flex-direction: column;		
					}

					.genericPDFTemplate-container img{
						width:100%;
						height:100%;
						margin-top:10px;
					}

				</style>
				</head>

				<body>
					<div class='genericPDFTemplate-container'>
						<blockquote>
							" . $imagesTagToPut . "
						</blockquote>
					</div>
				</body>
				</html>";

		return $this->templateHtml;
	}
}


?>