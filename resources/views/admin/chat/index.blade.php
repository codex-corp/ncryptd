<script src="{{asset('assets/admin/js/chat.js')}}" type="text/javascript"></script>

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
                                {{--Ncryptd Founder--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="user-details-status-wrapper">--}}
                            {{--<span class="badge badge-important">{{TBMsg::getUnreadMsgsInConversation(auth()->id(), $user->id)}}</span>--}}
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
