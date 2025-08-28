@foreach(\App\User::all() as $user)
@if($user->id != auth()->id())
<div data-chat-user="{{$user->id}}" class="user-details-wrapper @if($user->isSuperUser()) active @endif" data-chat-status="online" data-chat-user-pic="{{$user->avatar}}" data-chat-user-pic-retina="{{$user->avatar}}" data-user-name="{{$user->first_name}}">
    <div class="user-profile">
        <img src="{{$user->avatar}}"  alt="" data-src="{{$user->avatar}}" data-src-retina="{{$user->avatar}}" width="35" height="35">
    </div>
    <div class="user-details">
        <div class="user-name">
            {{$user->first_name}}
        </div>
        <div class="user-more">
            Ncryptd Founder
        </div>
    </div>
    <div class="user-details-status-wrapper">
        <span class="badge badge-important">{{TBMsg::getUnreadMsgsInConversation(auth()->id(), $user->id)}}</span>
    </div>
    <div class="user-details-count-wrapper">
        <div class="status-icon green"></div>
    </div>
    <div class="clearfix"></div>
</div>
@endif
@endforeach