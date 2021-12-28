$(function() {

    "use strict";

    $('.chat-left-inner > .chatonline, .chat-rbox').perfectScrollbar();

    var cht = function() {
        var topOffset = 450;
        var height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        $(".chat-list").css("height", (height) + "px");
    };
    $(window).ready(cht);
    $(window).on("resize", cht);

    // this is for the left-aside-fix in content area with scroll
    var chtin = function() {
        var topOffset = 270;
        var height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        $(".chat-left-inner").css("height", (height) + "px");
    };
    $(window).ready(chtin);
    $(window).on("resize", chtin);

    $(".open-panel").on("click", function() {
        $(".chat-left-aside").toggleClass("open-pnl");
        $(".open-panel i").toggleClass("ti-angle-left");
    });

    startGettingChat();
    setTimeout(function(){
        $(".chat-rbox").scrollTop($(".chat-rbox")[0].scrollHeight);
    },2000)
    
});

function startGettingChat()
{
    $.post(base_url+"admin/chat/get_chat",{chat_user_id},function(data){
        $(".chat-list").html(data);
        setTimeout(function(){

            startGettingChat()
        },1500)
    });
}
var sendingnow = false;
function sendMsg(that)
{

    if(sendingnow) return
    var msg = $("#newmsg").val();

    if(msg==""){
        alert('Please enter your message')
        return
    }


    $(that).hide();
    $("#sender_place").show();
    sendingnow =true


    $.post(base_url+"admin/chat/send",{msg,chat_user_id},function(data){
        var d = JSON.parse(data);

        
        $("#sender_place").hide();
        $(that).show();
        sendingnow =false



        if(d.action=="success")
        {

            $("#newmsg").val("");
            $(".chat-list").append(data.html);

            setTimeout(function(){
                $(".chat-rbox").scrollTop($(".chat-rbox")[0].scrollHeight);
            },1000)

        }
        else{
            alert(d.error);
        }
    });
}