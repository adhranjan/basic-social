$(".replyComment").keydown(function (e) {
    if (e.keyCode == 13) {
        postID=event.target.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.dataset['postid'];
        var commentID=event.target.parentNode.parentNode.dataset['commentid'];
        var replyth=event.target.parentNode.dataset['replybox'];
        var replyBody=this.value;
        if (!replyBody.trim()){
            return false;
        }
        $.ajax({
            method:'get',
            url:urlCommentreply,
            data:{replyBody:replyBody,postId:postID,commentId:commentID,_token: token}
        }).done(function(msg) {
            $('#replybox'+replyth).addClass('hideandseek');
            $('#replybox'+replyth).after("<span class='reply_by'>You: </span><span class='reply_body'>"+replyBody+"</span>");
                });
    }
});