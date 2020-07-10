<?php

include $_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Core/Class/Image.php";

if(!isset($_POST['action'])) return;


$image = new Image();
$image->deleteSpecificFile($_POST['image']);


?>