<?php
include 'phpqrcode.php';
$url=str_replace("@","&",$_GET['url']);
QRcode::png($url,false,'L',6);
?>