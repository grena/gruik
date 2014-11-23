@extends('layout')

@section('controller')
    ng-controller="CreateCtrl"
@stop

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-default"
        <div class="box box-solid" ng-cloak>
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i>
                <span ng-show="currentPost.id > 0">Post #{{ currentPost.id }}</span>
                <span ng-show="currentPost.id == 0">New post</span>
                <small ng-show="currentPost.id > 0">- <a href="{% URL::to('view') %}/{{ currentPost.id }}" style="text-decoration:underline;">View this post</a></small>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <input class="form-control" type="text" placeholder="Title" ng-model="currentPost.title" style="border-left:0;border-right:0;border-top:0;border-bottom:1px dotted;">
                    </div>
                    <div class="col-md-6">
                        <select id="input-tags" placeholder="Tags..." selectize="selectizeConfig" options='selectizeOptions' ng-model="currentPost.tags"></select>
                    </div>
                </div>
            </div>
            <div class="panel-footer small">
                <div class="row">
                    <div class="col-md-6">
                        This post is
                        <span ng-show="currentPost.private">
                            &nbsp;<a ng-click="currentPost.private = !currentPost.private" style="border-bottom:1px dotted; cursor:pointer;">private</a>
                        </span>
                        <span ng-show="!currentPost.private">
                            &nbsp;<a ng-click="currentPost.private = !currentPost.private" style="border-bottom:1px dotted; cursor:pointer;">public</a>
                        </span>
                        <span ng-show="!currentPost.private">
                            &nbsp; and comments are
                            <span ng-show="currentPost.allow_comments">
                                &nbsp;<a ng-click="currentPost.allow_comments = !currentPost.allow_comments" style="border-bottom:1px dotted; cursor:pointer;">enabled</a>
                            </span>
                            <span ng-show="!currentPost.allow_comments">
                                &nbsp;<a ng-click="currentPost.allow_comments = !currentPost.allow_comments" style="border-bottom:1px dotted; cursor:pointer;">disabled</a>
                            </span>
                        </span>
                        .
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-solid" ng-cloak>
            <div class="box-header" style="border-bottom: 1px solid #EEEEEE;">
                <i class="fa fa-file-text"></i>
                <div class="btn-group" style="margin-left: 15px; margin-top: 5px;">
                    <button class="btn btn-default btn-sm" ng-click="preview(false)" ng-class="!is_preview ? 'active' : ''">Markdown</button>
                    <button class="btn btn-default btn-sm" ng-click="preview(true)" ng-class="is_preview ? 'active' : ''">Preview</button>
                </div>
                <div class="btn-group" style="margin-left: 30px; margin-top: 5px;">
                    <button class="btn btn-default btn-sm" style="color:#31708f;"  data-toggle="modal" data-target="#helpMarkdown"><i class="fa fa-question-circle"></i> Markdown syntax</button>
                </div>
                <button class="pull-right btn btn-sm btn-success" ng-click="save()" style="margin-right: 5px; margin-top: 5px; width:150px;" ng-disabled="loading">Save</button>
                <div class="pull-right" style="margin-top: 10px; margin-right: 10px;" ng-show="loading">
                    <i class="fa fa-cog fa-spin"></i> Processing...
                </div>
            </div>

            <div class="box-body" ng-class="is_preview ? '' : 'no-padding'">
                <div class="row">
                    <div class="col-md-12">

                        <div style="display: block;" ng-show="!is_preview">
                            <div id="editor" class="ace_editor ace-twilight" style="height: 560px; width: 100%;"></div>
                        </div>

                        <div style="display: block; min-height: 560px; width: 100%;" ng-show="is_preview" id="markdown_content">
                            <span ng-bind-html="currentPost.html"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@include('modals.markdown-syntax-help')

@section('scripts')
    <script src="/vendor/marked/lib/marked.js" type="text/javascript"></script>
    <script src="/vendor/highlightjs/highlight.pack.js" type="text/javascript"></script>
    <script src="/js/ace/ace.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/ace/theme-monokai.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/ace/mode-markdown.js" type="text/javascript" charset="utf-8"></script>
    <script src="/vendor/humane-js/humane.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/vendor/smoke.js/smoke.min.js" type="text/javascript"></script>
@stop