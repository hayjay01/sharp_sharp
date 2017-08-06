@extends('dashboard.layout.layout')

@section('content')
<div class="container-fluid">
    <img src="{{ asset('this.png') }}" class="img-responsive" alt="" />
    <div class="panel panel-default">
        
        <h6><p>{{ $group->title }} <span><i>Created by {{ strtolower($group->user->username) }}</i></span></p> </h6> 
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{ asset('admin.jpg') }}" class="img-rounded" width="40px" height="40px" alt="" /> &nbsp;&nbsp;
            <span>{{ Auth::user()->username }}</span>
        </div>
        <!-- Default panel contents -->
        <form method="POST" action="{{ route('post.create') }}" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="panel-body">
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label></label>
                    <textarea name="content" id="content" class="form-control" placeholder="Whats on your mind"></textarea>

                    @if($errors->has('content'))
                        <span class="help-block">{{ $errors->first('content') }}</span>
                    @endif
                </div>
            </div>

            <!-- Table -->
            <table class="table">
                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                    <input type="file" name="image[]" id="" multiple>

                    @if($errors->has('image'))
                        <span class="help-block">{{ $errors->first('image') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('video') ? ' has-error' : '' }}">  
                    <input type="file" name="video" >

                    @if($errors->has('video'))
                        <span class="help-block">{{ $errors->first('video') }}</span>
                    @endif
                </div>  
                <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                    <input type="file" name="text" >

                    @if($errors->has('text'))
                        <span class="help-block">{{ $errors->first('text') }}</span>
                    @endif
                </div>    
                
                <span class="pull-left">
                    <div class="form-group">
                        <select name="see" id="" class="form-control">
                            <option value="">Only me</option>
                            <option value="">Everyone</option>
                            <option value="">My Friends</option>
                        </select>
                    </div>
                </span>
                <button type="submit" class="btn btn pull-right btn-primary" >Post</span>
            </table>
        </form>
    </div>

    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-info">All</button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-info">Text</button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-info">Photos</button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-info">Videos</button>
        </div>
    </div>
    <p></br></p>
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
                <i class="ti-anchor"></i>
                <p>All Members <span class="badge">{{ $group->members()->count() }}</span></p>
            </a>
        </li>
        <li>
            <a >
                <i class="ti-dribbble"></i>
                <p>Public</p>
            </a>
        </li>
        <li>
            <a>
                <i class="ti-view-list-alt"></i>
                <p>{{ $group->category->title }}</p>
            </a>
        </li>
        <li>
            <a>
                <i class="ti-text"></i>
                <p>Posts <span class="badge">2</span></p>
            </a>
        </li>
        <hr>
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
                <p>Notifications <span class="badge">2</span></p>
            </a>
        </li>
    </ul>
</div>
@stop