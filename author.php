<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
require_once "DBUtil.php";
$authorno=$_GET['author'];
$rs=mysql_query("select * from author where id={$authorno}");
$row=mysql_fetch_assoc($rs);
$author=$row['author'];
$descrption=$row['descrption'];
function getbookname($categoryid){
    global $authorno;//引用函数外定义的变量
    if($categoryid==1){
        $sql="select pycode,no,bookname from book,bookcategory where authorid={$authorno} and (categoryid=1 or categoryid=3 or categoryid=5) and book.categoryid=bookcategory.id";
    }else{
        $sql="select pycode,no,bookname from book,bookcategory where authorid={$authorno} and categoryid={$categoryid} and book.categoryid=bookcategory.id";
    }
    $rs=mysql_query($sql);
    if(mysql_num_rows($rs)>0){
		$i=0;
        while($row=mysql_fetch_assoc($rs)){
			$i++;
            echo "<li><span class=\"rank-digit\">{$i}</span><a class=\"bookname\" href=\"{$row['pycode']}/{$row['no']}.html\">{$row['bookname']}</a></li>";
        }
    }
}
?>

<html>
<head>
    <title><?=$author?>_代表作品在线阅读</title>
    <link href="css/base.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
	<meta name="keywords"
          content="全文阅读，<?=$author?>简介，<?=$author?>作品，小说，散文随笔">
    <script>
        function $(id){
            return document.getElementById(id);
        }
    </script>
</head>
<style>
    #header_content{width: 800px;}
</style>
<body>
<div id="header">
    <div id="header_content">
        <h1><a href="/index.php">liulangcat</a></h1>
        <span>_<?=$author?></span>
    </div>
</div>
<style>
	body{color:#1e365a;}
    #content{width: 800px;margin: 0 auto;padding-top: 38px;padding-bottom: 38px;}
	#author_info{padding:25px 30px;border:1px #cfd3da solid;background-color:#c9f1f2;border-radius:4px 4px 0px 0px;position:relative;}
	.b{background:url("/img/sanjiao.png");height:11px;width:14px;position:absolute;left:0px;bottom:-11px;}
	.clear{clear:both;}
	.img{float:left;}
	.img>img{box-shadow:1px 1px 2px #bbb;border-radius:4px;}
	.txt{width:540px;float:left;margin-left:20px;}
	.txt>h1{font-size:24px;font-weight:normal;margin:0px;padding:0px;}
	.txt>div{text-indent:2em;text-align:justify;text-justify:distribute;}
	
	#book_list{padding:25px 40px;border:1px #cfd3da solid;border-top:none;margin-left:14px;background:#f1f1f1;}
	
	.book_block{  border-top: 4px #c9f1f2 solid;  background-color: #ffffff;margin:0px 2px 5px 2px;}
	.item_content{  border: 1px #eeeeee solid;  border-top: none;  padding: 0 18px;  }
	.item_top{  padding: 10px 0;  border-bottom: 1px solid #eeeeee;  }
	.item_top>p{margin:0px;}
	.bookname{  color: #00BFA5;}
	.item_bottom{min-height:60px;padding:5px 20px;}
	item_bottom>li{float:left;}
	#content a:hover{text-decoration:underline;}
	.rank-digit {display: inline-block;width: 18px;font-size: 12px;height: 14px;line-height: 14px;text-align: center;border-radius: 5px;
		color: #ffffff;background-color: #dcdcdc;margin-right: 6px;margin-top:-10px;}
</style>
<div id="content">
	<div id="author_info">
		<div class="b"></div>
		<div class="img">
			<img src="authorimg/<?=$authorno?>.jpg" style="width: 160px;">
		</div>
		<div class="txt">
			<h1><?=$author?></h1>
			<div>
			<?=$descrption?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<ul id="book_list">
		<li>
		<li>
		<div class="book_block">
		<div class="item_content">
			<div class="item_top">
				<p>中长篇小说</p>
			</div>
			<ul class="item_bottom">
				<?
                    getbookname(1);
                ?>
			</ul>
		</div>
		</div>
		</li>
		<div class="book_block">
		<div class="item_content">
			<div class="item_top">
				<p>散文随笔</p>
			</div>
			<ul class="item_bottom">
				<?
                    getbookname(2);
                ?>
			</ul>
		</div>
		</div>
		</li>
		<li>
		<div class="book_block">
		<div class="item_content">
			<div class="item_top">
				<p>短篇小说</p>
			</div>
			<ul class="item_bottom">
				<?
                    getbookname(4);
                ?>
			</ul>
		</div>
		</div>
		</li>
		<li>
		<div class="book_block">
		<div class="item_content">
			<div class="item_top">
				<p>其他</p>
			</div>
			<ul class="item_bottom">
				<?
                    getbookname(6);
                ?>
			</ul>
		</div>
		</div>
		</li>
		
	</ul>
	
</div>
<div id="footer" style="display:none;">
    联系邮箱：llp_liulangcat@qq.com|
    <script type="text/javascript">
        var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cspan id='cnzz_stat_icon_1256702543'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1256702543' type='text/javascript'%3E%3C/script%3E"));
    </script>
</div>
</body>
</html>