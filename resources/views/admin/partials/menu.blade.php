<!-- BEGIN SELECTED LINK -->
@if(!Sentry::getUser()->isSuperUser() )
<li class="start active">
    <a href="{{URL::to('admin/')}}">
        <i class="icon-custom-home"></i>
        <span class="title">Dashboard</span>
        <span class="selected"></span>
        <!--<span class="badge badge-important pull-right">5</span>-->
    </a>
</li>
@endif

<li class=" ">
    <a href="{{URL::to('admin/project/create')}}">
        <i class="fa fa-terminal"></i>
        <span class="title">Create Project</span>
        <!--<span class="badge badge-important pull-right">5</span>-->
    </a>
</li>
<li class=" ">
    <a href="{{URL::to('admin/project/history')}}">
        <i class="fa fa-history"></i>
        <span class="title">Projects History</span>
        <!--<span class="badge badge-important pull-right">5</span>-->
    </a>
</li>
<!-- END SINGLE LINK -->
<!-- BEGIN ONE LEVEL MENU
<li class="">
    <a href="javascript:;">
        <i class="icon-custom-ui"></i>
        <span class="title">Projects</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li> <a href="{{URL::to('admin/project/create')}}">Start </a> </li>
        <li> <a href="{{URL::to('admin/project/create')}}">History </a> </li>
    </ul>
</li>
-->
<!-- END ONE LEVEL MENU -->

@if(Sentry::getUser()->isSuperUser() )
<!-- BEGIN ONE LEVEL MENU -->
<li class="">
    <a href="javascript:;">
        <i class="icon-custom-ui"></i>
        <span class="title">Users Management</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li> <a href="{{URL::to('admin/users')}}">Show Accounts </a> </li>
        <li> <a href="{{URL::to('admin/users/create')}}">Add Account </a> </li>
    </ul>
</li>
<!-- END ONE LEVEL MENU -->

<!-- BEGIN TWO LEVEL MENU -->
<li class="">
    <a href="javascript:;">
        <i class="fa fa-folder-open"></i>
        <span class="title">Pages Management</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li> <a href="{{URL::to('admin/page/create')}}">Add Page </a> </li>
        <li> <a href="{{URL::to('admin/page')}}">Show Pages </a> </li>
    </ul>
</li>
<!-- END TWO LEVEL MENU -->
@endif

<li class=" ">
    <a href="{{{ URL::to('auth/logout') }}}">
        <i class="fa fa-power-off"></i>
        <span class="title">Logout</span>
    </a>
</li>
