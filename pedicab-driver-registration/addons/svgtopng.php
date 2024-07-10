<?php
	function convertSvgToPng($svgFilePath, $pngFilePath) {
    $imagick = new \Imagick();
    $imagick->setBackgroundColor(new \ImagickPixel('transparent'));
    $imagick->readImageBlob(file_get_contents($svgFilePath));
    $imagick->setImageFormat("png24");
    $imagick->writeImage($pngFilePath);
    $imagick->clear();
    $imagick->destroy();
}
?>