var postID = 0;
var postBodyElement=null;
$('.post').find('.interaction').find('.edit').on('click',function(event){
    event.preventDefault();
    postBodyElement=event.target.parentNode.parentNode.parentNode.childNodes[1].childNodes[1];
    var postBody=postBodyElement.textContent;
    postID=event.target.parentNode.parentNode.parentNode.parentNode.dataset['postid'];
    $('#post-body').val(postBody);
    $('#edit-modal').modal();
});
$('#modal-save').on('click', function () {
    $.ajax({
        method:'get',
        url:urlEdit,
        data:{body:$('#post-body').val(),postId:postID,_token: token}
    }).done(function(msg) {
        $(postBodyElement).text(msg['new_body']);
        $(postBodyElement).addClass("updated");
        $('#edit-modal').modal('hide');
    });
});

$('.like').on('click', function(event){
    event.preventDefault();
    postID=event.target.parentNode.parentNode.parentNode.parentNode.dataset['postid'];
    var isLike=event.target.previousElementSibling==null;
    $.ajax({
        method:"GET",
        url:urlLike,
        data:{isLike:isLike, postId:postID}
    }).done(function(msg) {
        if(msg.insert=="true"){
            $(event.target).removeAttr("class");
            $(event.target).addClass("fa fa-thumbs-up like");
        }else if(msg.insert=="false"){
            $(event.target).removeAttr("class");
            $(event.target).addClass("fa fa-thumbs-down like");
        }else if(msg.delete=="true"){
            $(event.target).removeAttr("class");
            $(event.target).addClass("fa fa-thumbs-o-up like");
        }else if(msg.delete=="false"){
            $(event.target).removeAttr("class");
            $(event.target).addClass("fa fa-thumbs-o-down like");
        }else if(msg.update=="true"){
            $(event.target).removeAttr("class");
            $(event.target).addClass("fa fa-thumbs-up like");
            $("#down"+postID).removeAttr("class");
            $("#down"+postID).addClass("fa fa-thumbs-o-down like");
        }else if(msg.update=="false"){
            $(event.target).removeAttr("class");
            $(event.target).addClass("fa fa-thumbs-down like");
            $("#up"+postID).removeAttr("class");
            $("#up"+postID).addClass("fa fa-thumbs-o-up like");
        }
        $("#likesamount"+postID).text(msg.likes);
        $("#dislikesamount"+postID).text(msg.dislike);
    })
});

$('.showHide').on('click', function () {
    postID=event.target.parentNode.parentNode.parentNode.dataset['postid'];
    $('#underStatus'+postID).slideToggle();
});


