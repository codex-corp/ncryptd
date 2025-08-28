@extends('index')

{{-- Page title --}}
@section('title')
Resident auth
@parent
@stop

{{-- Page content --}}
@section('content')

<div id="login" class="row">

    <h1>Members only log in area</h1>

    <div class="spacer"></div>
    <p>
        If you are a current member, log in and sign up/in feel free to using provider below. If you are not a member, membership is free and you are invited to join
    </p>

    <div class="spacer"></div>

    <div class="column-container">

        <!-- One Third -->
        <div class="column-one-third">
            <a style="color: #ffffff" href="{{{ URL::route('google') }}}"><button class="btn btn-large btn-google-plus">
                    <i class="fa fa-google-plus fa fa-lg"></i> | Connect with Google</button></a>
        </div>
        <!-- One Third -->
        <div class="column-one-third">
            <a style="color: #000" href="{{{ URL::route('github') }}}"><button class="btn btn-large btn-github">
                <i style="color: #000" class="fa fa-github fa fa-lg"></i> | Connect with Github</button></a>

        </div>
        <!-- One Third -->
        <div class="column-one-third">
            <a style="color: #ffffff" href="{{{ URL::route('linkedin') }}}"><button class="btn btn-large btn-linkedin">
                <i class="fa fa-linkedin fa fa-lg"></i> | Connect with LinkedIn</button></a>
        </div>
    </div>

</div><!-- /.row -->

@stop