function commentShow(pid)
{
    node = document.getElementById('comments-'+pid);
    if(node.style.display == "none")
    {
        node.style.display = "block";
    }
    else
    {
        node.style.display = "none"
    }

}

function comment(pid, uid)
{
    node = document.getElementById('comments-'+pid);
    console.log(node.innerHTML);
    text = document.getElementById('text-'+pid).value;
    console.log(text)
    if(node.innerHTML == `<p style="text-align: center;">No comments</p>`)
    {
        node.innerHTML = "";   
    }
    if( text.length != 0)
    {
        node.innerHTML = node.innerHTML + `<p class="p-comments"><span style="color: black; font-family: Arial;"><b>`+uname+`</b></span><br>`+text+`</p>`;
        document.getElementById('text-'+pid).value = "";
        $.ajax({
            type: 'POST',
            url: 'comment/postComment.php',
            data: { pid: pid, uid: uid, comment: text},
            success: function(){
            },
            async: true
            });

    }

}

function commentFormDiv(pid)
{
    var text ="";
    $.ajax({
        type: 'GET',
        url: 'comment/getComment.php',
        data: { pid: pid},
        success: function(data){
            data = JSON.parse(data);
            if(data.length!=0)
            {
                
                for(i=0;i<data.length;i++)
                {
                    
                    text = text + `<p class="p-comments"><span style="color: black; font-family: Arial;"><b>`+data[i].uname+`</b></span><br>`+data[i].comnt+`</p>`;    
                }
                console.log(text);
                document.getElementById('comments-'+pid).innerHTML = text;
            }
            else
            {
                document.getElementById('comments-'+pid).innerHTML = `<p style="text-align: center;">No comments</p>`
            }
            
        },
        async: true
        });    
}