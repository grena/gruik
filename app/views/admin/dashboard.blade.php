@extends('admin.layout')

@section('controller')
    ng-controller="DashboardCtrl"
@stop

@section('content')

<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-info-circle"></i></h3>
        <div class="box-tools pull-right">
            <button class="btn btn-default btn-sm" data-widget="collapse" ng-click="showInfos = !showInfos">
                <i ng-show="showInfos" class="fa fa-2x fa-angle-double-down"></i>
                <i ng-show="!showInfos" class="fa fa-2x fa-angle-double-up"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Title" ng-model="title" style="border-left:0;border-right:0;border-top:0;">
            </div>
        </div>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-4">
                <select id="input-tags" placeholder="Tags..." ng-model="test"></select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p>This post is :
                    <span ng-show="private">
                        &nbsp;<a href="#" ng-click="private = !private" style="border-bottom:1px dotted; font-size: 18px;">Private</a>
                    </span>
                    <span ng-show="!private">
                        &nbsp;<a href="#" ng-click="private = !private" style="border-bottom:1px dotted; font-size: 18px;">Public</a>
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="box box-solid">
    <div class="box-header" style="border-bottom: 1px solid #EEEEEE;">
        <i class="fa fa-file-text"></i>
        <div class="btn-group" style="margin-left: 15px; margin-top: 5px;">
            <button class="btn btn-default btn-sm" ng-click="preview(false)" ng-class="!is_preview ? 'active' : ''">Code</button>
            <button class="btn btn-default btn-sm" ng-click="preview(true)" ng-class="is_preview ? 'active' : ''">Preview</button>
        </div>
        <button class="pull-right btn btn-sm btn-success" ng-click="save()" style="margin-right: 5px; margin-top: 5px; width:150px;">Save</button>
    </div>

    <div class="box-body" ng-class="is_preview ? '' : 'no-padding'">
        <div class="row">
            <div class="col-md-12">

                <div style="display: block;" ng-show="!is_preview">
                    <div id="editor" class="ace_editor ace-twilight" style="height: 560px; width: 100%;"></div>
                </div>

                <div style="display: block; min-height: 560px; width: 100%;" ng-show="is_preview">
                    <span ng-bind-html="preview_content"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/marked/lib/marked.js" type="text/javascript"></script>
<script src="/vendor/highlightjs/highlight.pack.js" type="text/javascript"></script>
<script src="/js/ace/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="/js/ace/theme-monokai.js" type="text/javascript" charset="utf-8"></script>
<script src="/js/ace/mode-markdown.js" type="text/javascript" charset="utf-8"></script>
@stop