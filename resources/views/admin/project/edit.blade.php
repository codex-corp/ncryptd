<script type="text/javascript" src="{{asset('assets/js/tinymce/tinymce.min.js')}}"></script>

<script>
    function elFinderBrowser (field_name, url, type, win) {
        tinymce.activeEditor.windowManager.open({
            file: '{{URL::to("elfinder/tinymce")}}',// use an absolute path!
            title: 'VIP File Manager v1.0',
            width: 900,
            height: 450,
            resizable: 'yes',
            inline: 'yes',    // This parameter only has an effect if you use the inlinepopups plugin!
            popup_css: false, // Disable TinyMCE's default popup CSS
            close_previous: 'no'
        }, {
            setUrl: function (url) {
                win.document.getElementById(field_name).value = url;
            }
        });
        return false;
    }
    tinymce.init({
        selector: ".editable",
        file_browser_callback : elFinderBrowser,
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor",
        image_advtab: true
    });
</script>

<div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
    <!--
    <div class="page-header">
        <h3><i class="aweso-icon-list-alt opaci35"></i> Add Page</h3>
    </div>
    -->
    <div class="row-fluid">
        <div class="span14 grider">
            <div class="widget widget-simple">
                <div class="widget-header">
                    <h4><i class="fontello-icon-user"></i>
                        Add by
                        <small>{{ Sentry::getUser()->first_name }}</small>
                    </h4>
                </div>
                <div class="widget-content">
                    <div class="widget-body">
                        <form id="accounForm" class="form-horizontal" method="post" action="{{URL::to("admin/page/$id/update")}}">
                            @csrf
                            <div class="row-fluid">
                                <div class="span14 form-dark">
                                    <fieldset>
                                        <legend>Page Information
                                        </legend>
                                        <ul class="form-list label-left list-bordered dotted">

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Title</label>
                                                <div class="controls">
                                                    <input class="span6" type="text" value="{{ $page->title }}" name="title">
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Description</label>
                                                <div class="controls">
                                                    <input class="span6" type="text" value="{{ $page->description }}" name="description">
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Slug <small>short name in url</small></label>
                                                <div class="controls">
                                                    <input class="span6" type="text" value="{{ $page->slug }}" name="slug">
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Page <small>Status</small></label>
                                                <div class="controls">
                                                    <label class="radio inline">
                                                        {{ Form::radio('status', 'published', ($page->status == 'published') ? true : false , array('class'=>'radio'))  }}
                                                        published </label>
                                                    <label class="radio inline">
                                                        {{ Form::radio('status', 'draft', ($page->status == 'draft') ? true : false, array('class'=>'radio')) }}
                                                        draft </label>
                                                </div>

                                            </li>



                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Contents</label>
                                                <div class="controls" style="border: 1px solid #c2c3c7">
                                                    <div style="clear: both"></div>
                                                    <textarea placeholder="test" style="width: 100%"  class="editable" name="content" data-id="body-1">
                                                        {{ $page->content }}
                                                    </textarea>
                                                </div>
                                            </li>

                                            <!-- // drop down -->
                                            <li class="control-group">
                                                <label for="accountAddressState" class="control-label">Select Category <span class="required">*</span></label>
                                                <div class="controls">
                                                    {{ Form::select('category_id', $pages, $page->category_id, array('class' => 'span6', 'id' => 'category_id')) }}
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountAddressState" class="control-label">Select Language <span class="required">*</span></label>
                                                <div class="controls">
                                                    {{ Form::select('lang_id', $languages, $page->lang_id, array('class' => 'span6', 'id' => 'lang_id')) }}
                                                </div>
                                            </li>


                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Page <small>Mode</small></label>
                                                <div class="controls">
                                                    <label class="radio inline">
                                                        <!-- 1 = static -->
                                                        {{ Form::radio('mode', '1', ($page->static == '1') ? true : false, array('class'=>'radio')) }}
                                                        Static </label>
                                                    <label class="radio inline">
                                                        <!-- 0 = Dynamic -->
                                                        {{ Form::radio('mode', '0', ($page->static == '0') ? true : false, array('class'=>'radio')) }}
                                                        Dynamic </label>
                                                </div>
                                            </li>


                                            <li class="control-group">
                                                <label for="accountPrefix" class="control-label">Page <small>Included form</small></label>
                                                <div class="controls">
                                                    <label class="radio inline">
                                                        <!-- 1 = static -->
                                                        {{ Form::radio('front', '1', ($page->front == '1') ? true : false, array('class'=>'radio')) }}
                                                        Yes </label>
                                                    <label class="radio inline">
                                                        <!-- 0 = Dynamic -->
                                                        {{ Form::radio('front', '0', ($page->front == '0') ? true : false, array('class'=>'radio')) }}
                                                        No </label>
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountGroup" class="control-label">Mail address will receive</label>
                                                <div class="controls">
                                                    <textarea style="width: 80%" class="EmailTags auto" name="email_to">{{ $page->email_to }}</textarea>                                         </textarea>
                                                </div>
                                            </li>

                                            <li class="control-group">
                                                <label for="accountGroup" class="control-label">Mail address will receive copy as CC</label>
                                                <div class="controls">
                                                    <textarea style="width: 80%" class="EmailTags auto" name="email_cc">{{ $page->email_cc }}</textarea>
                                                </div>
                                            </li>

                                        </ul>
                                    </fieldset>
                                    <!-- the following field does the trick -->
                                    <input type="hidden" name="user_id" value="{{ Sentry::id() }}">
                                    <input type="hidden" name="created_at" value="">

                                    <!-- // fieldset Input -->
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-blue">Submit & Validate</button>
                                        <button class="btn cancel">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
