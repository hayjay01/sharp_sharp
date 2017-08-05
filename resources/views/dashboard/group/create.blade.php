@extends('dashboard.layout.layout')

@section('content')
<p></br></p>
<div class="container-fluid">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Create Group</h4>
            </div>
            <div class="content">
                <form method="post" id="group_form" action="{{ route('process.create') }}" >
                    {{ csrf_field() }}
                    <div class="alert alert-danger print-error-msg" style="display:none"> 
                        <ul></ul>
                    </div>
                    <div class="alert alert-success print-success-msg" style="display:none">
                        <span></span>
                    </div></br>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Group Title</label>
                                <input type="text" name="title" class="form-control border-input" placeholder="Group Title" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category" class="form-control border-input" id="">
                                    @foreach($category as $categories)
                                        <option value="{{ $categories->id }}">{{ $categories->title }}</option>
                                    @endforeach
                                </select>   
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Group Details</label>
                                <textarea rows="5" name="details" class="form-control border-input" placeholder="Group Details..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" id="group_submit" class="btn btn-info btn-fill btn-wd" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait...">Create Group</button>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
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
        <li class="active">
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