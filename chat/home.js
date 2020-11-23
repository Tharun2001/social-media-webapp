var send_id=sessionStorage.getItem("uid");
console.log("hello");
console.log(send_id);
var rec_id;
window.onload=function() 
{
    $.ajax({  
        type: 'POST',  
        url: 'friends.php', 
        data: {send_id: send_id },
        success: function(responseText) {
            var text = JSON.parse(responseText);
            var list=`<table class="list-table"><th>Friends</th>`;
            for(var i=0;i<text.length;i++)
            {
                list += `<tr><td><button class="btn-list" id="`+text[i].fid +`" onclick="receiver(this.id,'`+text[i].uname+`')" style="width: 100%;">`;
                if(text[i].profiepic == null || text[i].profiepic.length == 0 )
                {
                    list+=`<img class="img-list" src="../image/profilepic/defaultuser.png">`;
                }
                else
                {
                    list += `<img class="img-list" src="../image/profilepic/`+data[i].profilepic+`">`;
                }
                list += `<span class="listname">`+ text[i].uname+`</span></button></td></tr>`;
            }
            document.getElementById("friend_list").innerHTML=list+`</table>`;
            console.log(list);
        }
        
    });
}
function receiver(rec, rec_name)
{
    document.getElementById("wrapper").style.display = "block";
    rec_id=rec;
    document.getElementById("receiver_name").innerHTML=rec_name;
    var chatbox = document.getElementById("chatbox");
    chatbox.innerHTML = "";
    $.ajax({  
        type: 'POST',  
        url: 'msg.php', 
        data: {send_id: send_id, rec_id: rec_id },
        success: function(responseText) {
            if( responseText.length != 0)
            {
                var text = JSON.parse(responseText);
                for(var i=0; i < text.length; i++)
                {
                    if(text[i].send_id==send_id)
                    {
                        chatbox.innerHTML= chatbox.innerHTML + `<p class="sender"><span>`+text[i].msg+`</span></p>`;
                    }
                    else
                    {
                        chatbox.innerHTML= chatbox.innerHTML + `<p class="receiver"><span>`+text[i].msg+`</span></p>`;
                    }
                }
            }
        }
    
    });
    
}


function send()
{
    var msg=document.getElementById("msg");
    if(msg.value.length == 0)
    { 
      return;
    }
    var chatbox = document.getElementById("chatbox");
    
    chatbox.innerHTML = chatbox.innerHTML +`<p class="sender"><span>`+msg.value+"</span></p>";
    $.ajax({  
        type: 'POST',  
        url: 'insert_msg.php', 
        data: { msg: msg.value, send_id: send_id, rec_id: rec_id},
        success: function(response) {
            console.log("success");
        }
    });
    msg.value="";
    
}

