'use strict';

define(
    [
        'underscore',
        'backbone',
        'marked',
        'text!template/note-viewer'
    ],
    function (
        _,
        Backbone,
        marked,
        template
    ) {
        var NoteViewer = Backbone.View.extend({
            template: _.template(template),
            aceEditorInstance: null,
            initialize: function () {
                marked.setOptions({
                    gfm: true,
                    breaks: true,
                    sanitize: true
                });
            },
            render: function () {
                var markdown = this.model.get('content') || '';
                var htmlContent = marked(markdown);

                this.$el.html(
                    this.template({
                        content: htmlContent
                    })
                );

                return this;
            }
        });

        return NoteViewer;
    }
);
