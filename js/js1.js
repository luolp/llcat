/**
 * Created by zowa on 2016-03-18.
 * �ص�����������ť
 * ���·��������ڸǲ�
 */
var btn1=document.getElementById("btn1");
var btn2=document.getElementById("btn2");
var btn3=document.getElementById("btn3");

var height = window.innerHeight;

var beginloc=133;//��ʼλ�ã���һ�ε������°�ť�����λ�ã����½ڵ��Ϸ�
var linenum=parseInt((height-90)/32.4);//ÿ����Ծ������


if(document.body)
    window.onresize=function fun_win_resize(){
        height = window.innerHeight;
        linenum=parseInt((height-90)/32.4);
    }
btn1.onclick=function fun_btn1(){
    scrollBy(0,-linenum*32.4);
}

btn2.onclick=function fun_btn2(){
    var top = document.body.scrollTop||document.documentElement.scrollTop;
    if(top<beginloc){
        scrollTo(0,beginloc)
    }else{
        scrollBy(0,linenum*32.4);
    }

}
btn3.onclick=fun_btn3;
function fun_btn3(){
    if(document.body.scrollTop==0){
        scrollBy(0,-100);
        ad=setTimeout('fun_btn3()',10); //ÿ10msִ��һ��fun2()
        if(document.documentElement.scrollTop<=0)
            clearTimeout(ad);
    }else{
        scrollBy(0,-50);
        ad=setTimeout('fun_btn3()',10); //ÿ10msִ��һ��fun2()
        if(document.body.scrollTop<=0)
            clearTimeout(ad);
    }
}
window.onscroll=function func(){
    var top = document.body.scrollTop||document.documentElement.scrollTop;
    var bodyheight =document.body.scrollTop==0?document.documentElement.scrollHeight:document.body.scrollHeight;
    if(top!=0){
        btn1.className="but1";
    }else{
        btn1.className="but1hidden";
    }
    if(top>=height){
        btn3.className="but3";
    }else{
        btn3.className="but3hidden";
    }
    if(top>=(bodyheight-height)){
        btn2.className="but2hidden";
    }else{
        btn2.className="but2";
    }
/**
    if(top>=201){
        guding1.style.display="block";
    }else{
        guding1.style.display="none";
    }
    if(top>=(bodyheight-height)){
        guding2.style.display="none";
    }else{
        guding2.style.display="block";
    }
*/
}
/**
 * Created by zowa on 2016-04-24.
 */
