<?php
define ("INDEX_CHECK", 1);
include ('globals.php');
include ('conf.inc.php');
include ('nuked.php');
include_once ('Includes/hash.php');
include_once ('Includes/nkCaptcha.php');

session_name('nuked');
session_start();

$text = $_SESSION['captcha'];

header("Content-type: image/png");
$im = imagecreatefromjpeg("images/captcha.jpg");
$id = imagecreatefromjpeg("images/captcha.jpg");
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
$font = 'Includes/font/Alanden_.ttf';

for($i=0;$i<5;$i++)
{
	$angle = mt_rand(10,30);
if (mt_rand(0,1) == 1) $angle =- $angle;
	imagettftext($im, 12, $angle, 11+(20*$i), 15, $grey, $font, substr($text,$i,1));
	imagettftext($im, 12, $angle, 10+(20*$i), 16, $black, $font, substr($text,$i,1));
}

imagecopymerge ( $im, $id, 0, 0, 0, 0, 120, 30, 50 );
imagepng($im);
imagedestroy($im);
imagedestroy($id);

?>