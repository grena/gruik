app = angular.module('app', ['ui.select2']);

app.controller('AdminCtrl', function ($scope) {

});

app.controller('DashboardCtrl', function ($scope, $sce, $http) {


    var marked = window.marked;
    var hljs = window.hljs;

    window.scope = $scope;

    $scope.currentPost = {
        id: 0,
        title: '',
        md_content: '',
        html_content: '',
        private: false
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
        console.log($scope.currentPost);

        $scope.loading = true;

        $scope.currentPost._token = $("#csrf").val();
        $scope.currentPost.html_content = marked( $scope.currentPost.md_content );

        if($scope.currentPost.id === 0)
        {
            // Creating post
            $http.post('/api/posts', $scope.currentPost).
            success(function(data, status, headers, config) {
                console.log('success = ', data);
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
                console.log('success = ', data);
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

});

app.controller('PostsCtrl', function ($scope) {

});

app.controller('TagsCtrl', function ($scope) {

});