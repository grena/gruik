'use strict';

define(
    [
        'underscore',
        'backbone',
        'ace/ace',
        'text!template/note-editor'
    ],
    function (
        _,
        Backbone,
        ace,
        template
    ) {
        var NoteEditor = Backbone.View.extend({
            template: _.template(template),
            aceEditorInstance: null,
            render: function () {
                this.$el.html(
                    this.template({
                        model: this.model
                    })
                );

                if (_.isNull(this.aceEditorInstance)) {
                    this.initializeAceEditor();
                }

                return this;
            },
            initializeAceEditor: function () {
                this.aceEditorInstance = ace.edit('editor');
                this.aceEditorInstance.setOptions({
                    'fontSize': 14,
                    'theme': 'ace/theme/github',
                    'mode': 'ace/mode/markdown',
                    'wrap': 'free',
                    'showPrintMargin': false,
                    'showGutter': false,
                    'showLineNumbers': false,
                    'highlightActiveLine': false,
                    'highlightGutterLine': false,
                    'maxLines': Infinity
                });

                this.aceEditorInstance.getSession().on('change', function() {
                    var value = this.aceEditorInstance.getSession().getValue();
                    this.onEditorUpdate(value);
                }.bind(this));
            },
            onEditorUpdate: function (value) {
                this.model.set('content', value);
            }
        });

        return NoteEditor;
    }
);
