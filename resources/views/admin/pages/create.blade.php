<style>
    .editable-area {
        background: none repeat scroll 0 0 #EEEEEE;
        border: 3px dashed #AAAAAA;
        clear: both;
        margin: 0px 0px 20px 0;
        padding: 12px;
    }
</style>

<link href="{{ URL::asset('assets/js/uploader/uploadfile.css') }}" rel="stylesheet">
<script src="{{ URL::asset('assets/js/uploader/jquery.uploadfile.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {

        var settings = $("#fileuploader").uploadFile({
            url: "{{ URL::route('upload') }}",
            method: "POST",
            allowedTypes: "zip,php,js",
            fileName: "myfile",
            autoSubmit: false,
            formData: {"_token": "{{ csrf_token() }}"},
            showStatusAfterSuccess: true,
            maxFileCount: 44,
            dragdropWidth: 350,
            statusBarWidth: 350,
            onSubmit: function (files) {
                //$('<div class="alert amber">This is an AMBER warning.<span title="Close" class="close"></span></div>').insertBefore('.contact-form');
            },
            onSuccess: function (files, data, xhr) {
                var obj = jQuery.parseJSON(data);

                $.each(obj, function (index, value) {

                    $('<div class="editable-area">file added to queue: ' + files + '</div>').insertBefore($("#uploader_area"));

                    $("#project_encrypt").append($('<input>').attr({
                        type: 'hidden',
                        id: 'project_folder',
                        name: 'project_folder[]',
                        value: index
                    }));

                });

                $("#uploader_area").remove();

                //$("#buttonsmsg").remove();

                //$("#wizard").find("ul[aria-label]").removeAttr("style");
            },
            onError: function (files, status, errMsg) {
                alert("Error for: " + JSON.stringify(files));
            }
        });

        $("#startUpload").click(function (e) {
            e.preventDefault();

            settings.startUpload();
        });

        $("#cleanupload").click(function (e) {
            e.preventDefault();

            $(".ajax-file-upload-statusbar").remove();

        });

        $(".generate_key").click(function (e) {
            e.preventDefault();

            $.generateRandomKey = function (limit) {
                limit = limit || 8;
                var key = '';
                var chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                var list = chars.split('');
                var len = list.length, i = 0;
                do {
                    i++;
                    var index = Math.floor(Math.random() * len);
                    key += list[index];

                } while (i < limit);
                return key;
            };

            var number = $.generateRandomKey(32);

            $(".unencrypted_key").attr('value', number);

        });

        //$('<div id="buttonsmsg" class="action-box main"><div class="action-box-text"><h3>Note: buttons will appears after upload an file</h3></div>').insertAfter( $( "ul[aria-label]" ) );

        //$("#wizard").find("ul[aria-label]").css("display","none");


    });
</script>
<div class="row">
<div class="col-md-12">
<ul id="tab-4" class="nav nav-pills">
    <li class="active"><a href="#tab4hellowWorld">Upload your files</a></li>
    <li class=""><a href="#tab4FollowUs">Settings</a></li>
    <li class=""><a href="#tab4Inspire">Hello Three</a></li>
</ul>
<div class="tab-content">
<div id="tab4hellowWorld" class="tab-pane active">
    <div class="row column-seperation">
        <div class="col-md-6">
            <div class="col-md-12 single-colored-widget">
                <div class="content-wrapper purple ">
                    <h3 class="text-white">
                        <i class="fa fa-cloud-upload fa fa-2x custom-icon-space" id="icon-resize"></i> <span class="semi-bold">Upload </span> your <spanclass="semi-bold">files</span></h3>

                    <p>Support zip, php, js</p>

                    <div class="pull-left">
                        <div id="fileuploader">Upload</div>
                    </div>
                    <div class="pull-left">
                        <a style="float: right" class="button green" id="startUpload" href="">Upload</a>
                        <a style="float: right" class="button yellow" id="cleanupload" href="">Clean</a>
                    </div>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </div>
                <div class="heading">
                    <div class="pull-left">
                        <h4>Font <span class="semi-bold">Awesome</span></h4>

                        <p>The iconic font designed for Bootstrap</p>
                    </div>
                    <div class="pull-right"><span class="small-text muted">v4.0.3</span></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <h3 class="semi-bold">great tabs</h3>

            <p class="light">default, the textarea element comes with a vertical scrollbar (and maybe even a horizontal
                scrollbar). This vertical scrollbar enables the user to continue entering and reviewing their text (by
                scrolling up and down).</p>
        </div>

    </div>
</div>
<div id="tab4FollowUs" class="tab-pane">
<div class="row">
    <div class="col-md-12">
    <div class="grid simple transparent">
    <div class="grid-title">
        <h4>Form <span class="semi-bold">Wizard</span> <span class="number-page"></span></h4>

        <div class="tools"><a href="javascript:;" class="collapse"></a>
            <a href="#grid-config" data-toggle="modal" class="config"></a>
            <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>
        </div>
    </div>
    <div class="grid-body">
        <div class="row">
            <!-- FORM -->
            <form id="project_encrypt" method="post" action="/ncryptd/bye">
            @csrf
            <div id="rootwizard" class="col-md-12">
            <div class="form-wizard-steps">
                <ul class="wizard-steps">
                    <li class="" data-target="#step1"><a href="#tab1" data-toggle="tab"> <span
                                class="step">1</span> <span class="title">Obfuscation</span> </a>
                    </li>
                    <li data-target="#step2" class=""><a href="#tab2" data-toggle="tab"> <span
                                class="step">2</span> <span class="title">Exclusion</span>
                        </a></li>
                    <li data-target="#step3" class=""><a href="#tab3" data-toggle="tab"> <span
                                class="step">3</span> <span class="title">Encryption</span> </a></li>
                    <li data-target="#step4" class=""><a href="#tab4" data-toggle="tab"> <span
                                class="step">4</span> <span class="title">Feedback <br>
                                          </span> </a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="tab-content transparent">
                <div class="tab-pane" id="tab1"><br>
                    <h4 class="semi-bold">Step 1 - <span class="light">Obfuscation</span></h4>
                    <br>

                    <div>
                        <h3>Obfuscation (Scrambler) <span class="semi-bold"> options</span></h3>
                        <br>

                        <div class="row form-row">
                            <div class="col-md-6">
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Full Name" class="form-control" name="txtFullName">
                                    </div>
                                </div>

                                <div class="checkbox check-default">
                                    <input id="checkbox1" type="checkbox" class="" name="ReplaceClasses" value="1">
                                    <label for="checkbox1">Classes</label>
                                </div>

                                <div class="checkbox check-default">
                                    <input id="checkbox2" type="checkbox" name="ReplaceFunctions" value="1">
                                    <label for="checkbox2">Functions</label>
                                </div>

                                <div class="checkbox check-default">
                                    <input id="checkbox3" type="checkbox" name="ReplaceVariables" value="1">
                                    <label for="checkbox3">Variables</label>
                                </div>

                                <div class="checkbox check-default">
                                    <input id="checkbox4" type="checkbox" disabled name="ReplaceConstants" value="0">
                                    <label for="checkbox4">Constants</label>
                                </div>

                                <div class="checkbox check-default">
                                    <input id="checkbox5" type="checkbox" name="ReplaceRoutes" value="1">
                                    <label for="checkbox5">Routes</label>
                                </div>

                                <div class="checkbox check-default">
                                    <input id="checkbox6" type="checkbox" name="var_encode" value="0">
                                    <label for="checkbox6">Variables Encoding</label>
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab2"><br>
                    <h4 class="semi-bold">Step 2 - <span class="light">Exclusion</span></h4>
                    <br>

                    <div class="row form-row">
                        <div class="col-md-6">
                            <label>Exclude Functions</label>
                            <textarea name="CopyrightText" rows="1" cols="1" placeholder="Example: __autoload, __clone"
                                      style="width: 100%; height: 50px; font-family: sans-serif"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Exclude Functions returning objects</label>
                            <textarea name="CopyrightText" rows="1" cols="1" placeholder="Example: mysql_query, mysql_result"
                                      style="width: 100%; height: 50px; font-family: sans-serif"></textarea>
                        </div>
                    </div>
                    <div class="row form-row">
                        <div class="col-md-6">
                            <label>Exclude Variables (without $)</label>
                            <textarea name="CopyrightText" rows="1" cols="1" placeholder="Example: config, db"
                                      style="width: 100%; height: 50px; font-family: sans-serif"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Exclude Files</label>
                            <textarea name="CopyrightText" rows="1" cols="1" placeholder="Example: header.php, configs.php"
                                      style="width: 100%; height: 50px; font-family: sans-serif"></textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab3"><br>
                    <h4 class="semi-bold">Step 3 - <span class="light">Encryption</span></h4>
                    <br>

                    <ul class='tabs'>
                        <li><a href='#Blowfish'>Blowfish Encryption</a></li>
                        <li><a href='#Ciphers'>Ciphers Encryption</a></li>
                    </ul>

                    <div id='Blowfish' class="tabs-content white-bg">
                        <div class="accordion open">
                            <!-- Title -->
                            <div class="accordion-header">
                                Blowfish Encryption (<a target="_blank" href="http://pecl.php.net/package/BLENC">Blenc</a>)
                            </div>
                            <!-- Text -->
                            <div class="accordion-content">
                                <div style="float: left">
                                    <p><input type="checkbox" name="blenciT">Blenc Encryption</p>
                                </div>
                                <div style="float: left">
                                    <p><input type="checkbox" name="BLENC_Report">Blenc Report (PDF)</p>
                                </div>
                                <p>Set your key (<b>unencrypt key</b>) or <a href="#" class="generate_key">Generate new one</a></p>
                                <INPUT TYPE="text" style="width: 300px;" class="unencrypted_key" NAME="unencrypted_key"
                                       VALUE="{{ md5(time()); }}">
                            </div>
                        </div>
                    </div>

                    <div id='Ciphers' class="tabs-content white-bg">
                        <div class="accordion open">
                            <!-- Title -->
                            <div class="accordion-header">
                                Ciphers Encryption (<a target="_blank" href="http://php.net/manual/en/mcrypt.ciphers.php">mcrypt</a>)
                            </div>
                            <!-- Text -->
                            <div class="accordion-content">
                                <div style="float: left">
                                    <p><input type="radio" name="ciphers" value="fw"><b>Framework</b> (Laravel)</p>
                                </div>
                                <div style="float: left">
                                    <p><input type="radio" name="ciphers" value="none">None <b>Framework</b></p>
                                </div>
                                <p>Set your key (<b>unencrypt key</b>) or <a href="#" class="generate_key">Generate new one</a></p>
                                <INPUT TYPE="text" style="width: 300px;" class="cipher_key" NAME="cipher_key"
                                       VALUE="{{ md5(time()); }}">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="tab4"><br>
                    <h4 class="semi-bold">Step 4 - <span class="light">Feedback</span></h4>
                    <br>

                    <ul class='tabs'>
                        <li><a href='#Optimization'>Optimization</a></li>
                        <li><a href='#Lock'>Lock</a></li>
                        <li><a href='#Copyright'>Copyright</a></li>
                    </ul>

                    <div id='Lock' class="tabs-content white-bg">
                        <div class="accordion open">
                            <!-- Title -->
                            <div class="accordion-header">
                                Lock Options
                            </div>
                            <!-- Text -->
                            <div class="accordion-content">
                                <div style="float: left">
                                    <p><input type="checkbox" name="blenciT">Use <b>Laravel</b> Framework Crypt</p>
                                </div>
                                <div style="float: left">
                                    <p><input type="checkbox" name="blenciT">Stop non-programmers
                                        <b>gzuncompress</b>(<b>base64_decode</b>($code))</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id='Optimization' class="tabs-content white-bg">
                        <div class="accordion open">
                            <!-- Title -->
                            <div class="accordion-header">
                                Optimization options
                            </div>
                            <!-- Text -->
                            <div class="accordion-content">
                                <div style="float: left;">
                                    <p>Comment removal <input type="checkbox" name="RemoveComments"></p>

                                    <p><input type="checkbox" name="RemoveIndents" value="1" checked>Indents</p>


                                    <p><input type="checkbox" name="ConcatenateLines" value="1"> Returns</p>
                                </div>

                                <div style="float: left; margin-left: 40px">
                                    (Always preserve first <INPUT TYPE="text" style="width: 50px;" NAME="KeptCommentCount" VALUE="0">
                                    comments)

                                    <p><input type="checkbox" name="RemoveWhite" value="1" checked>WhiteSpaces</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id='Copyright' class="tabs-content white-bg">
                        <!-- Message Box -->
                        <INPUT TYPE=CHECKBOX NAME="CopyrightPHP" value=1><b>Copyright Text</b> (to put on top of every processed
                        file)<br>
                        <textarea name="CopyrightText" placeholder="Message *"></textarea>
                    </div>

                </div>
                <ul class=" wizard wizard-actions">
                    <li class="previous"><a href="javascript:;" class="btn">&nbsp;&nbsp;Previous&nbsp;&nbsp;</a>
                    </li>
                    <li class="next"><a href="javascript:;" class="btn btn-primary">&nbsp;&nbsp;Next&nbsp;&nbsp;</a>
                    </li>

                    <li class="previous first"><a href="javascript:;" class="btn">&nbsp;&nbsp;First&nbsp;&nbsp;</a>
                    </li>
                    <li class="next last"><a href="javascript:;" class="btn btn-primary">&nbsp;&nbsp;Last&nbsp;&nbsp;</a>
                    </li>

                    <li class="finish"><a href="javascript:;" class="btn">
                            &nbsp;&nbsp;Finish&nbsp;&nbsp;</a></li>
                </ul>
            </div>
            </div>
            <div class="col-md-12">
                <div class="progress progress-small">
                    <div class="progress-bar progress-bar-danger animate-progress-bar" data-percentage="45%"></div>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>
</div>
</div>
<div id="tab4Inspire" class="tab-pane">
    <div class="row">
        <div class="col-md-12">
            <h3>Follow us &amp; get updated!</h3>

            <p>Instantly connect to what's most important to you. Follow your friends, experts, favorite celebrities,
                and breaking news.</p>
            <br>

            <p><a class="btn-social" href="#"><i class="icon-facebook"></i></a> <a class="btn-social" href="#"><i
                        class="icon-twitter"></i> </a> <a class="btn-social" href="#"><i class="icon-dribbble"></i></a>
                <a class="btn-social" href="#"><i class="icon-pinterest-sign"></i></a> <a class="btn-social" href="#"><i
                        class="icon-tumblr"></i> </a> <a class="btn-social" href="#"><i class="icon-linkedin-sign"></i>
                </a></p>
        </div>
    </div>
</div>
</div>
</div>

</div>

<script src="{{asset('assets/admin/plugins/boostrap-form-wizard/js/jquery.bootstrap.wizard.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/js/form_validations.js')}}" type="text/javascript"></script>

<script>

    $(document).ready(function () {
        //$("body").toggleMenu();
        $('#layout-condensed-toggle').trigger('click');
    });

</script>