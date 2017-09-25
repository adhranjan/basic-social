<div class="message">
    @if(Session::has('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
    @endif

    @if(Session::has('fail'))
        <p class="alert alert-danger">{{ Session::get('fail') }}</p>
    @endif
</div>

