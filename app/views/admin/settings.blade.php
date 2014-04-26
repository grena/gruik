@extends('admin.layout')

@section('controller')
    ng-controller="SettingsCtrl"
@stop

@section('content')
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-user"></i> Personal</h3>
    </div>
    <div class="box-body">
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-4">
                <i class="fa fa-envelope" style="position:absolute; top:9px;"></i>
                <input value="{% $user->email %}" class="form-control" type="text" placeholder="Email" style="border-left:0;border-right:0;border-top:0;border-bottom:1px dotted; padding-left: 20px;">
            </div>
        </div>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-4">
                <i class="fa fa-lock" style="position:absolute; top:9px;"></i>
                <input value="" class="form-control" type="password" placeholder="New password" style="border-left:0;border-right:0;border-top:0;border-bottom:1px dotted; padding-left: 20px;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
            <i class="fa fa-lock" style="position:absolute; top:9px;"></i>
                <input value="" class="form-control" type="password" placeholder="Confirm" style="border-left:0;border-right:0;border-top:0;border-bottom:1px dotted; padding-left: 20px;">
            </div>
        </div>
    </div>
</div>

<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-globe"></i> Public</h3>
    </div>
    <div class="box-body">
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-4">
                <i class="fa fa-quote-left" style="position:absolute; top:9px;"></i>
                <textarea name="" id="" rows="3" style="border-left:0;border-right:0;border-top:0;border-bottom:1px dotted; width:100%; padding-left: 20px;" placeholder="About you..."></textarea>
            </div>
        </div>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-4">
                <i class="fa fa-github" style="position:absolute; top:9px;"></i>
                <input value="" class="form-control" type="text" placeholder="GitHub username" style="border-left:0;border-right:0;border-top:0;border-bottom:1px dotted; padding-left: 20px;">
            </div>
        </div>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-4">
                <i class="fa fa-twitter" style="position:absolute; top:9px;"></i>
                <input value="" class="form-control" type="text" placeholder="Twitter username" style="border-left:0;border-right:0;border-top:0;border-bottom:1px dotted; padding-left: 20px;">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <button class="btn btn-block btn-success"><i class="fa fa-check"></i> Gruik !</button>
    </div>
</div>
@stop

