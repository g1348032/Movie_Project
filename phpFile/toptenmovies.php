<?php

require("connect.php");

$result = $conn->query("SELECT `Title`, `Score` FROM `Movies_DVDs` WHERE `Score` ORDER BY `Score` ASC;")->fetchAll(PDO::FETCH_ASSOC);
$data = array();
for($i = 0; $i < 10; $i++){
    $data += array($result[$i]['Title'] => $result[$i]['Score']);
}
            
$imageWidth = 1800;
$imageHeight = 900;

$gridTop = 40;
$gridLeft = 50;
$gridBottom = 900 - 40;
$gridRight = 1800 - 50;
$gridHeight = $gridBottom - $gridTop;
$gridWidth = $gridRight - $gridLeft;

$lineWidth = 1;
$barWidth = 120;

$font = '/var/www/30018729//Project/SwanseaBold-D0ox.ttf';
$fontSize = 10;
$labelMargin = 8;
$yMaxValue = 100;
$yLabelSpan = 40;

$chart = imagecreate($imageWidth, $imageHeight);

$backgroundColor = imagecolorallocate($chart, 0, 255, 255);
$axisColor = imagecolorallocate($chart, 85, 85, 85);
$labelColor = $axisColor;
$gridColor = imagecolorallocate($chart, 212, 212, 212);
$barColor = imagecolorallocate($chart, 255, 182, 193);
$barColor2 = imagecolorallocate($chart, 255, 20, 147);

imagefill($chart, 0, 0, $backgroundColor);

imagesetthickness($chart, $lineWidth);

for($i = 0; $i <= $yMaxValue; $i += $yLabelSpan) {
    $y = $gridBottom - $i * $gridHeight / $yMaxValue;

    imageline($chart, $gridLeft, $y, $gridRight, $y, $gridColor);

    $labelBox = imagettfbbox($fontSize, 0, $font, strval($i));
    $labelWidth = $labelBox[4] - $labelBox[0];

    $labelX = $gridLeft - $labelWidth - $labelMargin;
    $labelY = $y + $fontSize / 2;

    imagettftext($chart, $fontSize, 0, $labelX, $labelY, $labelColor, $font, strval($i));
}

imageline($chart, $gridLeft, $gridTop, $gridLeft, $gridBottom, $axisColor);
imageline($chart, $gridLeft, $gridBottom, $gridRight, $gridBottom, $axisColor);

$barSpacing = $gridWidth / count($data);
$itemX = $gridLeft + $barSpacing / 2;

$colorToFill = $barColor2;

foreach($data as $key => $value) {
    $x1 = $itemX - $barWidth / 2;
    $y1 = $gridBottom - $value / $yMaxValue * $gridHeight;
    $x2 = $itemX + $barWidth / 2;
    $y2 = $gridBottom - 1;
    $colorToFill = (($colorToFill == $barColor) ? $barColor2 : $barColor);
    imagefilledrectangle($chart, $x1, $y1, $x2, $y2, $colorToFill);
    
    $labelBox = imagettfbbox($fontSize, 0, $font, $key);
    $labelWidth = $labelBox[4] - $labelBox[0];

    $labelX = $itemX - $labelWidth / 2;
    $labelY = $gridBottom + $labelMargin + $fontSize;
    imagettftext($chart, $fontSize, 0, $labelX, $labelY, $labelColor, $font, $key);
    $itemX += $barSpacing;
}
header('Content-Type: image/png');
imagepng($chart);
imagepng($chart, 'chart.png');

