<?php
header("Content-Type:text/html;charset=utf-8");
require_once "DBUtil.php";
$page=1;
$count=24;
if(isset($_GET['page'])){
	$page=$_GET['page'];
}
$current=($page-1)*$count;
$sql="select id from author";
$ret=mysql_query($sql,$conn);
$authornum=mysql_num_rows($ret);
$pagenum=ceil($authornum/$count);
$sql="select id,author,descrption from author limit {$current},{$count};";
$ret=mysql_query($sql,$conn);
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>liulangcat_作者专区</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="../css/base.css" rel="stylesheet">
    <link href="../css/header.css" rel="stylesheet">
    <script>
        function $(id){
            return document.getElementById(id);
        }
    </script>
</head>
<style>
    #header_content{
        width: 800px;
    }
	#booklist{margin:0px auto;}
	#booklist>li{float:left;}
	.book_block{ width: 300px;  border-top: 4px #FF6D00 solid;  background-color: #ffffff;margin:0px 2px 5px 2px;}
	#booklist>li:nth-child(3n+2) .book_block{border-color: #00BFA5;}
	#booklist>li:nth-child(3n+3) .book_block{border-color: #00B8D4;}
	.item_content{  border: 1px #eeeeee solid;  border-top: none;  padding: 0 18px;  }
	.item_top{  padding: 10px 0;  border-bottom: 1px solid #eeeeee;  }
	.item_top>p{margin:0px;}
	.bookname{  color: #000000; margin-right: 6px  }
	.author{  color: #00BFA5;  }
	.item_bottom{height:120px;text-align:justify;text-justify:distribute;}
	#content a:hover{text-decoration:underline;}
</style>
<body>
<div id="header">
    <div id="header_content">
        <h1><a href="../index.php">liulangcat</a></h1>
        <span>_作者专区</span>
    </div>
</div>
<div id="content">
    <ul id='booklist'>
	<?
	while($row=mysql_fetch_assoc($ret)){
	?>
	<li><div class="book_block">
		<div class="item_content">
			<div class="item_top">
				<p>
				<?
					$author=$row['author'];
					$descrption=$row['descrption'];
					if(mb_strlen($descrption,'utf-8')>=72){
						$descrption=mb_substr($descrption,0,72,'utf-8')."...";
					}
					echo "<span class='top_bookname'><a class=\"bookname\" href=\"/author.php?author={$row['id']}\">{$author}</a></span>";
				?>
				</p>
			</div>
			<div class="item_bottom">
				<p>
					<?=$descrption ?>
				</p>
			</div>
		</div>
	</div></li>
	<?
	}
	?>
	</ul>
</div>
<!-- 分页条 -->
<div id="page" style="margin:20px auto;">
<ul class="pagination" id="pagination">
	<li <?=$page==1?"class='disabled'":"" ?>><a href="<?=$page==1?"#":"?page=".($page-1) ?>" >&laquo;</a></li>
	<?
		if($pagenum<=5||$page==1||$page==2){
			for($i=1;$i<=$pagenum&&$i<=5;$i++){
				$active=$page==$i?"class='active'":"";
				echo "<li {$active}><a href='?page={$i}'>{$i}</a></li>";
			}
		}else{
			if($page==$pagenum-1||$page==$pagenum){
				for($i=$pagenum-4;$i<=$pagenum;$i++){
					$active=$page==$i?"class='active'":"";
					echo "<li {$active}><a href='?page={$i}'>{$i}</a></li>";
				}
			}else{
				for($i=$page-2;$i<=$page+2;$i++){
					$active=$page==$i?"class='active'":"";
					echo "<li {$active}><a href='?page={$i}'>{$i}</a></li>";
				}
			}
		}
	?>
	<li <?=$page==$pagenum?"class='disabled'":"" ?>><a href="<?=$page==$pagenum?"#":"?page=".($page+1) ?>">&raquo;</a></li>
</ul>
</div>

<div id="footer" style="display:none">
    联系邮箱：llp_liulangcat@qq.com|
    <script type="text/javascript">
        var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cspan id='cnzz_stat_icon_1256702543'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1256702543' type='text/javascript'%3E%3C/script%3E"));
    </script>
</div>
</body>
	<script>
		// 调整宽度
		var book_block_width=304;
		var win_width=$("header").offsetWidth;
		var book_block_num=Math.floor(win_width/book_block_width);
		var content_width=book_block_num*book_block_width;
		$("booklist").style.width=content_width;
		$("page").style.width=$("pagination").offsetWidth+1;
	</script>
</html>
