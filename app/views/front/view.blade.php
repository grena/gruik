@extends('front.layout')

@section('content')
<style>
.box .todo-list > li .label {
    margin-left: 3px;
    font-size: 9px;
}
.label {
    cursor: pointer;
}
</style>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">{% $post->title %}</h3>
            </div>

            <div class="box-body">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12">
                    {% $post->html_content %}
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12">
                    @foreach($post->tags as $tag)
                    <span class="label label-primary">{% $tag->label %}</span>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/highlightjs/highlight.pack.js" type="text/javascript"></script>
<script>hljs.initHighlightingOnLoad();</script>

@stop