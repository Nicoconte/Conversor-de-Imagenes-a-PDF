<?php

include $_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Core/Autoloader.php";

class Template 
{
	private $defaultTemplateHtml = null;

	public function returnTemplate($imagesTagToPut)
	{
		$this->defaultTemplateHtml = "<!DOCTYPE html>
				<html lang='en'>
				<head>
				<style>
					.genericPDFTemplate-container{
						width:100%;
						height:auto;
						display:flex;
						justify-content: center;
						align-items: center;
						flex-direction: column;
					}

					.genericPDFTemplate-container img{
						width:100%;
						height:100%;
						margin-top:10px;
						border:1px solid black;
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

		return $this->defaultTemplateHtml;
	}
}


?>