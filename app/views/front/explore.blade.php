@extends('layout')

@section('controller')
    ng-controller="ExploreCtrl"
@stop

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-globe"></i> {{ total_posts | number }} public gruiks</div>
            <div class="panel-body">

                <!-- NO POST -->
                <div class="row" style="margin:20px 0;" ng-show="posts.length == 0" ng-cloak>
                    <div class="col-md-12">
                        <div class="text-center small" style="color:#A3A3A3;">
                            <p><i class="fa fa-book fa-4x"></i></p>
                            Gruik ! No public post. <br>
                            Go and <a href="{% URL::to('create') %}">write something delicious</a> !
                        </div>
                    </div>
                </div>
                <!-- / NO POST -->

                <!-- POSTS TABLE -->
                <table class="table table-striped" ng-show="posts.length > 0" ng-cloak>
                    <thead>
                        <tr>
                            <th class="col-md-8">Title</th>
                            <th class="col-md-4">Tags</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="post in ::posts" class="post">
                            <td>
                                <span class="text">
                                    <a href="{% URL::to('view') %}/{{ post.id }}" style="color:#000; font-weight: bold;">
                                        <span ng-show="post.title">{{ post.title }}</span>
                                        <span ng-show="!post.title"><em>Post #{{ post.id }}</em></span>
                                    </a>
                                    <small>
                                        <span style="color:#BBBBBB;">by</span> <a href="{% route('user_profile', ['username' => '']) %}/{{ post.user.username }}" style="border-bottom:1px dotted; font-size: 12px;">{{ post.user.username }}</a>
                                        <span style="color:#BBBBBB;">{{ post.created_at_human }}</span>
                                    </small>
                                </span>
                            </td>
                            <td>
                                <small style="margin-right: 2px;" ng-repeat="tag in post.tags" class="label label-primary">{{ tag.label }}</small>
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