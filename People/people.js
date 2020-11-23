function formTable(data)
{
    html = "";
    for(i=0;i<data.length;i++)
    {
        if(data[i].profilepic == null || data[i].profilepic.length == 0)
        {
            console.log("empty");
            html += `<tr>
            <td><button class="btn-profile" onclick=profile(`+data[i].uid+`)> <img src="../image/profilepic/defaultuser.png"> <span class="profile-name">`+data[i].uname+`</span></button> </td>
            </tr>`
        }
        else
        {
            html += `<tr>
            <td><button class="btn-profile" onclick=profile(`+data[i].uid+`)><img src="../image/profilepic/`+data[i].profilepic+`"> <span class="profile-name">`+data[i].uname+`</span></button> </td>
            </tr>`
        }
    }
    html += `</table>`;
    return html;
}
function profile(id)
{
    window.document.location = '../Friend/friendProfile.html?profileid='+id;
}