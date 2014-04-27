@extends('front.layout')

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

<div class="box box-solid collapsed-box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-search"></i>
            <input class="form-control" type="text" placeholder="Search..." ng-model="title" style="position: absolute; border:0; top: 6px; left: 32px; width: 250px;">
        </h3>
        <div class="box-tools pull-right">
            <button class="btn btn-default btn-sm" data-widget="collapse" ng-click="showSearch = !showSearch">
                <i ng-show="showSearch" class="fa fa-2x fa-angle-double-down"></i>
                <i ng-show="!showSearch" class="fa fa-2x fa-angle-double-up"></i>
            </button>
        </div>
    </div>

    <div class="box-body" style="display:none;">
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Title" ng-model="title" style="border-left:0;border-right:0;border-top:0;border-bottom:1px dotted;">
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
        <i class="fa fa-files-o"></i> <h3 class="box-title">All posts</h3>
    </div>

    <div class="box-body">

        <div class="row">
            <div class="col-md-12">
                <ul class="todo-list ui-sortable">
                    @foreach($posts as $post)
                    <li>
                        <span class="text"><a href="{% URL::to('view/' . $post->id) %}" style="color:#000;">{% $post->title %}</a></span>
                        @foreach($post->tags as $tag)
                        <small class="label label-primary">{% $tag->label %}</small>
                        @endforeach
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@stop