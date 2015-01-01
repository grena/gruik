@extends('front.layout')

@section('title', 'Forgot Password')

@section('controller', 'ng-controller="ForgotCtrl"')

@section('content')
<div class="form-box" id="login-box">
    <div class="header" style="background:#598D8F;">
        <img src="/img/gruik.png" alt=""> <br> I forgot my password
    </div>
    <form ng-submit="sendEmail()">
        <div class="body bg-gray">

            <div class="text-center" ng-show="flash" ng-cloak>
                <small class="label label-danger"><i class="fa fa-times"></i> {{ flash }}</small>
            </div>

            <div class="form-group">
                <input required ng-disabled="loading" ng-model="email" type="text" class="form-control" placeholder="Email"/>
            </div>
        </div>
        <div class="footer">
            <button ng-disabled="loading" type="submit" class="btn bg-olive btn-block"><i ng-show="loading" class="fa fa-cog fa-spin"></i> Send me this email now !</button>
        </div>
    </form>
</div>
@stop
