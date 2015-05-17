@extends('layout')

@section('controller')
    ng-controller="SearchCtrl"
@stop

@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1">

        @if(! $term)
        <div style="padding-top:50px; padding-bottom:50px;" class="text-center">
            <img src="/img/gruik-black.png" alt="">
            <h4>Oink! Let the search... begin!</h4>
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h3 style="margin-top: 3px; margin-bottom: 0;">Search</h3>
                            </div>
                            <div class="col-md-9">
                                <form action="{% URL::to('search') %}" id="searchForm">
                                    <div class="input-group">
                                        <input type="hidden" name="s" ng-value="sortBy">
                                        @if (Input::get('type') == 'users' || Input::get('type') == 'owner' || Input::get('type') == 'public')
                                            <input type="hidden" name="type" value="{% Input::get('type') %}">
                                        @else
                                            <input type="hidden" name="type" value="owner"/>
                                        @endif
                                        <input type="text" class="form-control" name="q" value="{% Input::get('q') %}" autofocus>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit" id="applySearch">Search</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($term)
        <div class="row">
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            @if(isset($user))
                            <li role="presentation"
                                @if(Input::get('type') == 'owner' || ! Input::get('type'))
                                    class="active"
                                @endif >

                                <a href="{% route('search', ['q' => Input::get('q'), 'type' => 'owner']) %}">
                                    <i class="fa fa-file-text-o"></i> My gruiks <span class="badge pull-right">{% $countOwnerPosts %}</span>
                                </a>
                            </li>
                            @endif
                            <li role="presentation"
                                @if(Input::get('type') == 'public')
                                    class="active"
                                @endif >

                                <a href="{% route('search', ['q' => Input::get('q'), 'type' => 'public']) %}">
                                    <i class="fa fa-globe"></i> Public gruiks <span class="badge pull-right">{% $countPublicPosts %}</span>
                                </a>
                            </li>
                            <li role="presentation"
                                @if(Input::get('type') == 'users')
                                    class="active"
                                @endif >

                                <a href="{% route('search', ['q' => Input::get('q'), 'type' => 'users']) %}">
                                    <i class="fa fa-users"></i> Users <span class="badge pull-right">{% $countUsers %}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-md-9">

                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Sort:</span>
                            @if(Input::get('type') == 'users')
                                <select class="form-control" class="form-control" name="sort" ng-model="sortBy">
                                    <option value="created_at,desc">Recently joined</option>
                                    <option value="created_at,asc">Least recently joined</option>
                                </select>
                            @else
                                <select class="form-control" class="form-control" name="sort" ng-model="sortBy">
                                    <option value="created_at,desc">Recently created</option>
                                    <option value="created_at,asc">Least recently created</option>
                                    <option value="updated_at,desc">Recently updated</option>
                                    <option value="updated_at,asc">Least recently updated</option>
                                </select>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">

                        <!-- NO POST -->
                        <div class="row" style="margin:20px 0;" ng-show="result.data.length == 0" ng-cloak>
                            <div class="col-md-12">
                                <div class="text-center small" style="color:#A3A3A3;">
                                    <p><i class="fa fa-search fa-4x"></i></p>
                                    Gruik ! Nothing found.
                                </div>
                            </div>
                        </div>
                        <!-- / NO POST -->

                        @if(Input::get('type') == 'users')

                            <!-- USERS TABLE -->
                            <ul style="list-style-type: none; margin:0; padding: 0;">
                                <li class="user-item" ng-repeat="user in ::result.data">
                                    <img class="img-circle img-thumbnail pull-left" ng-src="{{ user.avatar }}" alt="" style="margin-right:10px; width:45px; height:45px;" width="45" height="45">
                                    <a href="{% route('user_profile', ['username' => '']) %}/{{ user.username }}" style="border-bottom:1px dotted; font-size: 15px;">{{ user.username }}</a><br>
                                    <small class="text-muted"><b>{{ user.public_posts }}</b> public posts, joined <b>{{ user.created_at }}</b></small>
                                    <hr>
                                    <div class="clearfix"></div>
                                </li>
                            </ul>
                            <!-- / USERS TABLE -->

                        @else

                            <!-- POSTS TABLE -->
                            <table class="table table-striped" ng-show="result.data.length > 0" ng-cloak>
                                <thead>
                                    <tr>
                                        <th class="col-md-8">Title</th>
                                        <th class="col-md-4">Tags</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="post in ::result.data" class="post">
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
                                            <span style="color:#BBBBBB;">by</span> <a href="{% route('user_profile', ['username' => '']) %}/{{ post.user.username }}" style="border-bottom:1px dotted; font-size: 12px;">{{ post.user.username }}</a>
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

                        @endif

                        <div class="text-right">
                                {% $pagination %}
                        </div>

                    </div>
                </div>

            </div>
        </div>
        @endif


    </div>
</div>
@stop
