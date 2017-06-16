<?
$bookno="20001";
if(isset($_GET['book'])){
    $bookno=$_GET['book'];
}
require_once "DBUtil.php";
$sql="select bookname,authorid,dirname,descrption from book,dir where no='".$bookno."' and book.dirid=dir.id";
$rs=mysql_query($sql);
if($row=mysql_fetch_assoc($rs)){
    $bookname=$row['bookname'];
    $dir=$row['dirname'];
    $authorid=$row['authorid'];
    $descrption=$row['descrption'];
}
?>
<head>
    <meta charset="utf-8">
    <link href="/yuedu/css/base.css" rel="stylesheet">
    <link href="/yuedu/css/center.css" rel="stylesheet">
    <link href="/yuedu/css/left.css" rel="stylesheet">
    <link href="/yuedu/css/right.css" rel="stylesheet">
    <title><?=$bookname?>_名家散文</title>
    <meta name="keywords" content="<?=$bookname?>">
    <meta name="description" content="<?=$descrption?>">
</head>
<body>
<!--主体块开始-->
<?
require_once "yuedu/html/swsbcenter.html";
?>

<!--主体块结束-->

<!-- 右边的浮层模块开始 -->
<?
require_once "yuedu/html/right.html";
?>
<!-- 右边的浮层模块结束 -->

<!-- 左边目录模块开始 -->
<?
require_once "yuedu/html/swsbleft.html";
?>
<!-- 左边目录结束 -->
<script language="JavaScript" src="/yuedu/js/center.js"></script>
<script language="JavaScript" src="/yuedu/js/left.js"></script>
<script language="JavaScript" src="/yuedu/js/right.js"></script>
<script>
    init_page();
	document.querySelector("#qr_block>img").src="/api/createQR.php?url=http://m.liulangcat.com/swsb/<?=$bookno ?>.html";
</script>
</body>

