/**
 * Created by zowa on 2016-07-31.
 */
var xmlHttp;
document.onclick=hiddenLeft;
document.getElementById("left").onclick=function(){
    event.stopPropagation();
}
function createxmlHttpRequestObject(){
    if(window.ActiveXObject){
        try{
            xmlHttp= new ActiveXObject("Microsoft.XMLHTTP");
        }catch(e){
            xmlHttp=false;
        }
    }else{
        try{
            xmlHttp=new XMLHttpRequest();
        }catch (e){
            xmlHttp=false;
        }
    }
    if(!xmlHttp){
        alert("创建XMLHttpRequest对象时出现错误！！！");
    }else{
        return xmlHttp;
    }
}
function hiddenLeft(){
    var left=document.getElementById("left");
    left.style.left="-500px";
}
function viewLeft(){
    var left=document.getElementById("left");
    if(left.style.left=="0px"){
        left.style.left="-500px";
    }else{
        left.style.left="0px";
    }
    event.stopPropagation();
}

function getcontent(th,dir,bookno,no){
	var selected=document.querySelector(".selected");
	if(selected!=null){
		selected.className="";
	}
	th.parentNode.className="selected";
	document.getElementById("content").innerHTML="<div align='center'><img src='/yuedu/ajax-loader.gif'><div>";
	var url="/getcontent.php?dir="+dir+"&bookno="+bookno+"&no="+no;
    document.getElementById("top_chaptername").innerHTML=th.innerHTML;
    document.getElementById("content").style.marginTop="0px";
    createxmlHttpRequestObject();
    xmlHttp.onreadystatechange=function()
    {
        if (xmlHttp.readyState==4 && xmlHttp.status==200)
        {
            document.getElementById("content").innerHTML=xmlHttp.responseText;
            init_page();
			// 更新二维码
			updateQR(bookno,no);
        }
    }
    xmlHttp.open("GET",url,true);
    xmlHttp.send();
}
