$( document ).ready(function() {
    $(".commentInput").keydown(function (e) {
        if (e.keyCode == 13) {
            postID=event.target.parentNode.parentNode.parentNode.parentNode.dataset['postid'];
            postOf=event.target.parentNode.dataset['postid'];
            var comment_body=this.value;
            if (!comment_body.trim()){
                return false;
            }
            $.ajax({
                method:'get',
                url:urlComment,
                data:{comment_body:comment_body,postId:postID,_token: token}
            }).done(function(msg) {
                $( ".comments"+postID ).empty();
                $.each(msg, function() {
                    $.each(this, function(msg, v) {
                        if(v.replyBody== null){
                            $('.comments'+postID).append("<div class='panel-body'><span class='comment_by'>"+ v.fullname+" : </span><span class='comment_body'>"+ v.comment_body+"</span></div>");
                        }else {
                            $('.comments' + postID).append("<div class='panel-body'><span class='comment_by'>"+v.fullname+" : </span><span class='comment_body'>"+v.comment_body+ "</span><br/><span class='reply_by'>"+postOf+" </span><span class='reply_body'>"+v.replyBody+"</span>");
                        }
                        $(".commentInput").val("");
                    });
                });
            });
        }
    });

});