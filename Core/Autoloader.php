<?php
spl_autoload_register(function($class) {
    return include $_SERVER['DOCUMENT_ROOT'] . "/ConverterImgToPdf/Core/Class/" . $class . ".php";
});
?>