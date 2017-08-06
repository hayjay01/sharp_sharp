@extends('dashboard.layout.layout')

@section('content')
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="body">
            <h2 class="text-center">No One Posted yet</h2>
                <h3 class="text-center"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></h3>
        </div>
    </div>
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
            <a href="#">
                <i class="ti-user"></i>
                <p>Profile</p>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="ti-panel"></i>
                <p>Settings</p>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="ti-view-list-alt"></i>
                <p>Table List</p>
            </a>
        </li>
        <li>
            <a href="#">
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
            <a href="#">
                <i class="ti-bell"></i>
                <p>Notifications</p>
            </a>
        </li>
    </ul>
</div>
@stop