<?php
use Treinetic\ImageArtist\lib\PolygonShape;
use Treinetic\ImageArtist\lib\Text\TextBox;
use Treinetic\ImageArtist\lib\Text\Color;
use Treinetic\ImageArtist\lib\Text\Font;
use Treinetic\ImageArtist\lib\Overlays\Overlay;
use Treinetic\ImageArtist\lib\Image;
require __DIR__ . '/vendor/autoload.php';
require_once 'peopleSegmentator.php';



$peopleSegmentator->sendModel('https://u.kanobu.ru/editor/images/46/028744ff-1505-4b9b-8f2b-46ca5fc8148a.jpg');
print_r($peopleSegmentator->getModel());



///Наложение фоток друг на друга.
/*$image = new Image("images/small_smile.png");

$image->merge(new Image("images/heads/1.png"),-20,-120);
$image->merge(new Image("images/moustache/1.png"),73,250);
$image->dump();*/
?>