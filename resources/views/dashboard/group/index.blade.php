@extends('dashboard.layout.layout')

@section('content')
<p></br></p>
<div class="container-fluid">
    @if($group->count() === 0)
        <h2>No Groups yet!!!</h2>
    @else
        @foreach($group as $groups)
            <div class="panel panel-default">
                <div class="panel-heading fixed">
                    <a href="{{ route('show.group', ['slug' => $groups->slug]) }}">{{ $groups->title }}</a>

                    <span> <i><b>Created by {{ $groups->user->username }}</i></b>, <b><i>{{ $groups->created_at->diffForHumans() }}</i></b></span>
                    
                </div>
                <div class="panel-body">
                    {{ str_limit($groups->details, 200) }}
                </div>
                <div class="panel-footer">
                    <span><button class="btn btn-primary btn-xs" type="button">
                    Members <span class="badge">4</span>
                    </button></span>
                    <span><button class="btn btn-primary btn-xs" type="button">
                    Posts <span class="badge">4</span>
                    </button></span>
                    <span class="btn btn pull-right btn-info btn-xs" style="margin-right: 9px;">Join Group</span>
                </div>
            </div>
        @endforeach
    @endif
</div>
    
@stop

@section('sidebar')
<div class="sidebar-wrapper">
    <div class="logo">
        <a href="#" class="simple-text">
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