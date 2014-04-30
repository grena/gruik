@extends('layout')

@section('controller')
    ng-controller="TagsCtrl"
@stop

@section('content')
<div class="box box-solid" id="loading-example">
    <div class="box-header">
        <i class="fa fa-tags"></i>
        <h3 class="box-title">Tags</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="col-xs-3 col-md-2 col-lg-1 text-center" style="border-right: 1px solid #f4f4f4">
                    <div id="circles-1"></div>
                    <div class="knob-label"><i class="fa fa-tag"></i> SQL</div>
                </div>
                <div class="col-xs-3 col-md-2 col-lg-1 text-center" style="border-right: 1px solid #f4f4f4">
                    <div id="circles-2"></div>
                    <div class="knob-label"><i class="fa fa-tag"></i> JavaScript</div>
                </div>
                <div class="col-xs-3 col-md-2 col-lg-1 text-center" style="border-right: 1px solid #f4f4f4">
                    <div id="circles-3"></div>
                    <div class="knob-label"><i class="fa fa-tag"></i> HTML</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/plugins/circles.js" type"text/javascript"></script>
<script>
Circles.create({
    id:         'circles-1',
    percentage: 70,
    radius:     30,
    width:      10,
    number:     13,
    text:       '',
    colors:     ['#ededed', '#428bca'],
    duration:   400
});
Circles.create({
    id:         'circles-2',
    percentage: 40,
    radius:     30,
    width:      10,
    number:     8,
    text:       '',
    colors:     ['#ededed', '#428bca'],
    duration:   400
});
Circles.create({
    id:         'circles-3',
    percentage: 6,
    radius:     30,
    width:      10,
    number:     1,
    text:       '',
    colors:     ['#ededed', '#428bca'],
    duration:   400
});
</script>
@stop

