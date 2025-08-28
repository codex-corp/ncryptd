<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- Page Title -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <title>Professional php obfuscator and encryptor :: blowfish encryption</title>

    <meta name="description" content="Ncryptd service to encode your php applications for free, is your next professional tool to obfuscate scrambles classes, functions, variables, binary blowfish encription, is the simplest, fastest and strongest solution" />

    <meta name="keywords" content="php obfuscate, php obfuscation, blowfish encryption, php encoding,javascript obfuscator,compressor, php protect, encrypted, ncrypted,laravel obfuscator" />

    <meta name="author" content="hany alsamman :: codexc.com">

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END Page Title -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- CSS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->


    <link href="{{ URL::asset('assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/screen/style.css') }}" rel="stylesheet">


    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END CSS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- JavaScript -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- Main jQuery Files -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <script src="{{ URL::asset('assets/js/jquery-1.10.2.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('assets/css/screen/script.js') }}" type="text/javascript"></script>

    @if(Request::segment(1) == true)

    <script src="{{ URL::asset('assets/wizard/modernizr-2.6.2.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/wizard/jquery.cookie-1.3.1.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/wizard/jquery.steps.min.js') }}" type="text/javascript"></script>

    <link href="{{ URL::asset('assets/wizard/jquery.steps.css') }}" rel="stylesheet">

    <script src="{{ URL::asset('assets/js/jquery.editable.min.js') }}" type="text/javascript"></script>


    <link href="{{ URL::asset('assets/js/uploader/uploadfile.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('assets/js/uploader/jquery.uploadfile.min.js') }}"></script>


    <link href="{{ URL::asset('assets/js/notification/main.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('assets/js/notification/notification.js') }}"></script>

    @endif

    <link href="{{ URL::asset('assets/css/social-buttons.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('assets/css/window.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/styles/paraiso.dark.css') }}">


</head>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Body - Add "contained" to below classes for boxed layout -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<body class="light-bg @if(Request::segment(1) == false) home @endif">

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Main Container -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="main-container">

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Top Bar - Set "white" or "dark" below -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="topbar-outer dark">
    <div class="topbar content-width">

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- Logo -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <div class="table fullheight">
            <div class="table-cell fullheight middle">
                <div class="logo">
                    <a title="Ncryptd service to encode your php applications for free" href="{{{ URL::to('/') }}}"><img width="125" src="{{ URL::asset('assets/images/logo.png') }}"></a>
                </div>
            </div>
        </div>
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END Logo -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- Social Icons -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <ul class="topsocial">
            <li><a href="https://www.facebook.com/CodexCorp"><i class="fa fa-facebook"></i><div class="tooltip">Facebook</div></a></li>
            <li><a href="https://twitter.com/CodeXperts"><i class="fa fa-twitter"></i><div class="tooltip">Twitter</div></a></li>
            <li><a href="https://plus.google.com/+hanyalsamman"><i class="fa fa-google-plus"></i><div class="tooltip">Google+</div></a></li>
            <li><a href="http://www.linkedin.com/in/hanyalsamman"><i class="fa fa-linkedin-square"></i><div class="tooltip">LinkedIn</div></a></li>
        </ul>
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END Social Icons -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- Main Navigation -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ul class="topnav">
            <li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('') }}}">Home</a></li>

            <li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('') }}}">How it works</a></li>

            <li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('') }}}">Features</a></li>

            <li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('') }}}">Donate</a></li>

            @if (auth()->check())

                @if ( auth()->user()->isSuperUser() )
                <li><a href="{{{ URL::to('admin') }}}">Admin Panel</a></li>
                @endif

                <li><a class="drop" href="{{{ URL::to('/') }}}">
                        {{ auth()->user()->first_name }}</a>
                    <ul>
                        <li><a href="{{{ URL::to('admin') }}}">Admin Panel</a></li>
                        <li><a href="{{{ URL::to('auth/logout') }}}">Signout</a></li>
                    </ul>
                </li>

            @else

            <li {{ (Request::is('auth/signin') ? ' class="active"' : '') }}><a href="{{{ URL::to('auth/signin') }}}">Signin</a></li>
            @endif

        </ul>

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END Main Navigation -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- Mobile Navigation -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- Show/Hide Menu Button -->
        <!-- ~~~~~~~~~~~~~~~~~ -->
        <a href="#" class="mobilenav-click">
            <div class="mobilenav-button-container">
                <div class="mobilenav-button-inner">
                    <!-- Set "white" or "dark" -->
                    <div class="mobilenav-button"></div>
                </div>
            </div>
        </a>
        <!-- ~~~~~~~~~~~~~~~~~ -->
        <!-- END Show/Hide Menu Button -->
        <!-- ~~~~~~~~~~~~~~~~~ -->

        <!-- ~~~~~~~~~~~~~~~~~ -->
        <!-- Navigation Menu (Populated using jQuery) -->
        <!-- ~~~~~~~~~~~~~~~~~ -->
        <div class="mobilenav-container">
            <ul class="mobilenav">
            </ul>
        </div>
        <!-- ~~~~~~~~~~~~~~~~~ -->
        <!-- END Navigation Menu-->
        <!-- ~~~~~~~~~~~~~~~~~ -->
        <!-- END Mobile Navigation -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    </div>
</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Top Bar -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

@if( Request::is('/') )
@include('frontend/layouts/slider')
@endif
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Main Content -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="main-content">
    <div class="main-content-inner content-width">

        <!-- Notifications
        include('notifications')
        notifications -->

        <!-- Content -->
        @if( Request::is('/') )

        @include('frontend/main')

        {{--@elseif( \App\Http\Controllers\HomeController::checkStaticPage(Request::segment(2)) )--}}
        {{--<div id="content" class="container">--}}
            {{--<div class="row">--}}

                {{--<div class="col-sm-12">--}}
                    {{--<div class="panel panel-new">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title"><i class="fa fa-exclamation-circle"></i> {{ $getPage->title }}</h3>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}
                            {{--<hr>--}}
                            {{--@include('static.'.Request::segment(2))--}}

                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div><!--/.col-sm-8 -->--}}
            {{--</div><!--/.row -->--}}
        {{--</div>--}}

        @else

        @yield('content')

        @endif
        <!-- ./ content -->

    </div>
</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Main Content -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Footer Container -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="footer-container">

    <!-- Spacer (20px gap) -->
    <div class="spacer"></div>

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- Client Logos -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    <div class="content-width">
        <div class="client-logos-container">


            <div class="client-logos-title">
                <span>Happy Users</span>
            </div>


            <div id="clients-back"></div>
            <div id="clients-next"></div>

            <div class="carousel">
                <ul id="clients-carousel" class="column-container">

                    <li class="">
                        <div class="logo-outer">
                            <div class="logo-inner">

                                <img alt="" src="{{{ asset('assets/images/client-logos/logo1.png') }}}" />
                            </div>
                        </div>
                    </li>

                    <li class="">
                        <div class="logo-outer">
                            <div class="logo-inner">

                                <img alt="" src="{{{ asset('assets/images/client-logos/logo2.png') }}}" />
                            </div>
                        </div>
                    </li>

                    <li class="">
                        <div class="logo-outer">
                            <div class="logo-inner">

                                <img alt="" src="{{{ asset('assets/images/client-logos/logo3.png') }}}" />
                            </div>
                        </div>
                    </li>

                    <li class="">
                        <div class="logo-outer">
                            <div class="logo-inner">

                                <img alt="" src="{{{ asset('assets/images/client-logos/logo4.png') }}}" />
                            </div>
                        </div>
                    </li>

                    <li class="">
                        <div class="logo-outer">
                            <div class="logo-inner">

                                <img alt="" src="{{{ asset('assets/images/client-logos/logo5.png') }}}" />
                            </div>
                        </div>
                    </li>

                    <li class="">
                        <div class="logo-outer">
                            <div class="logo-inner">

                                <img alt="" src="{{{ asset('assets/images/client-logos/logo6.png') }}}" />
                            </div>
                        </div>
                    </li>

                </ul>
            </div>

        </div>
    </div>
-->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- Footer Infobar -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~   -->

    <div class="footer-infobar">
        <div class="content-width">
            <!-- Text -->
            Ncryptd it's your super awesome tool to be safely, So what are you waiting ? go and give a try !
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END Footer Infobar -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- Footer -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="footer">

        <div class="content-width">
            <div class="column-container">

                <div class="column-one-half" style="text-align: justify">
                    <img alt="" src="{{ URL::asset('assets/images/logo.png') }}"  width="100" class="logo"/>
                    <p>Welcome to Ncryptd, This site was created to encrypt your applications to protect your source code from being stolen
                        The best part about this site is encryption of your code is free </p>
                    {{--<p><a href="#">Meet the team</a></p>--}}
                </div>

                <div class="column-one-half">
                    <h3>About The Developer</h3>
                    <ul class="team">
                        <li>
                            <div class="column-container">
                                <img style="width: 100px; height: 100px; float: left" src="https://avatars.githubusercontent.com/u/775654?" alt="Hany alsamman registered at ncryptd ">
                                <div class="column-one-third" style="float: right; margin: 0 0 0 15px">
                                    Hany alsamman
                                    <p class="date">
                                    Web programmer founder of <a target="_blank" href="http://codexc.com/">Code Experts</a> , Android Development founder of <a target="_blank" href="http://probam.net/">AOSB Project</a> ,
                                    founder of <a href="http://ncryptd.com/">Ncryptd</a>  professional php obfuscator
                                    </p>
                                    <ul class="social">
                                        <li>
                                            <a href="#"><i class="fa fa-linkedin-square"></i><div class="tooltip">LinkedIn</div></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-github"></i><div class="tooltip">Github</div></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-twitter-square"></i><div class="tooltip">Twitter</div></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-google-plus"></i><div class="tooltip">Google+</div></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!--
                <div class="column-one-third">
                    <h3>Follow Us</h3>
                    <ul class="footer-lower footer-social">
                        <li><a href="https://www.facebook.com/CodexCorp"><i class="fa fa-facebook"></i><div class="tooltip">Facebook</div></a></li>
                        <li><a href="https://twitter.com/CodeXperts"><i class="fa fa-twitter"></i><div class="tooltip">Twitter</div></a></li>
                        <li><a href="https://plus.google.com/+hanyalsamman"><i class="fa fa-google-plus"></i><div class="tooltip">Google+</div></a></li>
                        <li><a href="http://www.linkedin.com/in/hanyalsamman"><i class="fa fa-linkedin-square"></i><div class="tooltip">LinkedIn</div></a></li>
                    </ul>
                </div>
                -->
            </div>

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <!-- Footer Navigation -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <div class="footer-lower-container">

                <ul class="footer-lower">
                    <li {{ (Request::is('/') ? ' class="current"' : '') }}><a href="{{{ URL::to('') }}}">Home</a></li>

                    <li {{ (Request::is('/') ? ' class="current"' : '') }}><a href="{{{ URL::to('') }}}">How it works</a></li>

                    <li {{ (Request::is('/') ? ' class="current"' : '') }}><a href="{{{ URL::to('') }}}">Features</a></li>

                    <li {{ (Request::is('/') ? ' class="current"' : '') }}><a href="{{{ URL::to('') }}}">Donate</a></li>

                    @if (auth()->check())

                    <li><a href="{{{ URL::to('auth/logout') }}}">Logout</a></li>
                    @else

                    <li {{ (Request::is('auth/signin') ? ' class="current"' : '') }}><a href="{{{ URL::to('auth/signin') }}}">Signin</a></li>
                    @endif

                </ul>

                <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                <!-- Copyright -->
                <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                <div class="footer-copyright">
                    Ncryptd is a trademark of <a href="http://codexc.com/me" target="_blank">Hany alsamman</a> &copy; <a href="http://www.ncryptd.com/" target="_blank">Ncryptd</a> 2013 - 2018 All rights reserved.
                </div>
                <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                <!-- END Copyright -->
                <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            </div>
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <!-- END Footer Navigation -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <!-- Top of Page Link -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <a class="top-of-page-link" href="#"><i class="fa fa-chevron-up"></i></a>
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <!-- END Top of Page Link -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END Footer -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Footer Container -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Main Container -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- General Site Configuration -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<script src="{{ URL::asset('assets/js/jquery.easing.js') }}"></script>
<script src="{{ URL::asset('assets/js/highlight.pack.js') }}"></script>
<script src="{{ URL::asset('assets/js/typed.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/common.js') }}" type="text/javascript"></script>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Carousels (Modified bxSlider) -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="{{ URL::asset('assets/js/jquery.carousel-main.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/jquery.carousel-content.min.js') }}" type="text/javascript"></script>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Settings -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<script src="{{ URL::asset('assets/js/home-slider-settings.js') }}" type="text/javascript"></script>
<!--
<script src="{{ URL::asset('assets/js/carousel-portfolio-settings.js') }}" type="text/javascript"></script>
-->
<script src="{{ URL::asset('assets/js/carousel-blog-settings.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/carousel-testimonials-settings.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/carousel-clients-settings.js') }}" type="text/javascript"></script>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END JavaScript -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBeforeww(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-10448459-2', 'ncryptd.com');
    ga('send', 'pageview');

</script>

</body>
</html>
