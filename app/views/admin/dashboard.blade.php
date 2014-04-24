@extends('admin.layout')

@section('content')

<div class="row" style="margin-top: -20px;">
    <div id="editor" class="col-md-10" style="position:absolute; bottom:0; top:50px;"></div>
</div>

<script src="/js/ace/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="src/theme-monokai.js" type="text/javascript" charset="utf-8"></script>
<script src="/js/ace/mode-markdown.js" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("editor");
    var MarkdownMode = require("ace/mode/markdown").Mode;
    editor.setTheme("ace/theme/monokai");
    editor.setFontSize(14);
    editor.setShowPrintMargin(false);
    editor.getSession().setMode(new MarkdownMode());
</script>
@stop