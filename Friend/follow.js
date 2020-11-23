function unfollow(profileid)
{
    btnNode = document.getElementById('btn-follow-'+profileid);
    $.ajax({
        type: 'POST',
        url: "follow.php",
        data: { fid: profileid},
        success: function(data){
            console.log(data)
            if( data == 0)
            {
                btnNode.style.backgroundColor = "#55acee";
                btnNode.value = "Follow";
            }
            else if(data == 1)
            {
                btnNode.style.backgroundColor = "#E8E8E8";
                btnNode.value = "Unfollow";

            }
        },
        async: true
        });

    
}