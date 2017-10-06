<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap-theme.min.css') }}" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('asset/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{URL::to('css/style.css')}}">

</head>
<body>
<div class="container">
    @yield('section')
</div>
</body>
<script src="{{ asset('asset/js/jquery.min.js') }}"></script>
<script src="{{ asset('asset/js/bootstrap.min.js') }}" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="{{URL::to('js/app.js')}}"></script>
<script src="{{URL::to('js/comment.js')}}"></script>
<script src="{{URL::to('js/connection.js')}}"></script>
<script src="{{URL::to('js/commentreply.js')}}"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('eb245b46960baa4bf91e', {
        encrypted: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        $('#post_holder_').append(data.post)
    });
</script>
@yield('footer')

</html>