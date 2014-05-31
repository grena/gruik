@extends('layout')

@section('controller')
    ng-controller="ViewCtrl"
@stop

@section('content')
<style>
.box .todo-list > li .label {
    margin-left: 3px;
    font-size: 9px;
}
.label {
    cursor: pointer;
}
</style>

@if( !$post->private || ($post->private && $user && $user->id == $author->id))

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-solid">
                <div class="box-header">
                    @if($post->private)
                        <span class="hidden-sm hidden-xs label label-default rotate-anti" style="position: absolute; left: -40px; top: 21px;" data-toggle="tooltip" title="" data-original-title="Only you can view this post !"><i class="fa fa-lock"></i> Private</span>
                    @endif
                    <h3 class="box-title"><i class="fa fa-file-text-o"></i> {% $post->title %}</h3>

                    @if($user && $user->id == $author->id)
                    <div class="pull-right box-tools">
                        <a href="{% URL::to('create') .'?edit='. $post->id %}" class="btn btn-default btn-sm" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                    </div>
                    @endif
                </div>

                <hr style="margin:0 5px;">

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12" id="markdown_content">
                            <div class="text-center" ng-hide="post.html !== null">
                                <i class="fa fa-cog fa-spin"></i>
                            </div>
                            <span ng-bind-html="post.html"></span>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="row" >
                        <div class="col-md-12">
                            @foreach($post->tags as $tag)
                                <span class="label label-primary">{% $tag->label %}</span>
                            @endforeach

                            <small class="pull-right" style="color:#A0A0A0;">
                                @if($post->private)
                                    <span class="visible-sm visible-xs label label-default" data-toggle="tooltip" title="" data-original-title="Only you can view this post !"><i class="fa fa-lock"></i> Private</span>
                                @endif
                                By <a href="{% route('user_profile', ['username' => $author->username]); %}">{% $author->username %}</a> | Last edited : <span data-toggle="tooltip" title="" data-original-title="{% $post->updated_at %}">{% $post->updated_at_human %}</span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($post->allow_comments && !$post->private)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-comments"></i> Comments</h3>
                    <div class="pull-right box-tools">
                    </div>
                </div>

                <hr style="margin:0 5px;">

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div ng-show="!comments_loaded" class="text-center" style="margin: 15px 0;">
                                <button ng-disabled="loading" class="btn btn-default btn-sm" ng-click="loadComments()">
                                    <i ng-show="!loading" class="fa fa-refresh"></i>
                                    <i ng-show="loading" class="fa fa-spin fa-cog"></i>
                                        Load comments
                                </button>
                            </div>
                            <div id="disqus_thread"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

@else
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12 text-center" style="color:#8F8F8F; margin:50px 0;">
                        <i class="fa fa-lock fa-5x"></i> <br>
                        <h2>Gruiiiiiiik ! This post is private.</h2>
                        <p>Is it yours ? <a href="{% URL::to('login') %}">Login</a> !</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif



@stop

@section('scripts')
    <script src="/vendor/smoke.js/smoke.min.js" type="text/javascript"></script>
    <script src="/vendor/marked/lib/marked.js" type="text/javascript"></script>
    <script src="/vendor/highlightjs/highlight.pack.js" type="text/javascript"></script>
@stop