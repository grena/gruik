@extends('front.layout')

@section('title', 'Reset password')

@section('controller', 'ng-controller="ResetPasswordCtrl"')

@section('content')
<div class="form-box" id="login-box">
    <div class="header" style="background:#598D8F;">
        <img src="/img/gruik.png" alt=""> <br> Reset my password
    </div>
    <form ng-submit="sendNewPassword('{% $token %}')">
        <div class="body bg-gray">

            <div class="text-center" ng-show="flash" ng-cloak>
                <small class="label label-danger"><i class="fa fa-times"></i> {{ flash }}</small>
            </div>

            <div class="form-group">
                <input required ng-disabled="loading" ng-model="password" type="text" class="form-control" placeholder="Password"/>
            </div>
            <div class="form-group">
                <input required ng-disabled="loading" ng-model="password_confirmation" type="text" class="form-control" placeholder="Password"/>
            </div>
        </div>
        <div class="footer">
            <button ng-disabled="loading" type="submit" class="btn bg-olive btn-block"><i ng-show="loading" class="fa fa-cog fa-spin"></i> Ok</button>
        </div>
    </form>
</div>
@stop
