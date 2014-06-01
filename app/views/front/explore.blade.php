@extends('layout')

@section('controller')
    ng-controller="ExploreCtrl"
@stop

@section('content')
<div class="box box-solid collapsed-box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-search" ng-hide="searchIsActive"></i>
            <i class="fa fa-cog fa-spin" ng-show="searchIsActive"></i>
            <input class="form-control" ng-model="search.term" type="text" ng-debounce="500" placeholder="Search..." style="position: absolute; border:0; top: 6px; left: 32px; width: 250px;">
        </h3>
        <div class="box-tools pull-right">
            <button class="btn btn-default btn-sm" data-widget="collapse" ng-click="showSearch = !showSearch">
                <i ng-show="!showSearch" class="fa fa-2x fa-angle-double-down"></i>
                <i ng-show="showSearch" class="fa fa-2x fa-angle-double-up"></i>
            </button>
        </div>
    </div>

    <div class="box-body" style="display:none;">
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-4">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="box box-solid" ng-cloak>
            <div class="box-header" style="border-bottom: 1px solid #EEEEEE;">
                <h3 class="box-title"><i class="fa fa-clock-o"></i> Recent public gruiks - Total : {{ total_posts | number }}</h3>
            </div>
            <div class="box-body" ng-cloak>
                <div class="row" style="margin:20px 0;" ng-show="posts.length == 0">
                    <div class="col-md-12">
                        <div class="text-center small" style="color:#A3A3A3;">
                            No public post yet<br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <ul class="todo-list ui-sortable">
                            <li ng-repeat="post in posts">

                                <span ng-show="post.private" style="color:#f3f4f5; float:left; margin-left: -28px; margin-top: -3px;" data-toggle="tooltip" data-placement="left" title="Private post">
                                    <span class="fa-stack">
                                      <i class="fa fa-circle fa-stack-2x"></i>
                                      <i style="color:#000;" class="fa fa-lock fa-stack-1x fa-inverse"></i>
                                    </span>
                                </span>

                                <span class="text">
                                    <a href="{% URL::to('view') %}/{{ post.id }}" style="color:#000;">
                                        <span ng-show="post.title">{{ post.title }}</span>
                                        <span ng-show="!post.title"><em>Post #{{ post.id }}</em></span>
                                    </a>
                                    <small> <span style="color:#BBBBBB;">by</span> <a href="{% route('user_profile', ['username' => '']) %}/{{ post.user.username }}" style="border-bottom:1px dotted; font-size: 12px;">{{ post.user.username }}</a> <span style="color:#BBBBBB;">{{ post.created_at_human }}</span></small>
                                </span>

                                <div class="pull-right">
                                    <small ng-repeat="tag in post.tags" class="label label-primary">{{ tag.label }}</small>
                                </div>

                                <div class="clearfix"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-tools">
                {% $posts->links() %}
        </div>
    </div>
    <div class="col-md-5">
        <div class="box box-solid">
            <div class="box-header" style="border-bottom: 1px solid #EEEEEE;">
                <h3 class="box-title"><i class="fa fa-bar-chart-o"></i> Community stats</h3>
            </div>
            <div class="box-body">
                <small>Work in progress !</small>
            </div>
        </div>
    </div>
</div>
@stop