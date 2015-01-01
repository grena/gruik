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

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-files-o"></i> Your gruiks
                <button ng-cloak ng-click="deleteSelected()" ng-show="selected.posts.length > 0" style="margin-top:-5px;margin-left: 5px;" class="pull-right btn-sm btn btn-danger"><i class="fa fa-times"></i> Delete selected</button>
                <a href="{% URL::to('create') %}" style="margin-top:-5px;" class="pull-right btn-sm btn btn-success"><i class="fa fa-plus"></i> Create</a>
            </div>
            <div class="panel-body">

                <!-- NO POST -->
                <div class="row" style="margin:20px 0;" ng-show="posts.length == 0" ng-cloak>
                    <div class="col-md-12">
                        <div class="text-center small" style="color:#A3A3A3;">
                            <p><i class="fa fa-book fa-4x"></i></p>
                            Gruik ! Nothing here. <br>
                            Go and <a href="{% URL::to('create') %}">write something delicious</a> !
                        </div>
                    </div>
                </div>
                <!-- / NO POST -->

                <!-- POSTS TABLE -->
                <table class="table table-striped" ng-show="posts.length > 0" ng-cloak>
                    <thead>
                        <tr>
                            <th class="col-md-1">#</th>
                            <th class="col-md-7">Title</th>
                            <th class="col-md-2">Tags</th>
                            <th class="col-md-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="post in ::posts" class="post">
                            <td>
                                <input type="checkbox" checklist-model="selected.posts" checklist-value="post.id">
                            </td>
                            <td>
                                <span ng-show="post.private">
                                    <i class="fa fa-lock fa-border"></i>
                                </span>
                                <span class="text">
                                    <a href="{% URL::to('view') %}/{{ post.id }}" style="color:#000; font-weight: bold;">
                                        <span ng-show="post.title">{{ post.title }}</span>
                                        <span ng-show="!post.title"><em>Post #{{ post.id }}</em></span>
                                    </a>
                                </span>
                                <small>
                                    <span style="color:#BBBBBB;">{{ post.created_at_human }}</span>
                                </small>
                            </td>
                            <td>
                                <small style="margin-right: 2px;" ng-repeat="tag in post.tags" class="label label-primary">{{ tag.label }}</small>
                            </td>
                            <td>
                                <div class="tools">
                                    <a class="btn-xs ma-button" href="{% URL::to('create') %}?edit={{ post.id }}">Edit</a>
                                    <a class="btn-xs ma-button danger" ng-click="deleteSelected(post.id)" style="cursor:pointer;">Delete</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- / POSTS TABLE -->

                <div class="text-right">
                        {% $posts->links() %}
                </div>

            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
    <script src="/vendor/smoke.js/smoke.min.js" type="text/javascript"></script>
@stop