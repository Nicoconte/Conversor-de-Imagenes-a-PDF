<?php

class Image
{

	protected $_path = null;
	protected $_fileName = null;
	protected $_dirTarget = null; 
	protected $_fileAmount = null;

	public function uploadImageToServer($file)
	{
		if ($file['error'] < 0 )
		{
			echo die(json_encode(array("error" => "Error con la carga")));
		}	

		$this->_fileAmount = count($file);

		$this->_path = $_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Uploads/";
		$this->_fileName = str_replace(" ", "_", basename($file['name']));
		$this->_dirTarget = $this->_path . $this->_fileName;

		if(move_uploaded_file($file['tmp_name'], $this->_dirTarget))
		{
			echo json_encode(array("name" => $this->_fileName, "success" => true, "amount" => $this->_fileAmount));
		}

	}


	public function deleteSpecificFile($fileName) 
	{
		$filesFromDir = scandir($_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Uploads/");

		foreach($filesFromDir as $file)
		{
			if ($file === $fileName)
			{
				unlink($_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Uploads/" . $fileName);
				echo json_encode(array("deleted" => true));
			}
		}

	}

	public function getImagesTag($selectedImages)
	{
		$images = explode(",", $selectedImages);
		
		$htmlTag = "";

		foreach ($images as $image) {
			$htmlTag  .= "<img src='../../Uploads/". $image ."'>";
		}

		return $htmlTag;
	}

	//Solo los nombres de las imagenes, no las imagenes con etiqueta img
	public function getVanillaImages($selectedImages)
	{
		return explode(",", $selectedImages);
	}

	public function deleteAllSessionImages($imagesToDelete)
	{
		$filesFromDir = scandir($_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Uploads/");

		foreach($imagesToDelete as $image)
		{	
			if(in_array($image, $filesFromDir))
			{
				unlink($_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Uploads/" . $image);
			}
		}
			
	}
	
}



?>