<?php
session_start();
header('Content-Type: image/png');
header('Content-Disposition: attachment; filename="certificate.png"');

if (!empty($_SESSION['user'])) {
		$nickname = $_SESSION['user']['username'];
	} else {
		$nickname = $_SESSION['guest'];
	}


$img = imagecreatefrompng("../images/example.png");

$font = '../fonts/a_AlbionicTitulInfl_Bold.ttf';

$black = imagecolorallocate($img, 168, 124, 79);

// Выводим имя
$text = $nickname;
$imgttf = imagettfbbox(30, 0, $font, $text);
$x =  imagesx($img) / 2 - round(($imgttf[2] - $imgttf[0]) / 8);
$y = (imagesy($img) / 2.45);
imagettftext($img, 40, 0, $x, $y, $black, $font, $text);
// Название пройденного теста
$text = 'Вы прошли тест '.$_GET['testname'];
$imgttf = imagettfbbox(20, 0, $font, $text);
$x =  imagesx($img) / 2 - round(($imgttf[2] - $imgttf[0]) / 1.5);
$y = (imagesy($img) / 1.83);
imagettftext($img, 30, 0, $x, $y, $black, $font, $text);
// Результат
$text = 'Правильных ответа: '.$_GET['result'];
$imgttf = imagettfbbox(20, 0, $font, $text);
$x =  imagesx($img) / 2 - round(($imgttf[2] - $imgttf[0]) / 1.5);
$y = (imagesy($img) / 1.33);
imagettftext($img, 30, 0, $x, $y, $black, $font, $text);

imagepng($img);
imagedestroy($imgg);

?>