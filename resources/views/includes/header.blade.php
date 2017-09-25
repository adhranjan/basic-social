<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="dashboard">{{Auth::User()->fullname}}</a>

        </div>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a class="navbar-brand" href="profile">Profile</a>
            </li>
            <li>
                <a href="{{route('logout')}}">Logout</a>
            </li>
        </ul>
    </div>
</nav>
