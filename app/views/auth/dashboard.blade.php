@extends('layout')

@section('controller')
    ng-controller="DashboardCtrl"
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

<div class="box box-solid collapsed-box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-search"></i>
            <input class="form-control" ng-model="search" type="text" ng-debounce="500" placeholder="Search..." style="position: absolute; border:0; top: 6px; left: 32px; width: 250px;">
            {{ search }}
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

<div class="box box-solid">
    <div class="box-header" style="border-bottom: 1px solid #EEEEEE;">
        <i class="fa fa-files-o"></i> <h3 class="box-title">Your posts</h3>

        <button ng-click="deleteSelected()" ng-show="selected.posts.length > 0" class="pull-right btn btn-sm btn-danger" style="margin-right: 5px; margin-top: 5px;"><i class="fa fa-times"></i> &nbsp; Delete selected</button>
    </div>

    <div class="box-body">

        <div class="row" style="margin:20px 0;" ng-show="posts.length == 0">
            <div class="col-md-12">
                <div class="text-center small" style="color:#A3A3A3;">
                    Gruik ! Nothing here. <br>
                    Go and <a href="{% URL::to('create') %}">write something delicious</a> !
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

                        <input type="checkbox" checklist-model="selected.posts" checklist-value="post.id">

                        <span class="text">
                            <a href="{% URL::to('view') %}/{{ post.id }}" style="color:#000;">
                                <span ng-show="post.title">{{ post.title }}</span>
                                <span ng-show="!post.title"><em>Post #{{ post.id }}</em></span>
                            </a>
                        </span>

                        <small ng-repeat="tag in post.tags" class="label label-primary">{{ tag.label }}</small>
                        <div class="tools">
                            <a href="{% URL::to('create') %}?edit={{ post.id }}">Edit</a> |
                            <a ng-click="deleteSelected(post.id)" style="cursor:pointer;">Delete</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="box-tools">
        {% $posts->links() %}
</div>

@stop

@section('scripts')
    <script src="/vendor/smoke.js/smoke.min.js" type="text/javascript"></script>
@stop