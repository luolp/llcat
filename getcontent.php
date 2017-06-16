<?php
header("Content-type:text/html;charset=utf-8");
$dir=$_GET['dir'];
$bookno=$_GET['bookno'];
$no=$_GET['no'];
if($no!=1||isset($_COOKIE["JL_".$bookno])){
	$expire=time()+60*60*24*7;//有效期七天
	// '.liulangcat.com'设置这个cookie的作用范围是全部子域名和liulangcat.com
	setcookie("JL_".$bookno,$no, $expire,'/','.liulangcat.com');
}
$filename="../txt/".$dir."/".$bookno."_".$no.".txt";
$string=file_get_contents($filename);
$encode = mb_detect_encoding($string, array("GB2312","ASCII","UTF-8","GBK"));
if($encode!="UTF-8"){
$string=iconv($encode,"UTF-8",$string);
}
$string=nl2br($string);
// 去掉多余的换行
$string=preg_replace("/(<br \/>\s*|<br\/>\s*|<br>\s*){3,}/","<br /><br />",$string);
$string=preg_replace("/<\/\s*br>\s*/","",$string);
// 去掉链向其它网站的链接
/*
preg_match_all("/<a.*?href=[\'\"](.*?)[\'\"].*?>(.*?)<\/a>/", $string, $matches, PREG_SET_ORDER);
foreach ($matches as $val) {
	$string=str_replace($val[0],$val[2],$string);
}
*/
$string=preg_replace("/<a.*?href=[\'\"](.*?)[\'\"].*?>/","",$string);
$string=preg_replace("/<\/a>/","",$string);
echo $string;
?>
