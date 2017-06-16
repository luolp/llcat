<?
require_once 'DBUtil.php';
header("Content-type:text/html;charset=utf-8");
$k="";$type="3";
if(isset($_GET['k'])){
    $k=$_GET['k'];
}
if(isset($_GET['type'])){
    $type=$_GET['type'];
}
$k=trim($k);
$k=mysql_real_escape_string($k);
if($type=="3"){
    $sql="select * from author,book,dir,bookcategory where (author like '%{$k}%' or bookname like '%{$k}%') and book.authorid=author.id and book.dirid=dir.id and book.categoryid=bookcategory.id limit 20";

}elseif($type=="1"){
    $sql="select * from author,book,dir,bookcategory where book.authorid=author.id and book.categoryid=bookcategory.id and book.dirid=dir.id and bookname like '%{$k}%' limit 20";

}elseif($type=="2"){
    $sql="select * from author,book,dir,bookcategory where author like '%{$k}%' and book.authorid=author.id and book.dirid=dir.id and book.categoryid=bookcategory.id limit 20";
}
$ret=mysql_query($sql,$conn);
/* 记录查询信息 */
if($k!=""){
	$num=mysql_num_rows($ret);
	$sql2="insert into search_log_info(keyword,type,num,addtime) values('{$k}',{$type},{$num},now());";
	mysql_query($sql2,$conn);
}
?>

<html>
<head>
    <title>liulangcat_搜索</title>
    <link href="css/base.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <script>
        function $(id){
            return document.getElementById(id);
        }
    </script>
</head>
<style>
    body{
        background-image: linear-gradient(200deg,#aecdd0,#d8c594);
    }
    #header_content{
        width: 800px;
    }
</style>
<body>
<div id="header">
    <div id="header_content">
        <h1><a href="index.php">liulangcat</a></h1>
        <span>_搜索</span>
    </div>
</div>
<style>
    #content_content{
        width: 800px;
        margin: 0 auto;
        padding-top: 38px;
        padding-bottom: 38px;
    }
    #search{
        width: 800px;
        margin: 0 auto;
    }
    #booklist{
        margin-top: 38px;
    }
	.book_block{ width: 800px;  border-top: 4px #00B8D4 solid;  background-color: #ffffff;margin:0px 2px 5px 2px;}
	.item_content{  border: 1px #eeeeee solid;  border-top: none;  padding: 0 18px;  }
	.item_top{  padding: 10px 0;  border-bottom: 1px solid #eeeeee;  }
	.item_top>p{margin:0px;}
	.bookname{  color: #000000; margin-right: 6px  }
	.author{  color: #00BFA5;  }
	.item_bottom{min-height:80px;}
	#content a:hover{text-decoration:underline;}
</style>
<div id="content">
    <div id="content_content">
        <div id="search">
            <style>
                #search_reight input[type=text]{
                    border: 1px solid #dcdcdc;
                    width: 260px;
                    height: 32px;
                    border-right-color: transparent;
					padding-left:5px;
                }
                #search_reight input[type=text]:hover{
                    border: 1px solid rgba(63, 181, 241, 1);
                }
                #search_reight input[type=text]:focus{
                    border: 1px solid rgba(63, 181, 241, 1);
                }
                #search_reight select{
                    height: 32px;
                }
                #search_reight input[type=submit]{
                    border: 0px;
                    width: 88px;
                    height: 32px;
                    font-size: 14px;
                    font-weight: bold;
					cursor:pointer;
                    background-color: rgba(63, 181, 241, 1);
                }
                #search_reight input[type=submit]:hover{
                    box-shadow: 2px 2px 1px rgba(0,0,0,0.3);
                }
            </style>
            <div id="search_reight" style="float: right;height: 32px">
				<form>
                <input type="text" name="k" id="k" value="<?=$k?>">
                <div style="float: right">
                    <input type="submit" name="submit" id="submit" value="搜索">
                </div>
				</form>
            </div>
        </div>
        <div id="bottom">
			<ul id="booklist">
			<?
			while($row=mysql_fetch_assoc($ret)){
				?>
				<li><div class="book_block">
					<div class="item_content">
						<div class="item_top">
							<p>
							<?
								$bookname=$row['bookname'];
								$author=$row['author'];
								$descrption=$row['descrption'];
								echo "<span class='top_bookname'><a class=\"bookname\" href=\"/{$row['pycode']}/{$row['no']}.html\" title=\"{$bookname}\">{$bookname}</a><a class=\"author\" href=\"/author.php?author={$row['authorid']}\">[{$author}]</a></span>";
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
    </div>
</div>
<div id="footer">
    联系邮箱：llp_liulangcat@qq.com|
    <script type="text/javascript">
        var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cspan id='cnzz_stat_icon_1256702543'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1256702543' type='text/javascript'%3E%3C/script%3E"));
    </script>
</div>
</body>
</html>