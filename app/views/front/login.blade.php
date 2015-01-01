@extends('front.layout')

@section('title', 'Login')

@section('controller', 'ng-controller="LoginCtrl"')

@section('content')
<div class="form-box" id="login-box">
    <div class="header" style="background:#598D8F;">
        <img src="/img/gruik.png" alt=""> <br> Authentication
    </div>
    <form ng-submit="login()">
        <div class="body bg-gray">

            <div class="text-center" ng-show="flash" ng-cloak>
                <small class="label label-danger"><i class="fa fa-times"></i> {{ flash }}</small>
            </div>

            <div class="form-group">
                <input required ng-disabled="loading" ng-model="user.email" type="text" class="form-control" placeholder="Email" name="email"/>
            </div>
            <div class="form-group">
                <input required ng-disabled="loading" ng-model="user.password" type="password" class="form-control" placeholder="Password"/>
            </div>
            <div class="form-group">
                <label for="remember" >
                    <input ng-model="user.remember" type="checkbox" id="remember"/> Remember me
                </label>
            </div>
        </div>
        <div class="footer">
            <button ng-disabled="loading" type="submit" class="btn bg-olive btn-block"><i ng-show="loading" class="fa fa-cog fa-spin"></i> Login</button>
            <a href="{% URL::to('register') %}" class="btn btn-default btn-block">Register</a>

            <p class="pull-right"><a href="{% URL::to('forgot-password')%}">I forgot my password</a></p>
            <p><a href="{% URL::to('/') %}"><i class="fa fa-angle-double-left"></i> Return to home</a></p>
        </div>
    </form>
</div>
@stop