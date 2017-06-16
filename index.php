<?php
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
header('Location: http://m.liulangcat.com');
?>
<?php
header("Content-type:text/html;charset=utf-8");
require_once "DBUtil.php";
function load_bottom_item_content($i){
    $sql="select * from book,author,tb_nationality,bookcategory where categoryid={$i} and book.authorid=author.id and book.categoryid=bookcategory.id and author.nationalityid=tb_nationality.id order by book.id desc";
    $ret=mysql_query($sql);
    $i=0;
    while($row=mysql_fetch_assoc($ret)){
        $i++;
        if($i<=5){
			echo "<li><span class=\"rank-digit\">{$i}</span><a target=\"_blank\" class=\"bookname\" href=\"{$row['pycode']}/{$row['no']}.html\">{$row['bookname']}</a><a target=\"_blank\" class=\"author\" href=\"/author.php?author={$row['authorid']}\">[{$row['author']}]</a></li>";
        }
    }
}
function load_bottom_item_content_7($i){
    $sql="select pycode,no,bookname,author.author author from book,author,tb_nationality,bookcategory where categoryid={$i} and book.authorid=author.id and book.categoryid=bookcategory.id and author.nationalityid=tb_nationality.id order by book.id desc";
    $ret=mysql_query($sql);
    while($row=mysql_fetch_assoc($ret)){
        echo "<a target=\"_blank\" class=\"right_a\" href=\"{$row['pycode']}/{$row['no']}.html\" title=\"{$row['bookname']}\r\n作者：{$row['author']}\">{$row['bookname']}</a>";
    }
}
function load_bottom_item_content_new(){
    $sql="select pycode,no,bookname,author.author author from book,author,bookcategory where book.authorid=author.id and book.categoryid=bookcategory.id order by book.id desc limit 8";
    $ret=mysql_query($sql);
    while($row=mysql_fetch_assoc($ret)){
        echo "<a target=\"_blank\" class=\"right_a\" href=\"{$row['pycode']}/{$row['no']}.html\" title=\"{$row['bookname']}\r\n作者：{$row['author']}\">{$row['bookname']}</a>";
    }
}
function load_bottom_item_content_readhistory(){
	$i=0;
	$cookie=array_reverse($_COOKIE); //取反数组
    foreach($cookie as $k=>$v)
	{
		if(substr($k,0,2)=="JL"&&$i<4){
			$i++;
			load_item_by_no(substr($k,3));
		}
	}
	if($i==0){
		echo "<center style='color:#dcdcdc'>无记录</center>";
	}
}
function load_item_by_no($no){
    $sql="select pycode,no,bookname,author.author author from book,author,bookcategory where no='".$no."' and book.authorid=author.id and book.categoryid=bookcategory.id limit 1";
    $ret=mysql_query($sql);
    while($row=mysql_fetch_assoc($ret)){
        echo "<a target=\"_blank\" class=\"right_a\" href=\"{$row['pycode']}/{$row['no']}.html\" title=\"{$row['bookname']}\r\n作者：{$row['author']}\">{$row['bookname']}</a>";
    }
}

?>
<script>
    function $(id){
        return document.getElementById(id);
    }
</script>
<html>
<head>
    <link href="css/base.css" rel="stylesheet">
    <link href="yueducss/base.css" rel="stylesheet">
    <link href="yueducss/header.css" rel="stylesheet">
    <link href="yueducss/content_top.css" rel="stylesheet">
    <link href="yueducss/content_left.css" rel="stylesheet">
    <link href="yueducss/content_right.css" rel="stylesheet">
    <meta name="keywords"
          content="liulangcat,小说阅读，txt小说下载，epub小说下载，公共版权书籍，世界名著，古籍">
    <meta name="description"
          content="liulangcat是一个在线阅读网站。包含现当代文学,散文随笔,外国文学,短篇小说,古代文学,其他6个模块,网站结构简单,没有广告、弹窗,收录小说都为优质、经典小说">
	<title>liulangcat_主页</title>
</head>
<body style="background:linear-gradient(200deg,#aecdd0,#d8c594);">
<!-- 头部区域开始 -->
<div id="header">
    <div id="header_content">
        <h1><a href="index.php">liulangcat</a></h1>
        <span>_主页</span>
    </div>
</div>
<!-- 头部区域结束 -->
<!-- 中间区域开始 -->
<div id="content" style="background:none;">
    <div id="zhuti">
        <!-- 导航链接区开始 -->
        <div id="nav">
            <div id="navs">
                <ul>
                    <li><a target="_blank" href="category.php?cname=现当代文学">现当代文学</a></li>
                    <li>|</li>
                    <li><a target="_blank" href="category.php?cname=散文随笔">散文随笔</a></li>
                    <li>|</li>
                    <li><a target="_blank" href="category.php?cname=外国文学">外国文学</a></li>
                    <li>|</li>
                    <li><a target="_blank" href="category.php?cname=短篇小说">短篇小说</a></li>
                    <li>|</li>
                    <li><a target="_blank" href="category.php?cname=古代文学">古代文学</a></li>
                    <li>|</li>
                    <li><a target="_blank" href="category.php?cname=其他">其他</a></li>
					<li>||</li>
                    <li><a target="_blank" href="作者专区">作者专区</a></li>
                </ul>
            </div>
        </div>
        <!-- 导航链接区结束 -->
        <!-- 搜索区开始 -->
        <div id="search">
            <div id="search_reight" style="float: right;height: 32px">
                <select name="option" id="option">
                    <option value="1">书名</option>
                    <option value="2">作者</option>
                    <option value="3" selected="selected">任意</option>
                </select>
                <input type="text" name="k" id="k" style="padding-left:5px;" onkeydown="keydown(event)">
                <input type="button" name="submit" id="submit" value="搜索" onclick="getret()">
            </div>
        </div>
        <!-- 搜索区结束 -->
        <script>
			function keydown(e){
				var code = e.keyCode;
				if(code == 13){
					getret();
				}
			}
            function getret(){
                window.location.href="search.php?k="+$("k").value+"&type="+$("option").value;
            }
        </script>
        <!-- 核心区开始 -->
        <div style="width: 980px;margin: 0 auto;margin-top: 100px;">
            <!-- 核心区的左边区域开始-->
            <div style="width: 620px;float: left">
				<ul id="left_top">
                    <li>
                        <div class="block">
                            <div style="border: 1px solid #dcdcdc;border-top: none;padding: 0px 20px">
                                <div class="item_top">
                                    <p>
                                        <span class="top_categoryname">20世纪中文小说100强</span>
                                    </p>
                                    <div class="slide-controls">
                                        <ol class="slide-dots">
                                            <li><a target="_blank" class="active" onclick="silde_no(1)"></a></li><li><a target="_blank" onclick="silde_no(2)"></a></li><li><a target="_blank" onclick="silde_no(3)"></a></li><li><a target="_blank" onclick="silde_no(4)"></a></li>
                                        </ol>
                                        <div class="slide-btns"><a target="_blank" class="prev" onclick="silde_prev()">‹</a><a target="_blank" class="next" onclick="silde_next()">›</a></div>
                                    </div>
                                </div>
                                <div class="item_bottom">
                                    <div id="item_content" style="height: 210px;width:2312px;margin-left: 0px">
                                    <?
                                    load_bottom_item_content_7(7);
                                    ?>
                                    </div>
                                    <div style="height: 17px;border-bottom: 4px solid #00E5FF">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul id="left">
                    <li><div class="category_block">
                            <div class="item_content">
                                <div class="item_top">
                                    <p>
                                        <span class="top_categoryname">现当代文学</span>
                                        <a target="_blank" href="category.php?cname=现当代文学" class="more">更多</a>
                                    </p>
                                </div>
                                <ul class="booklist">
                                    <?
                                    load_bottom_item_content(1);
                                    ?>

                                </ul>
                            </div>
                        </div></li>
                    <li><div class="category_block">
                            <div class="item_content">
                                <div class="item_top">
                                    <p>
                                        <span class="top_categoryname">散文随笔</span>
                                        <a target="_blank" href="category.php?cname=散文随笔" class="more">更多</a>
                                    </p>
                                </div>
                                <ul class="booklist">
                                    <?
                                    load_bottom_item_content(2);
                                    ?>
                                </ul>
                            </div>
                        </div></li>
                    <li><div class="category_block">
                            <div class="item_content">
                                <div class="item_top">
                                    <p>
                                        <span class="top_categoryname">外国文学</span>
                                        <a target="_blank" href="category.php?cname=外国文学" class="more">更多</a>
                                    </p>
                                </div>
                                <ul class="booklist">
                                    <?
                                    load_bottom_item_content(3);
                                    ?>
                                </ul>
                            </div>
                        </div></li>
                    <li><div class="category_block">
                            <div class="item_content">
                                <div class="item_top">
                                    <p>
                                        <span class="top_categoryname">短篇小说</span>
                                        <a target="_blank" href="category.php?cname=短篇小说" class="more">更多</a>
                                    </p>
                                </div>
                                <ul class="booklist">
                                    <?
                                    load_bottom_item_content(4);
                                    ?>
                                </ul>
                            </div>
                        </div></li>
                    <li><div class="category_block">
                            <div class="item_content">
                                <div class="item_top">
                                    <p>
                                        <span class="top_categoryname">古代文学</span>
                                        <a target="_blank" href="category.php?cname=古代文学" class="more">更多</a>
                                    </p>
                                </div>
                                <ul class="booklist">
                                    <?
                                    load_bottom_item_content(5);
                                    ?>
                                </ul>
                            </div>
                        </div></li>
                    <li><div class="category_block">
                            <div class="item_content">
                                <div class="item_top">
                                    <p>
                                        <span class="top_categoryname">其他</span>
                                        <a target="_blank" href="category.php?cname=其他" class="more">更多</a>
                                    </p>
                                </div>
                                <ul class="booklist">
                                    <?
                                    load_bottom_item_content(6);
                                    ?>
                                </ul>
                            </div>
                        </div></li>
                </ul>
            </div>
            <!-- 核心区的左边区域结束-->
            <!-- 核心区的右边区域开始 -->
            <div style="width: 320px;margin-left: 40px;float: left;">
                <ul class="right_list">
					<li>
                        <div class="block">
                            <div style="border: 1px solid #dcdcdc;border-top: none;padding: 0px 20px">
                                <div class="item_top">
                                    <p>
                                        <span class="top_categoryname">阅读记录</span>
                                    </p>
                                </div>
                                <div class="item_bottom" style="height:auto;margin-bottom:-1px;min-height:60px">
									<?
                                    load_bottom_item_content_readhistory();
                                    ?>    
								</div>
								<div class="item_top">
                                    <p>
                                        <span class="top_categoryname">最近添加</span>
                                    </p>
                                </div>
                                <div class="item_bottom" style="height:120px">
                                    <?
                                    load_bottom_item_content_new();
                                    ?>
								</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="block">
                            <div style="border: 1px solid #dcdcdc;border-top: none;padding: 0px 20px">
                                <div class="item_top">
                                    <p>
                                        <span class="top_categoryname">热门阅读</span>
                                    </p>
                                </div>
                                <div class="item_bottom">
                                    <a target="_blank" class="right_a" href="gdwx/51001.html">红楼梦</a><a target="_blank" class="right_a" href="gdwx/51002.html">三国演义</a>
                                    <a target="_blank" class="right_a" href="gdwx/51003.html">水浒传</a><a target="_blank" class="right_a" href="gdwx/51004.html">西游记</a>
                                    <a target="_blank" class="right_a" href="xddwx/11001.html">生死场</a><a target="_blank" class="right_a" href="xddwx/11002.html">呼兰河传</a>
                                    <a target="_blank" class="right_a" href="wgwx/31006.html">简·爱</a><a target="_blank" class="right_a" href="wgwx/31005.html">大卫·科波菲尔</a>
                                    <a target="_blank" class="right_a" href="wgwx/31003.html">基督山伯爵</a><a target="_blank" class="right_a" href="wgwx/31004.html">呼啸山庄</a>
                                    <a target="_blank" class="right_a" href="wgwx/30008.html">童年</a><a target="_blank" class="right_a" href="wgwx/30007.html">牛虻</a>
                                    <a target="_blank" class="right_a" href="wgwx/30012.html">傲慢与偏见</a><a target="_blank" class="right_a" href="wgwx/30005.html">局外人</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="block">
                            <div style="border: 1px solid #dcdcdc;border-top: none;padding: 0px 20px">
                                <div class="item_top">
                                    <p>
                                        <span class="top_categoryname">热门作者</span>
                                    </p>
                                </div>
                                <div class="item_bottom">
                                    <a target="_blank" class="right_a" href="author.php?author=101">鲁迅</a><a target="_blank" class="right_a" href="author.php?author=102">萧红</a>
                                    <a target="_blank" class="right_a" href="author.php?author=201">简·奥斯汀</a><a target="_blank" class="right_a" href="author.php?author=901">老舍</a>
                                    <a target="_blank" class="right_a" href="author.php?author=1401">芥川龙之介</a><a target="_blank" class="right_a" href="author.php?author=129">朱自清</a>
                                    <a target="_blank" class="right_a" href="author.php?author=401">莫泊桑</a><a target="_blank" class="right_a" href="author.php?author=12">契诃夫</a>
                                    <a target="_blank" class="right_a" href="author.php?author=402">欧·亨利</a><a target="_blank" class="right_a" href="author.php?author=1103">乔治·奥威尔</a>
                                    <a target="_blank" class="right_a" href="author.php?author=7">比彻·斯托</a><a target="_blank" class="right_a" href="author.php?author=105">郁达夫</a>
                                    <a target="_blank" class="right_a" href="author.php?author=15">艾·丽·伏尼契</a><a target="_blank" class="right_a" href="author.php?author=110">穆时英</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- 核心区的右边区域结束 -->
			<!-- 底部 -->
			<div style="clear:both;height:88px;margin-top:20px;font-size:14px;">
			<div style="line-height:88px;padding-left:12px;color:#000000;background:rgba(255,255,255,0.5)"><span>友情链接：<a href="http://www.8bei8.com/" target="_blank" style="color:#5e5e5e" >太极书馆</a></span></div>
			</div>
        </div>
        <!-- 核心区结束 -->
    </div>

</div>
<!-- 中间区域结束 -->

<!--javascript-->
<script>
    var stopcode;
    var item_content=document.getElementById("item_content");
    var left_top=document.getElementById("left_top");
    var slide_dots=document.querySelectorAll(".slide-dots a");
    func();
    left_top.onmouseover=function(){
        clearInterval(stopcode);
    }
    left_top.onmouseout=function(){
        func();
    }
    function func(){
        stopcode=setInterval(function(){silde_next()},8000);
    }
    function silde_no(no){
        var val=-578*(no-1);
        silde(val);
    }
    function silde_prev(){
        var val=(-1*((2312+(Math.abs(parseInt(item_content.style.marginLeft))-578))%2312));
        silde(val);
    }
    function silde_next(){
        var val=(-1*((Math.abs(parseInt(item_content.style.marginLeft))+578)%2312));
        silde(val);
    }
    function silde(val){
        item_content.style.marginLeft=val;
        clear_dot();
        slide_dots[Math.abs(val)/578].className="active";
    }
    function clear_dot(){
        for(var i= 0;i<slide_dots.length;i++){
            slide_dots[i].className="";
        }
    }
</script>
<script type="text/javascript">
        var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cspan id='cnzz_stat_icon_1256702543'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1256702543' type='text/javascript'%3E%3C/script%3E"));
    </script>
	<script type="text/javascript">
		document.getElementById("cnzz_stat_icon_1256702543").innerHTML="";
	</script>
</body>
</html>
