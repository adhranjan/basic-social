<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit your thought</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="body" rows="5" placeholder="Share your thoughts................">{{$post->body}}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Edit</button>
<a href="{{ route('delete', $post->id )}}"><button type="button" class="btn btn-danger btn-sm" >Delete</button></a>
