app = angular.module('app', ['ui.select2']);

app.controller('AdminCtrl', function ($scope) {

});

app.controller('DashboardCtrl', function ($scope, $sce) {

    var marked = window.marked;
    var hljs = window.hljs;

    $scope.is_preview = false;
    $scope.preview_content = '';

    window.adrien = $scope;

    $('#input-tags').selectize({
        plugins: ['remove_button'],
        maxItems: null,
        delimiter: ',',
        valueField: 'name',
        labelField: 'name',
        searchField: ['name'],
        options: [
            {name:'SQL'},
            {name:'HTML'},
            {name:'Android'},
            {name:'PHP'},
            {name:'Laravel'},
            {name:'Idées'},
        ],
        persist: false,
        create: function(input) {
            return {
                name: input
            };
        }
    });

    marked.setOptions({
        highlight: function (code) {
            return hljs.highlightAuto(code).value;
        }
    });

    $scope.save = function()
    {
        var post_markdown = $scope.editor.getValue();
        var post_html = hljs.highlightAuto(post_markdown).value;
    };

    $scope.preview = function(state)
    {
        if(state)
        {
            $scope.preview_content = $sce.trustAsHtml(marked($scope.editor.getValue()));
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
});