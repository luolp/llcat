/**
 * Created by zowa on 2016-07-31.
 */
var chapter_reader=document.getElementById("chapter_reader");
var page_reader=document.getElementById("page_reader");
var view_block=document.getElementById("view_block");
var gotop=document.getElementById("gotop");

/*�ֻ��Ķ���ά��*/
var qr_block=document.getElementById("qr_block");
/*Ĭ�ϰ�ҳ�Ķ�*/
pageReader();
/*�л�Ϊ��ҳ�Ķ�*/
function pageReader(){
    view_block.className="view_block_1";
    chapter_reader.style.display="block";
    page_reader.style.display="none";
    gotop.style.display="none";
    document.getElementById("change_page_block").style.display="block";
}
/*�л�Ϊ���½��Ķ�*/
function chapterReader(){
    view_block.className="view_block_2";
    chapter_reader.style.display="none";
    page_reader.style.display="block";
    document.getElementById("change_page_block").style.display="none";
}
/*�ص�����*/
function goTop(){
    <!-- ʹ��if�����Ϊ�˼��ݲ�ͬ������� -->
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
/*�ֻ��Ķ���ά��*/
function phoneReader(){
	if(qr_block.style.display=="block"){
		qr_block.style.display="none"
	}else{
		qr_block.style.display="block"
	}
}
/*���¶�ά��*/
function updateQR(bookno,no){
	document.querySelector("#qr_block>img").src="/api/createQR.php?url=http://m.liulangcat.com/yuedu.php?book="+bookno+"@chapter="+no+"@cnum=-1";
}
/*���ض�ά��*/
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

