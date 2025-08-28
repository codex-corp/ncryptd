<!DOCTYPE html>
<html>
<head>
    <title>{{ Config::get('settings.site.title') }}</title>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="author" content="{{ Config::get('settings.site.metaauthor') }}">

    <!-- NEED TO WORK ON -->
    <link href="{{asset('assets/admin/plugins/pace/pace-theme-flash.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('assets/admin/plugins/jquery-slider/css/jquery.sidr.light.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('assets/admin/plugins/boostrapv3/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/plugins/boostrapv3/css/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/animate.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/responsive.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/custom-icon-set.css')}}" rel="stylesheet" type="text/css"/>

    <!-- BEGIN PLUGIN CSS -->
    <link href="{{asset('assets/admin/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('assets/admin/plugins/bootstrap-datepicker/css/datepicker.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/jquery-ricksaw-chart/css/rickshaw.css')}}" type="text/css" media="screen" >
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/jquery-morris-chart/css/morris.css')}}" type="text/css" media="screen">
    <link href="{{asset('assets/admin/plugins/bootstrap-select2/select2.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('assets/admin/plugins/jquery-jvectormap/css/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('assets/admin/plugins/boostrap-checkbox/css/bootstrap-checkbox.css')}}" rel="stylesheet" type="text/css" media="screen"/>

    <link href="{{asset('assets/admin/plugins/jquery-notifications/css/messenger.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('assets/admin/plugins/jquery-notifications/css/messenger-theme-flat.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <!-- END PLUGIN CSS -->

    <!-- BEGIN CORE JS FRAMEWORK-->
    <script src="{{asset('assets/admin/plugins/jquery-1.8.3.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>
    <!--
    <script src="{{asset('assets/admin/plugins/boostrapv3/js/bootstrap.min.js')}}" type="text/javascript"></script>
    -->
    <script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('assets/admin/plugins/breakpoints.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/jquery-unveil/jquery.unveil.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/jquery-block-ui/jqueryblockui.js')}}" type="text/javascript"></script>
    <!-- END CORE JS FRAMEWORK -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="{{asset('assets/admin/plugins/jquery-slider/jquery.sidr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/plugins/jquery-numberAnimate/jquery.animateNumbers.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <link href="{{asset('assets/admin/plugins/bootstrap-tag/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css" media="screen" charset="utf-8">
    <script src="{{asset('assets/admin/plugins/bootstrap-tag/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('assets/wizard/jquery.cookie-1.3.1.js')}}" type="text/javascript"></script>

    <script src="{{asset('assets/admin/js/jquery.autosize.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/js/jquery.timeago.js')}}" type="text/javascript"></script>

    <!-- BEGIN CORE TEMPLATE JS -->

    @if(Request::segment('2') == false)
    <script src="{{asset('assets/admin/js/dashboard.js')}}" type="text/javascript"></script>
    @endif
    <script src="{{asset('assets/admin/js/core.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/js/chat.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/js/demo.js')}}" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->

    <!-- END NEED TO WORK ON -->

</head>
<body class="">

<div id="lockscreen" class="container hide">
    <div class="lockscreen-wrapper animated  flipInX">
        <div class="row ">
            <div class="col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-4 col-xs-offset-2">
                <div class="profile-wrapper">
                    <img src="{{ auth()->user()->avatar }}" alt="" data-src="{{ auth()->user()->avatar }}" data-src-retina="{{ auth()->user()->avatar }}" width="69" height="69" />
                </div>
                <form class="user-form" action="index.html" method="post">
                    <h2 class="user">{{auth()->user()->first_name}}</h2>
                    <input type="password" placeholder="Password" >
                    <button id="unlock" type="submit" class="btn btn-primary "><i class="fa fa-unlock"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div id="push"></div>
</div>

<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="navbar-inner">
        <!-- BEGIN NAVIGATION HEADER -->
        <div class="header-seperation">
            <!-- BEGIN MOBILE HEADER -->
            <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
                <li class="dropdown">
                    <a id="main-menu-toggle" href="#main-menu" class="">
                        <div class="iconset top-menu-toggle-white"></div>
                    </a>
                </li>
            </ul>
            <!-- END MOBILE HEADER -->
            <!-- BEGIN LOGO -->
            <a href="#">
                <img src="{{asset('assets/images/logo.png')}}" class="logo" alt="" data-src="{{asset('assets/images/logo.png')}}" data-src-retina="{{asset('assets/admin/img/logo.png')}}" width="110"/>
            </a>
            <!-- END LOGO -->
            <!-- BEGIN LOGO NAV BUTTONS -->
            <ul class="nav pull-right notifcation-center">
                <li class="dropdown" id="header_task_bar">
                    <a href="{{ URL::route('home') }}" class="dropdown-toggle active" data-toggle="">
                        <div class="iconset top-home"></div>
                    </a>
                </li>
                <!-- BEGIN MOBILE CHAT TOGGLER
                <li class="dropdown" id="header_inbox_bar">
                    <a href="#" class="dropdown-toggle">
                        <div class="iconset top-messages"></div>
                        <span class="badge" id="msgs-badge">2</span>
                    </a>
                </li>

                <li class="dropdown" id="portrait-chat-toggler" style="display:none">
                    <a href="#sidr" class="chat-menu-toggle">
                        <div class="iconset top-chat-white"></div>
                    </a>
                </li>
                -->
                <!-- END MOBILE CHAT TOGGLER -->
            </ul>
            <!-- END LOGO NAV BUTTONS -->
        </div>
        <!-- END NAVIGATION HEADER -->
        <!-- BEGIN CONTENT HEADER -->
        <div class="header-quick-nav">
            <!-- BEGIN HEADER LEFT SIDE SECTION -->
            <div class="pull-left">
                <!-- BEGIN SLIM NAVIGATION TOGGLE -->
                <ul class="nav quick-section">
                    <li class="quicklinks">
                        <a href="#" class="" id="layout-condensed-toggle">
                            <div class="iconset top-menu-toggle-dark"></div>
                        </a>
                    </li>
                </ul>
                <!-- END SLIM NAVIGATION TOGGLE -->
                <!-- BEGIN HEADER QUICK LINKS -->
                <ul class="nav quick-section">
                    <!--
                    <li class="quicklinks"><a href="#" class=""><div class="iconset top-reload"></div></a></li>
                    <li class="quicklinks"><span class="h-seperate"></span></li>
                    <li class="quicklinks"><a href="#" class=""><div class="iconset top-tiles"></div></a></li>
                      -->
                    <li class="m-r-10 input-prepend inside search-form no-boarder">
                        <span class="add-on"><span class="iconset top-search"></span></span>
                        <input name="" type="text" class="no-boarder" placeholder="Search Dashboard" style="width:250px;">
                    </li>

                </ul>
            </div>
            <!-- END HEADER LEFT SIDE SECTION -->
            <!-- BEGIN HEADER RIGHT SIDE SECTION -->
            <div class="pull-right">
                <div class="chat-toggler">
                    <!-- BEGIN NOTIFICATION CENTER -->
                    <a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom" data-content="" data-toggle="dropdown" data-original-title="Notifications">
                        <div class="user-details">
                            <div class="username">
                                <span class="badge badge-important">0</span>&nbsp;{{ auth()->user()->first_name }}
                            </div>
                        </div>
                        <div class="iconset top-down-arrow"></div>
                        <!-- END NOTIFICATION MESSAGE -->
                        <div id="nofty" class="simple-chat-popup hide">
                            <div class="simple-chat-popup-arrow"></div>
                            <div class="simple-chat-popup-inner">
                                <div style="width:100px">
                                    <div class="semi-bold">notification-popup</div>
                                    <div class="message">Message...</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div id="notification-list" style="display:none">
                        <div style="width:300px">

                            <!-- BEGIN NOTIFICATION MESSAGE -->
                        </div>
                    </div>
                    <!-- END NOTIFICATION CENTER -->
                    <!-- BEGIN PROFILE PICTURE -->
                    <div class="profile-pic">
                        <img src="{{ auth()->user()->avatar }}" alt="" data-src="{{ auth()->user()->avatar }}" data-src-retina="{{ auth()->user()->avatar }}" width="35" height="35" />
                    </div>
                    <!-- END PROFILE PICTURE -->
                </div>
                <!-- BEGIN HEADER NAV BUTTONS -->
                <ul class="nav quick-section">
                    <!-- BEGIN SETTINGS -->
                    <li class="quicklinks">
                        <a data-toggle="dropdown" class="dropdown-toggle pull-right" href="#" id="user-options">
                            <div class="iconset top-settings-dark"></div>
                        </a>
                        <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="user-options">
                            {{--<li><a href="#">Normal Link</a></li>--}}
                            {{--<li><a href="#">Badge Link&nbsp;&nbsp;<span class="badge badge-important animated bounceIn">2</span></a></li>--}}
                            {{--<li class="divider"></li>--}}
                            <li><a href="{{{ URL::to('auth/logout') }}}"><i class="fa fa-power-off"></i> Signout</a></li>
                        </ul>
                    </li>
                    <!-- END SETTINGS -->
                    <li class="quicklinks"><span class="h-seperate"></span></li>
                    <!-- BEGIN CHAT SIDEBAR TOGGLE -->
                    <li class="quicklinks">
                        <a id="chat-menu-toggle" href="#sidr" class="chat-menu-toggle">
                            <div class="iconset top-chat-dark"><span class="badge badge-important hide" id="chat-message-count">1</span></div>
                        </a>
                        <!-- BEGIN OPTIONAL RECENT CHAT POP UP NOTIFICATION -->
                        <div id="chat_popup" class="simple-chat-popup chat-menu-toggle hide">
                            <div class="simple-chat-popup-arrow"></div>
                            <div class="simple-chat-popup-inner">
                                <div style="width:100px">
                                    <div class="semi-bold">Name</div>
                                    <div class="message">Message...</div>
                                </div>
                            </div>
                        </div>
                        <!-- END OPTIONAL RECENT CHAT POP UP NOTIFICATION -->
                    </li>
                    <!-- END CHAT SIDEBAR TOGGLE -->
                </ul>
                <!-- END HEADER NAV BUTTONS -->
            </div>
            <!-- END HEADER RIGHT SIDE SECTION -->
        </div>
        <!-- END CONTENT HEADER -->
    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->

<!-- BEGIN CONTENT -->
<div class="page-container row-fluid">
    <!-- BEGIN SIDEBAR -->
    <!-- BEGIN MENU -->
    <div class="page-sidebar" id="main-menu">
        <div class="page-sidebar-wrapper" id="main-menu-wrapper">
            <!-- BEGIN MINI-PROFILE -->
            <div class="user-info-wrapper">
                <div class="profile-wrapper">
                    @if( !empty(auth()->user()->avatar) )
                    <img src="{{ auth()->user()->avatar }}" alt="" data-src="{{ auth()->user()->avatar }}" data-src-retina="{{ auth()->user()->avatar }}" width="69" height="69" />

                    @else
                    <img src="{{asset('assets/admin/img/profiles/avatar.jpg')}}" alt="" data-src="{{asset('assets/admin/img/profiles/avatar.jpg')}}" data-src-retina="{{asset('assets/admin/img/profiles/avatar2x.jpg')}}" width="69" height="69" />
                    @endif
                </div>
                <div class="user-info">
                    <div class="greeting">Welcome</div>
                    <div class="username">{{ \Illuminate\Support\Str::limit(auth()->user()->first_name,17) }}</div>
                    <div class="status">Status<a href="#"><div class="status-icon green"></div>Online</a></div>
                    <!-- <div class="status">{{ auth()->user()->last_login }}</div>-->
                </div>
            </div>
            <!-- END MINI-PROFILE -->
            <!-- BEGIN SIDEBAR MENU -->
            <p class="menu-title">BROWSE<span class="pull-right"><a href="javascript:;"><i class="fa fa-refresh"></i></a></span></p>
            <ul id="main_menu">
                @include('admin.partials.menu')
            </ul>
            <!-- END SIDEBAR MENU -->
            <!-- BEGIN SIDEBAR WIDGETS -->
            <div class="side-bar-widgets">
                <!-- BEGIN FOLDER WIDGET
                <p class="menu-title">FOLDER<span class="pull-right"><a href="#" class="create-folder"><i class="icon-plus"></i></a></span></p>
                <ul class="folders">
                    <li><a href="#"><div class="status-icon green"></div>Task 1</a></li>
                    <li class="folder-input" style="display:none">
                        <input type="text" placeholder="Name of folder" class="no-boarder folder-name" name="" id="folder-name">
                    </li>
                </ul>
                -->
                <!-- END FOLDER WIDGET -->
                <!-- BEGIN PROJECTS WIDGET -->
                <p class="menu-title">Recent PROJECTS</p>

                {{--<div class="status-widget">--}}
                    {{--<div class="status-widget-wrapper">--}}
                        {{--<div class="title">Project Title<a href="#" class="remove-widget"><i class="icon-custom-cross"></i></a></div>--}}
                        {{--<p>Project Description</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{----}}
                {{--<div class="status-widget">--}}
                    {{--<div class="status-widget-wrapper">--}}
                        {{--<div class="title">Project Title<a href="#" class="remove-widget"><i class="icon-custom-cross"></i></a></div>--}}
                        {{--<p>Project Description</p>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <p class="menu-title">Lock Screen</p>
                <!-- BEGIN EXAMPLE 1 -->
                <div class="status-widget">
                    <div class="status-widget-wrapper">
                        <p>
                        <div class="slide-primary">
                            <input value="0" class="ios enable_lockscreen" name="switch" style="display: none;" type="checkbox" />
                        </div>
                        </p>
                    </div>
                </div>


                <!-- END EXAMPLE 1 -->
                <!-- END PROJECTS WIDGET -->
            </div>
            <div class="clearfix"></div>
            <!-- END SIDEBAR WIDGETS -->
        </div>
    </div>
    <!-- BEGIN SCROLL UP HOVER -->
    <a href="#" class="scrollup">Scroll</a>
    <!-- END SCROLL UP HOVER -->
    <!-- END MENU -->
    <!-- BEGIN SIDEBAR FOOTER WIDGET -->
    <div class="footer-widget">
        <div class="progress transparent progress-small no-radius no-margin">
            <div data-percentage="5%" class="progress-bar progress-bar-success animate-progress-bar"></div>
        </div>
        <div class="pull-right">
            <div class="details-status">
                <span data-animation-duration="560" data-value="5" class="animate-number"></span>%
            </div>
            <a href="{{{ URL::to('auth/logout') }}}"><i class="fa fa-power-off"></i></a>
        </div>
    </div>
    <!-- END SIDEBAR FOOTER WIDGET -->
    <!-- END SIDEBAR -->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="page-content">

        <div class="clearfix"></div>
        <div class="content">
            <ul class="breadcrumb">
                <li>
                    <p>YOU ARE HERE</p>
                </li>
                <li><a href="#" class="active">Create Project</a> </li>
            </ul>
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            @yield('content')
            <!-- END PLACE PAGE CONTENT HERE -->
        </div>
    </div>
    <!-- END PAGE CONTAINER -->
</div>
<!-- END CONTENT -->

<!-- BEGIN CHAT -->
<div id="sidr" class="chat-window-wrapper">
    <div id="main-chat-wrapper" >
    <input type="hidden" id="user_id" value="{{auth()->id()}}">
    <div class="chat-window-wrapper fadeIn" id="chat-users" >
        <div class="chat-header">
            <div class="pull-left">
                <input type="text" placeholder="search">
            </div>
            <div class="pull-right">
                <a href="#" class="" ><div class="iconset top-settings-dark "></div> </a>
            </div>
        </div>
        <!--
        <div class="side-widget">
            <div class="side-widget-title">group chats</div>
            <div class="side-widget-content">
                <div id="groups-list">
                    <ul class="groups" >
                        <li><a href="#"><div class="status-icon green"></div>Office work</a></li>
                        <li><a href="#"><div class="status-icon green"></div>Personal vibes</a></li>
                    </ul>
                </div>
            </div>
        </div>
        -->
        <div class="side-widget fadeIn">
            <div class="side-widget-title">Let's Talk!</div>
            <div id="favourites-list">
                <div class="side-widget-content" >

                    {{--@foreach(\App\User::all() as $user)--}}
                        {{--@if($user->id != auth()->id())--}}
                        {{--<div data-chat-user="{{$user->id}}" class="user-details-wrapper @if($user->isSuperUser()) active @endif" data-chat-status="online" data-chat-user-pic="{{$user->avatar}}" data-chat-user-pic-retina="{{$user->avatar}}" data-user-name="{{$user->first_name}}">--}}
                            {{--<div class="user-profile">--}}
                                {{--<img src="{{$user->avatar}}"  alt="" data-src="{{$user->avatar}}" data-src-retina="{{$user->avatar}}" width="35" height="35">--}}
                            {{--</div>--}}
                            {{--<div class="user-details">--}}
                                {{--<div class="user-name">--}}
                                    {{--{{$user->first_name}}--}}
                                {{--</div>--}}
                                {{--<div class="user-more">--}}
                                    {{--@if($user->first_name == 'Hany')--}}
                                    {{--Ncryptd Founder--}}
                                    {{--@else--}}
                                    {{--Avaliable--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="user-details-status-wrapper">--}}
                                {{--<span class="badge badge-important"></span>--}}
                            {{--</div>--}}
                            {{--<div class="user-details-count-wrapper">--}}
                                {{--<div class="status-icon green"></div>--}}
                            {{--</div>--}}
                            {{--<div class="clearfix"></div>--}}
                        {{--</div>--}}
                        {{--@endif--}}
                    {{--@endforeach--}}

                </div>
            </div>
        </div>
    </div>

    <div class="chat-window-wrapper fadeIn" id="messages-" style="display:none">
        <div class="chat-header">
            <div class="pull-left">
                <input type="text" placeholder="search">
            </div>
            <div class="pull-right">
                <a href="#" class="" ><div class="iconset top-settings-dark "></div> </a>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="chat-messages-header">
            <div class="status online"></div><span class="semi-bold"></span>
            <a href="#" class="chat-back"><i class="icon-custom-cross"></i></a>
        </div>
        <div class="chat-messages">

        </div>
    </div>

    <div class="chat-input-wrapper" style="display:none">

        <textarea class="chat-message-input" data-clear-btn="true" rows="1" placeholder="Type your message"></textarea>
    </div>

    <div class="clearfix"></div>
    </div>
</div>
<!-- END CHAT -->

<!-- BEGIN PAGE LEVEL JS -->
<script src="{{asset('assets/admin/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/plugins/jquery-numberAnimate/jquery.animateNumbers.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/plugins/jquery-block-ui/jqueryblockui.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/plugins/bootstrap-select2/select2.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/admin/plugins/jquery-ricksaw-chart/js/raphael-min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-ricksaw-chart/js/d3.v2.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-ricksaw-chart/js/rickshaw.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-morris-chart/js/morris.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-easy-pie-chart/js/jquery.easypiechart.min.js')}}"></script>

<script src="{{asset('assets/admin/plugins/jquery-slider/jquery.sidr.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/admin/plugins/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/plugins/jquery-jvectormap/js/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/admin/plugins/jquery-sparkline/jquery-sparkline.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-flot/jquery.flot.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-flot/jquery.flot.animator.min.js')}}"></script>

<script src="{{asset('assets/admin/plugins/skycons/skycons.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>


<link href="{{asset('assets/admin/plugins/ios-switch/ios7-switch.css')}}" rel="stylesheet" type="text/css" media="screen" charset="utf-8">
<script src="{{asset('assets/admin/plugins/ios-switch/ios7-switch.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/admin/plugins/jquery-notifications/js/messenger.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/plugins/jquery-notifications/js/messenger-theme-future.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/admin/js/idle-timer.min.js')}}" type="text/javascript"></script>



<!-- END PAGE LEVEL PLUGINS   -->


<script>

    $(document).ready(function() {

        $(function() {
            var lock_status = $('.enable_lockscreen').is(':checked');
            var lock_state = $.cookie('lock_status');
            var Switch = require('ios7-switch'),checkbox = document.querySelector('.enable_lockscreen');

            if(lock_state == 1){
                $('.ios-switch').removeClass('off').addClass('on');
                $( document ).idleTimer("reset");
                $( document ).idleTimer("resume");
            }else{
                $('.ios-switch').removeClass('on').addClass('off');
                $( document ).idleTimer("pause");
            }
        });

        $( document ).idleTimer( 3000 );
        $( document ).idleTimer("pause");

        var Switch = require('ios7-switch')
            , checkbox = document.querySelector('.enable_lockscreen')
            , mySwitch = new Switch(checkbox);
        mySwitch.toggle();
        mySwitch.el.addEventListener('click', function(e){
            e.preventDefault();
            mySwitch.toggle();

            if($('.enable_lockscreen').is(':checked')){
                $.cookie('lock_status', 1);
                $( document ).idleTimer("reset");
                $( document ).idleTimer("resume");

            }else{
                $.cookie('lock_status', 0);
                $( document ).idleTimer("pause");
            }

        }, false);

        $('#popover').popover();
        <!-- check for login error flash var -->
        @if (Session::has('flash_error'))
        $.gritter.add({
            title: "Notice!",
            text: "{{ Session::get('flash_error') }}",
            sticky: !0,
            time: ""});
        @endif

        $( document ).on( "idle.idleTimer", function(event, elem, obj){
            // function you want to fire when the user goes idl
            $('.header, .page-container, #sidr').hide();
            $('#lockscreen').removeClass('hide');
            $('body').addClass('error-body no-top');
        });

        $( document ).on( "active.idleTimer", function(event, elem, obj, triggerevent){
            $('#lockscreen #unlock').on('click', function (e) {
                // function you want to fire when the user becomes active again
                $('#lockscreen').addClass('hide');
                $('.header').show();
                $('.page-container').show();
                $('#sidr').show();
                $('body').removeClass('error-body no-top');
                return false;
            });
        });
    });

</script>
</body>
</html>
