@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <legend>Welcome to Gruik !
                    <div class="pull-right">
                    <iframe src="http://ghbtns.com/github-btn.html?user=grena&repo=gruik&type=watch&count=true"
                      allowtransparency="true" frameborder="0" scrolling="0" width="100" height="30"></iframe>
                    <iframe src="http://ghbtns.com/github-btn.html?user=grena&repo=gruik&type=fork&count=true"
                      allowtransparency="true" frameborder="0" scrolling="0" width="100" height="30"></iframe>
                    </div>
        </legend>
    </div>
</div>

<!-- WHAT -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-question-circle"></i> What is Gruik ?</div>
            <div class="panel-body">
                <blockquote>
                    <p>It's a free & open-source <strong>note-taking</strong> service. A space where you can store notes, tutorials, code snippets... by writing them in markdown and then keep them private or public.</p>
                </blockquote>
                <div class="alert alert-info">
                    <h4><i class="fa fa-wrench"></i> For your information</h4>
                    <p>Gruik is still <b>under hard development</b> and this website is freely hosted for you by its creator. Some breaking changes can occur in futur and <b>I can not guarantee the integrity of your data for now</b>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / WHAT -->

<!-- WHO -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-cubes"></i> Features</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center widget-feature">
                                <i class="fa fa-database fa-3x"></i>
                            </div>
                            <div class="panel-footer small text-center">Host Gruik on <b>your server</b></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center widget-feature">
                                <i class="fa fa-font fa-3x"></i>
                            </div>
                            <div class="panel-footer small text-center"><b>Markdown</b> syntax : write once, read everywhere</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center widget-feature">
                                <i class="fa fa-lock fa-3x"></i>
                            </div>
                            <div class="panel-footer small text-center">Mark notes as <b>public or private</b></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center widget-feature">
                                <i class="fa fa-comments fa-3x"></i>
                            </div>
                            <div class="panel-footer small text-center">If public, your notes can be <b>commented</b></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3" style="opacity:0.4;">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center"><b>Not developed yet</b></div>
                            <div class="panel-body text-center widget-feature">
                                <i class="fa fa-plug fa-3x"></i>
                            </div>
                            <div class="panel-footer small text-center">Login with your <b>GitHub</b>, <b>Twitter</b> or <b>Google</b> account</div>
                        </div>
                    </div>
                    <div class="col-md-3" style="opacity:0.4;">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center"><b>Not developed yet</b></div>
                            <div class="panel-body text-center widget-feature">
                                <i class="fa fa-tags fa-3x"></i>
                            </div>
                            <div class="panel-footer small text-center">Organize and search with <b>tags</b></div>
                        </div>
                    </div>
                    <div class="col-md-3" style="opacity:0.4;">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center"><b>Not developed yet</b></div>
                            <div class="panel-body text-center widget-feature">
                                <i class="fa fa-shield fa-3x"></i>
                            </div>
                            <div class="panel-footer small text-center">Client side <b>encryption</b></div>
                        </div>
                    </div>
                    <div class="col-md-3" style="opacity:0.4;">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center"><b>Not developed yet</b></div>
                            <div class="panel-body text-center widget-feature">
                                <i class="fa fa-code-fork fa-3x"></i>
                            </div>
                            <div class="panel-footer small text-center"><b>Favorite / Fork</b> people public note</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3" style="opacity:0.4;">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center"><b>Not developed yet</b></div>
                            <div class="panel-body text-center widget-feature">
                                <i class="fa fa-cloud-upload fa-3x"></i>
                            </div>
                            <div class="panel-footer small text-center">File & picture <b>upload</b></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer small">You got a cool idea of feature ? Feel free to <a href="https://github.com/grena/gruik/issues">propose your idea on GitHub</a>. Or even better, make <a href="https://github.com/grena/gruik/pulls">a pull request</a> !</div>
        </div>
    </div>
</div>
<!-- / WHO -->

<!-- SCREENSHOTS -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-image"></i> Some screenshots</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <a href="/img/screen1.png" data-toggle="lightbox" data-gallery="multiimages" data-title="Screenshot #1">
                            <img src="/img/screen1.png" alt="" class="img-thumbnail img-responsive" >
                        </a>
                    </div>
                    <div class="col-md-4 text-center">
                        <a href="/img/screen2.png" data-toggle="lightbox" data-gallery="multiimages" data-title="Screenshot #2">
                            <img src="/img/screen2.png" alt="" class="img-thumbnail img-responsive" >
                        </a>
                    </div>
                    <div class="col-md-4 text-center">
                        <a href="/img/screen3.png" data-toggle="lightbox" data-gallery="multiimages" data-title="Screenshot #3">
                            <img src="/img/screen3.png" alt="" class="img-thumbnail img-responsive" >
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / SCREENSHOTS -->
@stop

@section('scripts')
    <script src="/vendor/ekko-lightbox/dist/ekko-lightbox.min.js" type="text/javascript"></script>

    <script>
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
        event.preventDefault();
        return $(this).ekkoLightbox();
    });
    </script>
@stop
