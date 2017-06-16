<?php
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
	header('Location: http://m.liulangcat.com'.$_SERVER['REQUEST_URI']);
?>
<?
$bookno="10001";
if(isset($_GET['book'])){
    $bookno=$_GET['book'];
}
$chapterno=1;
if(isset($_COOKIE["JL_".$bookno])){
	$chapterno=$_COOKIE["JL_".$bookno];
}
include("DBUtil.php");
$sql="select bookname,mulu,dirname,descrption from book,dir where no='".$bookno."' and book.dirid=dir.id";

$rs=mysql_query($sql);
if($row=mysql_fetch_assoc($rs)){
    $bookname=$row['bookname'];
    $dir=$row['dirname'];
    $mulu=$row['mulu'];
    $descrption=$row['descrption'];
}
$json=json_decode($mulu,true);
$ul=$json["ul"];
$li=$json["li"];
?>
<head>
    <meta charset="utf-8">
    <link href="/yuedu/css/base.css" rel="stylesheet">
    <link href="/yuedu/css/center.css" rel="stylesheet">
    <link href="/yuedu/css/left.css" rel="stylesheet">
    <link href="/yuedu/css/right.css" rel="stylesheet">
    <title><?=$bookname?>_在线阅读</title>
    <meta name="keywords" content="<?=$bookname?>">
    <meta name="description" content="<?=$descrption?>">
	<style>
	::selection {
	background:#00B8D4; 
	color:#FFFFFF;
	}
	::-moz-selection {
	background:#00B8D4; 
	color:#FFFFFF;
	}
	::-webkit-selection {
	background:#00B8D4; 
	color:#FFFFFF;
	}
	</style>
</head>
<body>
<canvas height="100%" width="100%" style="position: fixed; top: 0px; left: 0px; z-index: -1; opacity: 1;"  id="anm-canvas"></canvas>
<!-- 右边的浮层模块开始 -->
<?
require_once "yuedu/html/right.html";
?>
<!-- 右边的浮层模块结束 -->
<!--主体块开始-->
<?
require_once "yuedu/html/center.html";
?>
<!--主体块结束-->



<!-- 左边目录模块开始 -->
<?
require_once "yuedu/html/left.html";
?>
<!-- 左边目录结束 -->
<script language="JavaScript" src="/yuedu/js/center.js"></script>
<script language="JavaScript" src="/yuedu/js/left.js"></script>
<script language="JavaScript" src="/yuedu/js/right.js"></script>
<script language="javascript">
    document.getElementById("left").getElementsByTagName("a")[<?=$chapterno-1?>].click();
</script>
<script type="text/javascript">
        var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cspan id='cnzz_stat_icon_1256702543'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1256702543' type='text/javascript'%3E%3C/script%3E"));
    </script>
	<script type="text/javascript">
		document.getElementById("cnzz_stat_icon_1256702543").innerHTML="";
	</script>
<script language="JavaScript" src="/js/canvas/anim1.js"></script>
</body>

