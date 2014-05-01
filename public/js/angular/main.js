app = angular.module('app', ["checklist-model"]);

app.factory('debounce', function ($timeout, $q) {
    return function debounce(func, wait, immediate) {
        var timeout;
        var deferred = $q.defer();
        return function () {
            var context = this, args = arguments;
            var later = function () {
                timeout = null;
                if (!immediate) {
                    deferred.resolve(func.apply(context, args));
                    deferred = $q.defer();
                }
            };
            var callNow = immediate && !timeout;
            if (timeout) {
                $timeout.cancel(timeout);
            }
            timeout = $timeout(later, wait);
            if (callNow) {
                deferred.resolve(func.apply(context, args));
                deferred = $q.defer();
            }
            return deferred.promise;
        };
    };
});

app.controller('AdminCtrl', function ($scope) {

});

app.controller('CreateCtrl', function ($scope, $sce, $http) {

    var marked = window.marked;
    var hljs = window.hljs;

    window.scope = $scope;

    $scope.user = window.Gruik.user;

    $scope.currentPost = {
        id: 0,
        title: '',
        md_content: '',
        html_content: ''
    };

    $scope.is_preview = false;
    $scope.loading = false;

    // INIT PLUGINS

    $select = $('#input-tags').selectize({
        plugins: ['remove_button'],
        maxItems: null,
        openOnFocus: false,
        maxOptions: 5,
        delimiter: ',',
        valueField: 'label',
        labelField: 'label',
        searchField: ['label'],
        options: window.Gruik.tags,
        persist: false,
        create: function(input) {
            return {
                label: input
            };
        }
    });

    selectize = $select[0].selectize;

    marked.setOptions({
        highlight: function (code) {
            return hljs.highlightAuto(code).value;
        }
    });

    // FUNCTIONS

    $scope.save = function()
    {
        $scope.loading = true;
        $scope.currentPost._token = $("#csrf").val();
        $scope.currentPost.html_content = marked( $scope.currentPost.md_content );

        if($scope.currentPost.id === 0)
        {
            // Creating post
            $http.post('/api/posts', $scope.currentPost).
            success(function(data, status, headers, config) {
                $scope.currentPost = _.extend($scope.currentPost, data);
                $scope.loading = false;
            }).
            error(function(data, status, headers, config) {
                console.log('fail = ', data);
                $scope.loading = false;
            });
        }
        else
        {
            // Updating post
            $http.put('/api/posts/' + $scope.currentPost.id, $scope.currentPost).
            success(function(data, status, headers, config) {
                $scope.currentPost = _.extend($scope.currentPost, data);
                $scope.loading = false;
            }).
            error(function(data, status, headers, config) {
                console.log('fail = ', data);
                $scope.loading = false;
            });
        }
    };

    $scope.preview = function(state)
    {
        if(state)
        {
            $scope.currentPost.html_content = marked( $scope.currentPost.md_content );
            $scope.currentPost.html_content_preview = $sce.trustAsHtml(marked( $scope.currentPost.md_content ));
        }

        $scope.is_preview = state;
    };

    // Init ACE EDITOR
    $scope.editor = ace.edit("editor");
    var MarkdownMode = require("ace/mode/markdown").Mode;

    $scope.editor.setTheme("ace/theme/monokai");
    $scope.editor.setFontSize(14);
    $scope.editor.setShowPrintMargin(false);
    $scope.editor.getSession().setMode(new MarkdownMode());

    $scope.editor.getSession().on('change', function(e) {
        $scope.currentPost.md_content = $scope.editor.getValue();
    });

    // If edition
    if(window.Gruik.edited_post)
    {
        $scope.currentPost = window.Gruik.edited_post;
        $scope.currentPost.tags = window.Gruik.edited_tags;

        _.each($scope.currentPost.tags, function(tag) {
            selectize.addItem(tag);
        });

        $scope.editor.setValue($scope.currentPost.md_content);
        $scope.editor.gotoLine(1);
    }
    else
    {
        // Set user preferences to post
        $scope.currentPost.private = $scope.user.preferences['posts.private'];
        $scope.currentPost.allow_comments = $scope.user.preferences['posts.allow_comments'];
    }

});

app.controller('DashboardCtrl', function ($scope, $http, $window, debounce) {

    $scope.selected = {
        posts : []
    };

    $scope.showSearch = false;

    $scope.posts = window.Gruik.posts.data;
    $scope._token = $("#csrf").val();

    $scope.deleteSelected = function(id)
    {
        var text = id ? "Delete this post ?" : "Delete selected posts ?";
        var ids = [];

        var deletePost = function(ids)
        {
            $scope.loading = true;

            $http.post('/api/posts/multiple_delete', {'ids': ids, '_token': $scope._token}).
            success(function(data, status, headers, config) {
                $window.location.reload();
                $scope.loading = false;
            }).
            error(function(data, status, headers, config) {
                console.log('fail = ', data);
                $scope.loading = false;
            });
        };

        if(id)
        {
            ids.push(id);
        }
        else
        {
            ids = angular.copy($scope.selected.posts);
        }

        smoke.confirm(text, function(e){
            if(e) {
                deletePost(ids);
            }
        }, {
            ok: "Yes",
            cancel: "Gruik, NO !",
            reverseButtons: true
        });
    };



    $scope.$watch('search', debounce(function () {
        console.log('search = ', $scope.search);
    }, 500, false), true);

});

app.controller('TagsCtrl', function ($scope) {

});

app.controller('SettingsCtrl', function ($scope, $http, $window) {

    $scope.user = window.Gruik.user;
    $scope._token = $("#csrf").val();

    window.scope = $scope;

    $scope.saveUser = function()
    {
        $scope.loading = true;
        $scope.user._token = $scope._token;

        $http.put('/api/users/'+$scope.user.id, $scope.user).
        success(function(data, status, headers, config) {
            $scope.loading = false;
            $window.location.reload();
        }).
        error(function(data, status, headers, config) {
            console.log('fail = ', data);
            $scope.loading = false;
        });
    };

});

app.controller('ViewCtrl', function ($scope) {

    $scope.comments_loaded = false;
    $scope.loading = false;

    $scope.loadComments = function()
    {
        $scope.loading = true;
        var disqus_shortname = window.Gruik.disqus_username;

        $.ajax({
              type: "GET",
              url: "//" + disqus_shortname + ".disqus.com/embed.js",
              dataType: "script",
              cache: true
        }).then(function() {
            $scope.comments_loaded = true;
            $scope.loading = false;
            $scope.$apply();
        }, function() {
            $scope.loading = false;
            $scope.$apply();
            smoke.signal('<i class="fa fa-times"></i> Error while loading Disqus comments', function(e){

            }, {
                duration: 3000,
                classname: "custom-class"
            });

        });


    };
});

app.controller('RegisterCtrl', function ($scope, $http, $window) {

    $scope.user = {
        email: '',
        password: '',
        username: ''
    };

    $scope.loading = false;

    $scope.register = function()
    {
        $scope.loading = true;
        $scope.flash = null;

        $http.post('/register', $scope.user).
        success(function(data, status, headers, config) {
            $scope.loading = false;
            $window.location.href='/';
        }).
        error(function(data, status, headers, config) {
            $scope.loading = false;
            $scope.flash = data.flash;
        });
    };

});

app.controller('LoginCtrl', function ($scope, $http, $window) {

    $scope.user = {
        email: '',
        password: '',
        remember: false
    };

    $scope.loading = false;

    $scope.login = function()
    {
        $scope.loading = true;
        $scope.flash = null;

        $http.post('/login', $scope.user).
        success(function(data, status, headers, config) {
            $scope.loading = false;
            $window.location.href='/';
        }).
        error(function(data, status, headers, config) {
            $scope.loading = false;
            $scope.flash = data.flash;
        });
    };

});