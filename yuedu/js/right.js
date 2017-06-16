/**
 * Created by zowa on 2016-07-31.
 */
var chapter_reader=document.getElementById("chapter_reader");
var page_reader=document.getElementById("page_reader");
var view_block=document.getElementById("view_block");
var gotop=document.getElementById("gotop");

/*手机阅读二维码*/
var qr_block=document.getElementById("qr_block");
/*默认按页阅读*/
pageReader();
/*切换为按页阅读*/
function pageReader(){
    view_block.className="view_block_1";
    chapter_reader.style.display="block";
    page_reader.style.display="none";
    gotop.style.display="none";
    document.getElementById("change_page_block").style.display="block";
}
/*切换为按章节阅读*/
function chapterReader(){
    view_block.className="view_block_2";
    chapter_reader.style.display="none";
    page_reader.style.display="block";
    document.getElementById("change_page_block").style.display="none";
}
/*回到顶部*/
function goTop(){
    <!-- 使用if语句是为了兼容不同的浏览器 -->
    if(document.body.scrollTop==0){
        scrollBy(0,-100);
        ad=setTimeout('goTop()',10);
        if(document.documentElement.scrollTop<=0)
            clearTimeout(ad);
    }else{
        scrollBy(0,-50);
        ad=setTimeout('goTop()',10);
        if(document.body.scrollTop<=0)
            clearTimeout(ad);
    }
}
/*手机阅读二维码*/
function phoneReader(){
	if(qr_block.style.display=="block"){
		qr_block.style.display="none"
	}else{
		qr_block.style.display="block"
	}
}
/*更新二维码*/
function updateQR(bookno,no){
	document.querySelector("#qr_block>img").src="/api/createQR.php?url=http://m.liulangcat.com/yuedu.php?book="+bookno+"@chapter="+no+"@cnum=-1";
}
/*隐藏二维码*/
function x_btn_click(){
	phoneReader();
}
window.onscroll=function(){
    var top = document.body.scrollTop||document.documentElement.scrollTop;
    if(top==0){
        gotop.style.display="none";
    }else{
        gotop.style.display="block";
    }
}

