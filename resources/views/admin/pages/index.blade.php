<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fontello-icon-folder-2"></i> Pages <small>Management</small></h2>
    <!--<p class="pagedesc">page desc here </p> -->
    <div class="page-bar">
        <div class="btn-toolbar">
            <ul class="nav nav-tabs pull-right">
                <li class="active" id="demo1-tab"> <a href="#TabTop1" data-toggle="tab">Show Pages</a> </li>
                <li id="demo2-tab"> <a href="#TabTop2" data-toggle="tab">Add Page</a> </li>
            </ul>
        </div>
    </div>
</div>
<!-- // page head -->

<div id="page-content" class="page-content tab-content">
    <div id="TabTop1" class="tab-pane active">
        <section>
            <div class="page-header">
                <h3><i class="fontello-icon-folder-2 opaci35"></i>Show <small>Pages</small>
                    <small>filter pages by</small>
                    <button class="btn btn-primary change_lang" value="English">English</button>
                    <button class="btn btn-warning clear_lang">Clear</button>
                </h3>

            </div>
            <div class="row-fluid">
                <div class="span10">

                    <table id="Pages" class="table boo-table table-bordered table-condensed table-hover">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Lang</th>
                            <th scope="col">Page Category</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(empty($pages))
                        <tr>
                            <td class="dataTables_empty" colspan="6"> No record found <button class="btn btn-danger resetTable">Reset filter</button> </td>
                        </tr>

                        @else

                        @foreach($pages as $page)

                        <tr>
                            <td>{{ $page->id }}</td>
                            <td>{{ $page->title }}</td>
                            <td>@if($page->lang_id) {{ Language::where('id', $page->lang_id)->first()->title; }} @endif</td>
                            <td></td>
                            <td>{{ $page->created_at }}</td>
                            <td class="hidden-phone">
                                <i class="fontello-icon-edit-2"></i><a href='{{ URL::to("admin/page/$page->id/edit") }}'>Edit</a>
                                <i class="fontello-icon-cancel-2"></i>
                                <a href="{{ URL::to("admin/page/$page->id/delete") }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- // Example row -->
        </section>
    </div>
    <div id="TabTop2" class="tab-pane">
        <section>
            <div class="page-header">
                <h3><i class="fontello-icon-folder-2 opaci35"></i> Add <small>Page</small></h3>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    @include('admin/pages/create')
                </div>
            </div>
            <!-- // Example row -->
        </section>
    </div>
</div>
<!-- // page content -->

<script>
    $(document).ready(function() {

        var table = $('#Pages');
        table.dataTable({
            "bSort": true,
            'bStateSave': true,
            'sDom' : "<'row-fluid'<'widget-header'<'span6'l><'span6'f>>>rt<'row-fluid'<'widget-footer'<'span6'><'span6'p>>"
        });

        $('.change_lang').click(function() {
            table.fnFilter($(this).val());
        });

        $('.clear_lang').click(function() {
            table.fnFilter("");
        });

    } );
</script>