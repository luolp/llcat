/**
 * Created by zowa on 2016-07-31.
 */
var next_page=document.getElementById("next_page");
var previous_page=document.getElementById("previous_page");
var view_block_height=parseInt(document.getElementById("view_block").offsetHeight);
var content=document.getElementById("content");
var bar_val=document.getElementById("bar_val");
var page_num;
var current_page_no;

document.onkeydown=jumpPage;

function jumpPage() {
    if (event.keyCode==37)//左
        previous_page_f();
    if (event.keyCode==39)//右
        next_page_f();
}

function init_page(){
    if(Math.abs(parseInt(content.style.marginTop))+view_block_height>parseInt(content.scrollHeight)){
        next_page.className="no_page";
    }else{
        next_page.className="next_page";
    }
    if(Math.abs(parseInt(content.style.marginTop))<=0){
        previous_page.className="no_page";
    }else{
        previous_page.className="previous_page";
    }
    current_page_no=1;
    page_num=Math.ceil(parseInt(content.scrollHeight)/view_block_height);

    changeBar();
}
function next_page_f(){
    if(next_page.className=="next_page"){
        content.style.marginTop=parseInt(content.style.marginTop)-view_block_height+"px";
        if(Math.abs(parseInt(content.style.marginTop))+view_block_height>parseInt(content.scrollHeight)){
            next_page.className="no_page";
        }
        if(previous_page.className=="no_page"){
            previous_page.className="previous_page";
        }
        current_page_no+=1;
        changeBar();
    }
}
function previous_page_f(){
    if(previous_page.className=="previous_page"){
        content.style.marginTop=parseInt(content.style.marginTop)+view_block_height+"px";
        if(Math.abs(parseInt(content.style.marginTop))<=0){
            previous_page.className="no_page";
        }
        if(next_page.className=="no_page"){
            next_page.className="next_page";
        }
        current_page_no-=1;
        changeBar();

    }
}
function changeBar(){
    var val=(current_page_no/page_num)*100;
    bar_val.style.width=val+"%";
}

