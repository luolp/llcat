var xmlHttp;
var numchars;
function $(id){
    return document.getElementById(id);
}

gaibianchar();
function createXmlHttpRequestObject(){
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
        alert("����XMLHttpRequest����ʱ���ִ��󣡣���");
    }else{
        return xmlHttp;
    }
}
function mulu(){
var top = document.body.scrollTop||document.documentElement.scrollTop;
scrollTo(0,0);
    var wbk=document.getElementById("xzdchapter");
    wbk.value=0;
    gaibianchar();
    show_chapter_content();
}
function set(){
    if($("set").style.display=="block"){
        $("set").style.display="none";
    }else{
        $("set").style.display="block";
    }

}
function itemOnClick(i){
    var wbk=document.getElementById("xzdchapter");
    wbk.value=i;
    gaibianchar();
    show_chapter_content();
}
function shangyizhang(){
var top = document.body.scrollTop||document.documentElement.scrollTop;
scrollTo(0,0);
    var wbk=document.getElementById("xzdchapter");
    wbk.value=parseInt(wbk.value)-1;
    gaibianchar();
    show_chapter_content();
}
function xiayizhang(){
var top = document.body.scrollTop||document.documentElement.scrollTop;
scrollTo(0,0);
    var wbk=document.getElementById("xzdchapter");
    wbk.value=parseInt(wbk.value)+1;
    gaibianchar();
    show_chapter_content();
}
function gaibianchar(){
    var h3=document.getElementById("chapter");
    var chapter=parseInt(document.getElementById("xzdchapter").value);
    var numchar=zhuanbian(chapter);
    var str="";
    if(chapter>1)
        str=str+"<a class=\"numpage\" onclick=\"shangyizhang()\" title=\"��һ��\">&lt;&nbsp;&nbsp;</a>";
    else
        str=str+"<span style=\"color: darkgray\">&lt;&nbsp;&nbsp;</span>";
    str=str+"��"+numchar+"��";

    if(chapter<document.getElementById("bookchapter").value)
    str=str+"<a class=\"numpage\" onclick=\"xiayizhang()\" title=\"��һ��\">&nbsp;&nbsp;&gt;</a>";
else
    str=str+"<span style=\"color: darkgray\">&nbsp;&nbsp;&gt;</span>";
    h3.innerHTML=str;

}
function fragment(chapterf){
    switch(chapterf){
        case 1:numchars='һ';break;
        case 2:numchars='��';break;
        case 3:numchars='��';break;
        case 4:numchars='��';break;
        case 5:numchars='��';break;
        case 6:numchars='��';break;
        case 7:numchars='��';break;
        case 8:numchars='��';break;
        case 9:numchars='��';break;
        case 10:numchars='ʮ';break;
    }
}
function zhuanbian(chapter){
    var numchar;
    if(chapter==0){
        numchar='0';
    }
    if(chapter>0&&chapter<=10){
        fragment(chapter);
        numchar=numchars;
    }
    if(chapter>10&&chapter<20){
        fragment(chapter%10);
        numchar='ʮ'+numchars;
    }
    if(chapter>=20&&chapter<100){
        var num1,num2;
        num1=parseInt(chapter/10);
        num2=chapter%10;
        fragment(num1);
        numchar=numchars+'ʮ';
        if(num2!=0){
            fragment(num2);
            numchar=numchar+numchars;
        }
    }
    if(chapter>=100){
        var chap;
        var num1,num2,num3;
        num3=chapter%10;
        chap=parseInt(chapter/10);
        num2=chap%10;
        num1=parseInt(chap/10);
        fragment(num1);
        numchar=numchars+'��';
        if(num2==0&&num3!=0){
            numchar=numchar+'��';
            fragment(num3);
            numchar=numchar+numchars;
        }
        if(num2!=0){
            fragment(num2);
            numchar=numchar+numchars+'ʮ';
            fragment(num3);
            numchar=numchar+numchars;
        }
    }
    return numchar;
}
function show_chapter_content(){
    var chapter=document.getElementById("xzdchapter").value;
    var str="/textcontent.php?dir="+$("dir").value+"&bookno="+$("bookno").value+"&chapter="+chapter+"&bookchapter="+$("bookchapter").value;
    createXmlHttpRequestObject();
    xmlHttp.onreadystatechange=handler;
    xmlHttp.open("GET",str,false);
    xmlHttp.send(null);
}
function handler(){
    if(xmlHttp.readyState==4){
        if(xmlHttp.status==200){
            document.getElementById("text_content").innerHTML=xmlHttp.responseText;
            gaibianset_bgcolor();
            gaibianset_color();
            gaibianset_family();
            gaibianset_size();
        }
    }
}


/**
 * Created by zowa on 2016-04-21.
 * �Ķ����ݵ����ã����壬�����С�ȣ�
 */

//��ʾ/����ÿһ��set_item
var nextSib;
function set_item_click(itemid){
    nextSib=itemid.nextSibling.nextSibling;
    if(nextSib.style.display!="block"){
        nextSib.style.display="block";
    }else{
        nextSib.style.display="none";
    }
}

//�۽���ʾ��ǰ������
function focus_family(){
    var i;
    var font_family=$("font_family_info").value;
    var item=N("font_family");
    for(i=0;i<item.length;i++){
        item[i].style.border="0px solid #000000";
        if(item[i].style.fontFamily==font_family){
            item[i].style.borderLeft="1px solid #000000";
            item[i].style.borderBottom="1px solid #000000";
        }
    }
}
function focus_size(){
    $("size_num").innerText=$("font_size_info").value+"px";
}
function focus_color(){
    var i;
    var font_color=$("font_color_info").value;
    var item=N("font_color");
    for(i=0;i<item.length;i++){
        item[i].style.border="0px";
        if(item[i].style.backgroundColor==font_color){
            item[i].style.border="1px solid red";
        }
    }
}
function focus_bgcolor(){
    var i;
    var font_bgcolor=$("font_bgcolor_info").value;
    var item=N("font_bgcolor");
    for(i=0;i<item.length;i++){
        item[i].style.border="0px";
        if(item[i].style.backgroundColor==font_bgcolor){
            item[i].style.border="1px solid red";
        }
    }
}

//����1
function font_family_click(thi){
    $("font_family_info").value=thi.style.fontFamily;
    focus_family();
    gaibianset_family();
}
function gaibianset_family(){
    $("pre").style.fontFamily=$("font_family_info").value;
}

//����2
function font_size_jian(){
    $("font_size_info").value=$("font_size_info").value-1;
    focus_size();
    gaibianset_size();
}
function font_size_jia(){

    $("font_size_info").value=parseInt($("font_size_info").value)+1;
    focus_size();
    gaibianset_size();
}
function gaibianset_size(){
    $("pre").style.fontSize=$("font_size_info").value+"px";
}
//����3
function font_color_click(thi){
    $("font_color_info").value=thi.style.backgroundColor;
    focus_color();
    gaibianset_color();
}
function gaibianset_color(){
    $("pre").style.color=$("font_color_info").value;
}
//����4
function font_bgcolor_click(thi){
    $("font_bgcolor_info").value=thi.style.backgroundColor;
    focus_bgcolor();
    gaibianset_bgcolor();
}
function gaibianset_bgcolor(){
    $("pre").style.backgroundColor=$("font_bgcolor_info").value;
}
