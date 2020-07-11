<?php

//La carga imagenes debe apuntar hacia este script para no tener problema con las demas 
//acciones del usuario sobre las imagenes

include $_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Core/Autoloader.php";

$image = new Image();
$image->uploadImageToServer($_FILES['file']);

?>