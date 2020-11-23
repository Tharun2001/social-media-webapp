var profiles = Array();
var html = "";
function displaymain(uid, uname, text)
{   
    var html="";

    for(var i=0;i<text.length;i++)
    {
      if( text[i].count == null)
      {
        text[i].count = 0;
      }
      html= html + `<div class="div-post">
      <button class="userprofile-post-btn" onclick="goToProfile(`+ text[i].uid+`)">
      <table>
      <tr>`;
      if(text[i].profilepic == null || text[i].profilepic.length == 0)
      {
         html += `<td><img class="userimg-post" src="../image/profilepic/defaultuser.png"></td>`;
      }
      else
      {
        html += `<td><img class="userimg-post" src="../image/profilepic/`+ text[i].profilepic +`"></td>`;
      }

      html += `<td><p class="username-post"><b>`+ text[i].uname +`</b></p></td>
      </tr>
      </table>
      </button>
      <img class="img-post" src="../image/image`+text[i].post+`"/>
      <table>
      <tr>
      <td><button class="btn-like" id="btn-like-`+text[i].pid+`" onclick="like(`+text[i].pid+`)">Like</button></td>
      <td><input  style="background: transparent; border: none;font-weight: bold; color: black; font-size: 18px;" id="like_`+text[i].pid+`" type="number" value="`+text[i].count+`" disabled></td>
      <td><button  class="comments-show-btn" onclick="commentShow(`+text[i].pid+`)">Comments</button></td>
      </tr>
      </table>
      <div class="div-comments" style="display: none;" id="comments-`+text[i].pid+`">
      </div>
      <br>
      <textarea class="textarea-comment" rows='5' cols='61' placeholder="Write a comment" id="text-`+text[i].pid+`"></textarea>
      <button onclick="comment(`+text[i].pid+`,`+uid+`)">Comment</button></div>`;
     
    }
    document.getElementById('main').innerHTML= document.getElementById('main').innerHTML + html;
    for(var i=0;i<text.length;i++)
    {
        commentFormDiv(text[i].pid);
    }
    $.ajax({
            type: 'POST',
            url: "../like/checkLiked.php",
            data: { },
            success: function(data){
                  data = JSON.parse(data);
                  for(var i=0; i<data.length ; i++)
                  {
                    var btn = document.getElementById('btn-like-'+data[i].pid);
                    btn.style.backgroundColor = "black";
                  }
            },
            async: true
            });

}

function like(pid)
{
    var like="";
    like = document.getElementById('like_'+pid);
    var btn = document.getElementById('btn-like-'+pid);

    $.ajax({
            type: 'POST',
            url: "../like/like.php",
            data: { pid: pid},
            success: function(data){
                    if(data==1){
                    like.value = parseInt(like.value) + 1;
                    btn.style.backgroundColor = "black";
                    }
                    else{
                    like.value = parseInt(like.value) - 1;
                    btn.style.backgroundColor = "#3b5998";
                    }
            },
            async: true
            });
}

function goToProfile(id)
{
    if( id == sessionStorage.getItem('uid'))
    {
        window.location.href = '../Profile/profile.html';
        return;
    }
    else
    {
        window.document.location = '../Friend/friendProfile.html?profileid='+id;
    }

}

function home()
{
    mainNode = document.getElementById('main');
    profileNode = document.getElementById('profile');
    if(mainNode.style.display == "none")
    {
        mainNode.style.display = "block";
        profileNode.style.display = "none";
    }

}

function postValidate()
{
    img = document.getElementById('file').value 
    if(img.length == 0)
    {
        console.log("empty");
        return false;
    }
    else
    {
        return true;
    }
}

