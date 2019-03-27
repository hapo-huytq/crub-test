@extends('users.master')
@section('title'){{"Create User"}}
@stop
@section('breadcrumb')
    <section class="content-header">
        <h1>
            User Manager
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
@stop
@section('content')
    <h4>Create new user</h4>
    <div style="width: 600px;">
        <form action="{{route('users.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label>Name:</label>
                <input type="name" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label>User email:</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label>Password confirm:</label>
                <input type="password" class="form-control" name="pwConfirm">
            </div>
            <div class="form-group">
                <label>User Type:</label>
                <select name="userType" class="form-control" name="userType" >
                    <option value="">Chose Value</option>
                    <option value="2">Admin</option>
                    <option value="3">Hr</option>
                </select>
            </div>
            <div class="form-group">
                <label>Phone number:</label>
                <input type="text" class="form-control" name="phoneNumber">
            </div>
            <div class="form-group">
                <label for="pwd">Avatar:</label>
                <input type="file" class="custom-file-input" id="inputGroupFile01"
                       aria-describedby="inputGroupFileAddon01">
            </div>
            <button type="submit" class="btn btn-primary">Add new</button>
        </form>
    </div>
@stop

