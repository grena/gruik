@extends('admin.layout')

@section('controller')
    ng-controller="DashboardCtrl"
@stop

@section('content')

<div class="box box-solid">
    <div class="box-header">
    </div>

    <div class="box-body">
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-3">
                <input class="form-control input-sm" type="text" placeholder="Title..." ng-model="title">
            </div>
            <div class="col-md-2 col-md-offset-7">
                <a href="#" class="btn btn-sm btn-primary btn-block pull-right" role="button" ng-click="save()">Save</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <input class="form-control input-sm" type="text" placeholder="Tags..." ng-model="tags">
            </div>
            <div class="col-md-9">
                <small class="label label-info"><a href="#"><i class="fa fa-times"></i></a> Open-Source</small>
                <small class="label label-info"><a href="#"><i class="fa fa-times"></i></a> Snippet</small>
                <small class="label label-info"><a href="#"><i class="fa fa-times"></i></a> JavaScript</small>
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