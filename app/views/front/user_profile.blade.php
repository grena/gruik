@extends('layout')

@section('controller')
    ng-controller="UserProfileCtrl"
@stop

@section('content')

<div class="row">
    <div class="col-md-3 text-center">
        <div class="box box-solid">
            <div class="box-body">
                <img src="{% Gravatar::src( $visited_user->email, 150 ) %}" class="img-thumbnail img-circle" alt="{% $visited_user->username %} avatar" height="150" width="150"  />
                <h1 style="margin-top: 0;">{% $visited_user->username %}</h1>
                <div class="row" ng-show="user.about">
                    <div class="col-md-12">
                        {{ user.about }}
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
    <div class="col-md-9">
        <div class="box box-solid">
            <div class="box-header" style="border-bottom: 1px solid #EEEEEE;">
                <h3 class="box-title"><i class="fa fa-files-o"></i> Public gruiks of {% $visited_user->username %}</h3>
            </div>
            <div class="box-body">
                <div class="row" style="margin:20px 0;" ng-show="posts.length == 0">
                    <div class="col-md-12">
                        <div class="text-center small" style="color:#A3A3A3;">
                            {{ user.username }} has no public post yet<br>
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
                                </span>

                                <div class="pull-right">
                                    <small ng-repeat="tag in post.tags" class="label label-primary">{{ tag.label }}</small>
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
    </div>
</div>
@stop