<script src="{{asset('assets/admin/js/support_ticket.js')}}" type="text/javascript"></script>

<link href="{{asset('assets/admin/plugins/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet" type="text/css" media="screen"/>
<script src="{{asset('assets/admin/plugins/jquery-nestable/jquery.nestable.js')}}" type="text/javascript"></script>



<script>
    $(document).ready(function() {
        Morris.Donut({
            element: 'donut-example',
            data: [
                {label: "Classes", value: 12},
                {label: "Functions", value: 30},
                {label: "Variables", value: 20}
            ],
            colors:['#f35958','#0090d9','#eceff1']
        });

        var updateOutput = function(e)
        {
            var list   = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.html(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.html('JSON browser support required for this demo.');
            }
        };
        // activate Nestable for list 1
        $('#nestable').nestable({
            group: 0
        }).on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable').data('output', $('#nestable-output')));

        $('#nestable-menu').on('click', function(e)
        {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });

    });

</script>

<h1>Projects History</h1>

<div class="row">
    <div class="col-md-12">

        <h4>Open <span class="semi-bold">Tickets</span></h4>
        <br>
@foreach($projects as $project)
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple no-border">
                    <div class="grid-title no-border descriptive clickable">
                        <h4 class="semi-bold">{{$project->title}}</h4>

                        <p><span class="text-success bold">Project #{{$project->id}}</span> - Created on {{$project->created_at}} <span class="label label-important">ALERT</span>
                        </p>

                        <div class="actions">
                            <a class="view" href="javascript:;"><i class="fa fa-search"></i></a>
                            <a class="remove" href="javascript:;"><i class="fa fa-times"></i></a></div>
                    </div>
                    <div class="grid-body  no-border" style="display:none">
                        <div class="post">
                            <div class="user-profile-pic-wrapper">
                                <div class="user-profile-pic-normal"><img width="35" height="35"
                                                                          data-src-retina="assets/img/profiles/avatar_small2x.jpg"
                                                                          data-src="assets/img/profiles/avatar_small.jpg"
                                                                          src="assets/img/profiles/avatar_small.jpg"
                                                                          alt=""></div>
                            </div>
                            <div class="info-wrapper">
                                <div class="info">

                                    <div class="col-md-6">
                                        <div class="row-fluid">
                                            <h3>Project: <span class="semi-bold">{{$project->title}}</span></h3>
                                            <p> The <code>Obfuscation</code> <code class="fa fa-code"></code> on
                                            {{--*/ list($Classes, $Functions, $Variables) = explode(',', $project->obfus) /*--}}

                                            @if($Classes)
                                            <span class="label label-important">Classes</span>
                                            @endif

                                            @if($Functions)
                                            <span class="label label-info">Functions</span>
                                            @endif

                                            @if($Variables)
                                            <span class="label label-success">Variables</span>
                                            @endif

                                            </p>
                                            <p>
                                            @if(!empty($project->ciphers ))

                                                Using <code>Ciphers</code> For
                                                @if($project->ciphers == 'laravel')
                                                <span class="label label-inverse">Laravel Framework</span>

                                                @elseif($project->ciphers == 'none')
                                                <span class="label label-inverse">None Programmers</span>

                                                @endif

                                            @else
                                                The <code>Ciphers</code> <span class="label label-default">Not used</span>
                                            @endif()

                                            </p>

                                            <p>
                                                @if($project->has_report)
                                                    <code class="fa fa-file-text badge-white"> With Report</code>
                                                @else
                                                    <code class="fa fa-file-text"> Without a Report</code>
                                                @endif()
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div id="donut-example" style="height:200px; width: 300px"> </div>

                                    </div>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <br>

                        <div class="form-actions">
                            <div class="post col-md-12">
                                <div class="user-profile-pic-wrapper">
                                    <div class="user-profile-pic-normal"><img width="35" height="35"
                                                                              data-src-retina="assets/img/profiles/c2x.jpg"
                                                                              data-src="assets/img/profiles/c.jpg"
                                                                              src="assets/img/profiles/c.jpg" alt="">
                                    </div>
                                </div>
                                <div class="info-wrapper">
                                    <div class="info">

                                        <h3>Excluded: <span class="semi-bold">Files</span></h3>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-3">
                                                    <div class="cf nestable-lists">
                                                        <div class="" id="nestable">
                                                            <ol class="dd-list">
                                                                @foreach(unserialize($project->excluded) as $file)
                                                                <li class="dd-item" data-id="1">
                                                                    <div class="dd-handle">{{$file['FileID']}}</div>
                                                                    <ol class="dd-list">
                                                                        <li class="dd-item" data-id="5">
                                                                            <div class="dd-handle">Classes</div>
                                                                            <ol class="dd-list">

                                                                                @foreach(explode(',', $file['classes']) as $class)
                                                                                @if(!empty($class))
                                                                                <li class="dd-item" data-id="6"><div class="dd-handle">{{$class}}</div></li>
                                                                                @else
                                                                                <li class="dd-item" data-id="6"><div class="dd-handle">Empty</div></li>
                                                                                @endif
                                                                                @endforeach



                                                                            </ol>
                                                                        </li>
                                                                        <li class="dd-item" data-id="5">
                                                                            <div class="dd-handle">Functions</div>
                                                                            <ol class="dd-list">
                                                                                @foreach(explode(',', $file['functions']) as $function)
                                                                                @if(!empty($function))
                                                                                <li class="dd-item" data-id="6"><div class="dd-handle">{{$function}}</div></li>
                                                                                @else
                                                                                <li class="dd-item" data-id="6"><div class="dd-handle">Empty</div></li>
                                                                                @endif
                                                                                @endforeach
                                                                            </ol>
                                                                        </li>
                                                                        <li class="dd-item" data-id="5">
                                                                            <div class="dd-handle">Variables</div>
                                                                            <ol class="dd-list">
                                                                                @foreach(explode(',', $file['vars']) as $var)
                                                                                @if(!empty($var))
                                                                                <li class="dd-item" data-id="6"><div class="dd-handle">{{$var}}</div></li>
                                                                                @else
                                                                                <li class="dd-item" data-id="6"><div class="dd-handle">Empty</div></li>
                                                                                @endif                                                                        @endforeach
                                                                            </ol>
                                                                        </li>
                                                                    </ol>
                                                                </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>

                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endforeach
    </div>
</div>