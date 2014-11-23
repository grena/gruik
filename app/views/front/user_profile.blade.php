@extends('layout')

@section('controller')
    ng-controller="UserProfileCtrl"
@stop

@section('content')

<div class="row">
    <div class="col-md-3 col-md-offset-2 text-center">
        <div class="box box-solid">
            <div class="box-body" ng-cloak>
                <img src="{% Gravatar::src( $visited_user->email, 150 ) %}" class="img-thumbnail img-circle" alt="{% $visited_user->username %} avatar" style="height:150px; width:150px;"  />
                <h1 style="margin-top: 0;">{% $visited_user->username %}</h1>
                <div class="row" ng-show="user.about">
                    <div class="col-md-12">
                        {{ user.about }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div style="color:#B6B6B6; font-style:italic; margin-top: 10px;"><small>Last login : {{ last_login }}</small></div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <span style="font-size:28px; font-weight:bold;">{{ total_posts | number }}</span>
                        <div style="color:#B6B6B6;"><small>public gruiks</small></div>
                    </div>
                    <div class="col-md-4">
                        <span style="font-size:28px; font-weight:bold;">{{ total_tags | number }}</span>
                        <div style="color:#B6B6B6;"><small>tags</small></div>
                    </div>
                    <div class="col-md-4">
                        <span style="font-size:28px; font-weight:bold;">{{ total_days | number }}</span>
                        <div style="color:#B6B6B6;"><small>days old</small></div>
                    </div>
                </div>

                <hr ng-show="user.twitter_username || user.github_username">

                <div class="row" ng-show="user.twitter_username || user.github_username">

                    <div ng-class="user.twitter_username && user.github_username ? 'col-md-6' : 'col-md-12'" ng-show="user.twitter_username">
                        <a href="https://twitter.com/{{ user.twitter_username }}" class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                        <div style="color:#6F6F6F;"><small>{{ user.twitter_username }}</small></div>
                    </div>

                    <div ng-class="user.twitter_username && user.github_username ? 'col-md-6' : 'col-md-12'" ng-show="user.github_username">
                        <a href="https://github.com/{{ user.github_username }}" class="btn btn-social-icon btn-github"><i class="fa fa-github"></i></a>
                        <div style="color:#6F6F6F;"><small>{{ user.github_username }}</small></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">

        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-files-o"></i> Public gruiks of {% $visited_user->username %}</div>
            <div class="panel-body">

                <!-- NO POST -->
                <div class="row" style="margin:20px 0;" ng-show="posts.length == 0" ng-cloak>
                    <div class="col-md-12">
                        <div class="text-center small" style="color:#A3A3A3;">
                            <p><i class="fa fa-book fa-4x"></i></p>
                            Gruik ! <b>{{ user.username }}</b> has no public gruik to show.
                        </div>
                    </div>
                </div>
                <!-- / NO POST -->

                <!-- POSTS TABLE -->
                <table class="table table-striped" ng-show="posts.length > 0" ng-cloak>
                    <thead>
                        <tr>
                            <th class="col-md-9">Title</th>
                            <th class="col-md-3">Tags</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="post in posts" class="post">
                            <td>
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