<?php
$sourcePath = __DIR__ . '/public/images/002-UTI.png';
$destPath = __DIR__ . '/public/images/favicon.png';

$source = imagecreatefrompng($sourcePath);
$width = imagesx($source);
$height = imagesy($source);

$size = max($width, $height);

$dest = imagecreatetruecolor($size, $size);
imagesavealpha($dest, true);
$transparent = imagecolorallocatealpha($dest, 0, 0, 0, 127);
imagefill($dest, 0, 0, $transparent);

$dst_x = ($size - $width) / 2;
$dst_y = ($size - $height) / 2;

imagecopy($dest, $source, $dst_x, $dst_y, 0, 0, $width, $height);

imagepng($dest, $destPath);
imagedestroy($source);
imagedestroy($dest);

echo "Favicon generated successfully.";
