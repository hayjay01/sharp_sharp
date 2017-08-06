<nav class="navbar navbar-default navbar-fixed-top inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a class="navbar-brand" href="#">Dashboard</a>
        </div>
        <div class="col-sm-5 col-md 5">
            <form class="navbar-form navbar-left" style="decoration: none;">
                <div class="form-group">
                <input type="text" class="form-control border-input" placeholder="Search">
                </div>
            </form>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ route('groups') }}"><i class="fa fa-users" aria-hidden="true"></i>All Groups</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="ti-home"></i>
                        <p>{{ Auth::user()->username }}</p>
                    </a>
                </li>
                <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <p><img src="{{ asset('admin.jpg') }}" style="width:20px; height:20px;" class="img-rounded" alt=""></p>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Create New Page</a></li>
                        <li><a href="{{ route('group.create') }}">Create New Group</a></li>
                        <li><a href="#">Edit</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>
<p></br></p>
<p></br></p>