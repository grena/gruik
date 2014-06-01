@extends('layout')

@section('controller')
    ng-controller="HomeCtrl"
@stop

@section('content')
<div class="row">
    <div class="col-md-12 text-center">
        <img src="/img/gruik-black.png" alt="Gruik Logo">
        <h1>Welcome to Gruik !</h1>
    </div>
</div>

<hr>

<div class="row">

    <div class="col-md-4">
        <div class="box box-solid">
            <div class="box-header" style="border-bottom: 1px solid #fff;">
                <h3 class="box-title"><i class="fa fa-question-circle fa-2x"></i> <span style="font-size:40px; padding-left: 11px;">What is Gruik ?</span></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>It's an open-source <strong>note-taking</strong> service. It's a space where you can store notes by writing them in markdown and then keep them private or public.</p>
                        <p>It's still under development and has not reach its final goal yet, but you can already use it, feel free to <a href="{% route('register') %}">register</a> !</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="box box-solid">
            <div class="box-header" style="border-bottom: 1px solid #fff;">
                <h3 class="box-title"><i class="fa fa-group fa-2x"></i> <span style="font-size:40px; padding-left: 11px;">Who is it for ?</span></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            Gruik is for you if...
                            <ul>
                                <li>You <strong>take a lot of notes</strong> (post-it, gists, evernote, blog entries, .txt on your desktop (Oh you know what I mean)...)</li>
                                <li>You optionally want to "<strong>Bring Your Own Server</strong>"</li>
                                <li>You want to store all your notes <strong>in one place</strong></li>
                                <li>You write your notes <strong>with Markdown</strong></li>
                                <li>You want to keep those <strong>notes private</strong> or...</li>
                                <li>...<strong>publish them just like a blog</strong>, or just to be referenced by search-engines</li>
                                <li>...and maybe allow notes to be <strong>discussed with comments</strong></li>
                                <li>You want to <strong>keep interesting notes</strong> from other people, but don't want them to vanish if author becomes a zombie</li>
                                <li>You like pigs (well, Gruiiik !)</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="box box-solid">
            <div class="box-header" style="border-bottom: 1px solid #fff;">
                <h3 class="box-title"><i class="fa fa-money fa-2x"></i> <span style="font-size:40px; padding-left: 11px;">Is it free ?</span></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <strong>Yes !</strong> Gruik is an open-source project, hosted on GitHub. <br>
                            This website (<a href="{% url('/') %}">{% url('/') %}</a>) is an instance of Gruik <strong>freely hosted</strong> for you by its creator. <br>
                            <br>
                            You also can host your own Gruik on your own server.
                        </p>

                        <hr>

                        <div class="row">
                            <div class="col-md-6 text-center">
                            <iframe src="http://ghbtns.com/github-btn.html?user=grena&repo=gruik&type=watch&count=true&size=large"
                              allowtransparency="true" frameborder="0" scrolling="0" width="170" height="30"></iframe>
                            </div>
                            <div class="col-md-6 text-center">
                            <iframe src="http://ghbtns.com/github-btn.html?user=grena&repo=gruik&type=fork&count=true&size=large"
                              allowtransparency="true" frameborder="0" scrolling="0" width="170" height="30"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12 text-center">
        <h1>Some screenshots</h1>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-4 text-center">
        <img src="/img/screen1.png" alt="" class="img-thumbnail img-circle" style="max-height:380px;">
    </div>
    <div class="col-md-4 text-center">
        <img src="/img/screen2.png" alt="" class="img-thumbnail img-circle" style="max-height:380px;">
    </div>
    <div class="col-md-4 text-center">
        <img src="/img/screen3.png" alt="" class="img-thumbnail img-circle" style="max-height:380px;">
    </div>
</div>
@stop