@extends('dashboard.layout.layout')

@section('content')
<div class="container-fluid">
    {{-- <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{ asset('admin.jpg') }}" class="img-rounded" width="40px" height="40px" alt="" /> &nbsp;&nbsp;
            <span>{{ Auth::user()->username }}</span>
        </div>
        <!-- Default panel contents -->
        <form method="POST" id="post_create" action="{{ route('post.create') }}" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="panel-body">
                <div class="form-group">
                    <label></label>
                    <textarea name="post" id="post" onkeyup="textAreaAdjust(this, 70)" class="form-control" placeholder="Whats on your mind"></textarea>
                </div>
            </div>

            <!-- Table -->
            <table class="table">
                <span class="pull-left">
                    <div class="element">
                    <i class="fa fa-camera"></i><span class="name"></span>
                    <input style="display: none" type="file" name="image[]" id="" multiple>
                    </div>
                </span>
                <span class="pull-left">
                    <div class="element">
                    <i class="fa fa-video-camera"></i><span class="name"></span>
                    <input style="display: none" type="file" name="video[]" id="" multiple>
                    </div>
                </span>
                <span class="pull-left">
                    <div class="element">
                    <i class="fa fa-file-text"></i><span class="name"></span>
                    <input style="display: none" type="file" name="text[]" id="" multiple>
                    </div>
                </span>
                <span class="pull-left">
                    <div class="form-group">
                        <select name="" id="" class="form-control">
                            <option value="">Only me</option>
                            <option value="">Everyone</option>
                            <option value="">My Friends</option>
                        </select>
                    </div>
                </span>
                <span type="button" id="post_submit" class="btn btn pull-right btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i><b> Creating Post...</b>">Post</span>
            </table>
        </form>
    </div> --}}
</div>
    
@stop

@section('sidebar')
<div class="sidebar-wrapper">
    <div class="logo">
        <a href="{{ route('dashboard') }}" class="simple-text">
            {{ Auth::user()->name }}
        </a>
    </div>

    <ul class="nav">
        <li>
            <a href="dashboard.html">
                <i class="ti-user"></i>
                <p>Profile</p>
            </a>
        </li>
        <li>
            <a href="user.html">
                <i class="ti-panel"></i>
                <p>Settings</p>
            </a>
        </li>
        <li>
            <a href="table.html">
                <i class="ti-view-list-alt"></i>
                <p>Table List</p>
            </a>
        </li>
        <li>
            <a href="typography.html">
                <i class="ti-text"></i>
                <p>Typography</p>
            </a>
        </li>
        <li>
            <a href="{{ route('group.create') }}">
                <i class="ti-pencil-alt2"></i>
                <p>Create Group</p>
            </a>
        </li>
        <li>
            <a href="{{ route('my.group') }}">
                <i class="ti-map"></i>
                <p>My Groups</p>
            </a>
        </li>
        <li>
            <a href="notifications.html">
                <i class="ti-bell"></i>
                <p>Notifications</p>
            </a>
        </li>
    </ul>
</div>
@stop