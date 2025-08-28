@extends('admin.layout')

@section('content')

<link href="{{ URL::asset('assets/js/uploader/uploadfile.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/admin/css/jquery.tree.min.css') }}" rel="stylesheet">

<script src="{{ URL::asset('assets/js/uploader/jquery.uploadfile.min.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/admin/js/jquery.tree.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {

        var settings = $("#fileuploader").uploadFile({
            url: "{{ URL::route('upload') }}",
            method: "POST",
            allowedTypes: "zip,php,js",
            fileName: "myfile",
            autoSubmit: false,
            {{--formData: {"_token": "{!! csrf_token() !!}"},--}}
            showStatusAfterSuccess: true,
            maxFileCount: 44,
            dragdropWidth: 350,
            statusBarWidth: 350,
            allowDuplicates:false,
            onSubmit: function (files) {
                //$('<div class="alert amber">This is an AMBER warning.<span title="Close" class="close"></span></div>').insertBefore('.contact-form');
            },
            onSuccess: function (files, data, xhr) {

                var obj = jQuery.parseJSON(data);
                var folderID =  obj[0];
                var count_files = obj.length;

                $.each(obj, function (index, value) {

                    //skip folder id and check if it has array
                    if(index != 0 && count_files){
                        CheckSyntax(folderID, value);
                        Analyze(folderID, value);
                    }

                    //upload normal multiple files
                    if(!count_files){
                        folderID = index;
                        CheckSyntax(folderID, files[0]);
                        Analyze(folderID, files[0]);
                    }

                    $("#project_encrypt").append($('<input>').attr({
                        type: 'hidden',
                        id: 'project_folder',
                        name: 'project_folder[]',
                        value: index
                    }));

                });
            },
            afterUploadAll:function()
            {
                $('#myModal').modal('toggle');
                $('#process_files').modal('toggle');
                $('#process_files #process_value').css('width', '70%' );

            },
            onError: function (files, status, errMsg) {
                alert("Error for: " + JSON.stringify(files));
            }
        });

        $("#startUpload").click(function (e) {
            e.preventDefault();

            settings.startUpload();

            $( document ).ajaxStop(function() {
                $('#process_files #process_value').css('width', '100%' );
                $('#process_files .modal-footer button').removeAttr('disabled').removeClass('btn-cancel');
                setTimeout(
                    function()
                    {
                        $('#process_files .modal-footer button').addClass('btn-primary');
                        $('#process_files .modal-footer button').text('Continue').button("refresh");
                        $('a#upload_btn').attr('data-target','#');
                        $('a#upload_btn').html('<i class="fa fa-cloud-upload fa fa-lg"></i> Uploaded successfully!').removeClass('btn-warning').addClass('btn-primary');
                    }, 1000);

            });
        });

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

        $(".generate_key").click(function (e) {
            e.preventDefault();

            var number = $.generateRandomKey(32);
            $(".unencrypted_key").attr('value', number);

        });

        function Analyze(FolderID, FileID){

            var FileKey = $.generateRandomKey(5);

            var fetch = $.post( "analyze", { FileKey: FileKey, FileID: FileID, FolderID: FolderID, Analyze: true, ReplaceClasses: true, ReplaceFunctions: true, ReplaceVariables: true} , function(data) {

                $('#exclude_info').hide();
                $('#magictree').show().append(data);

            }).done(function() {

                $('.checkbox-tree-'+FileKey).tree({  onCheck: { node: 'expand' }, onUncheck: { node: 'collapse' }, collapseUiIcon: 'fa fa-lg fa-arrow-circle-o-right', expandUiIcon: 'fa fa-lg fa-arrow-circle-down', leafUiIcon: 'ui-icon-bullet'});
                $('.checkbox-tree-'+FileKey).tree('collapseAll');

                $('#exclude_control_btn').show();

            }).fail(function() {
                alert( "Error "+ FileID);
            });

            fetch.always(function() {

            });
        }

        function CheckSyntax(FolderID, FileID){

            $.post( "check_syntax", { FileID: FileID, FolderID: FolderID, CheckSyntax: true} , function(data) {

                $('#check_syntax').append(data);
                $('#project_encrypt').append('<input type="hidden" name="files[]" value="'+FileID+'">');

            }).done(function() {
                //alert( "second success" );

            }).fail(function() {
                //alert( "error" );
            });
        }

        $('#tree-select-all').click(function(){
            $('[class^="checkbox-tree-"]').tree('checkAll'); });

        $('#tree-deselect-all').click(function(){
            $('[class^="checkbox-tree-"]').tree('uncheckAll'); });

        $('#tree-collapse').click(function(){
            $('[class^="checkbox-tree-"]').tree('collapseAll'); });

        $('#tree-expand').click(function(){
            $('[class^="checkbox-tree-"]').tree('expandAll'); });

    });
</script>

<!--
<div class="page-title">
    <i class="icon-custom-left"></i>
    <h3>Start - <span class="semi-bold">Project</span></h3>
</div>
-->

<div class="row">
<div class="col-md-12">
<div class="pull-right">
    <a data-toggle="modal" data-target="#myModal" id="upload_btn" class="btn btn-warning btn-cons"><i class="fa fa-upload fa fa-lg custom-icon-space"></i> <span class="semi-bold">Upload </span> your <span class="semi-bold">files</span>
    </a>
</div>
<ul id="tab-4" class="nav nav-pills">
    <li class=""><a href="#analysis"><i class="fa fa-tachometer fa fa-lg"></i> Analyse and Exclude</a></li>
    <li class=""><a href="#settings"><i class="fa fa-cogs fa fa-lg"></i> Settings
            <div id="settings_popup" class="simple-chat-popup hide">
                <div class="simple-chat-popup-arrow"></div>
                <div class="simple-chat-popup-inner">
                    <div style="width:100px">
                        <div class="semi-bold">Next Step</div>
                        <div class="message">Set your settings...</div>
                    </div>
                </div>
            </div>
        </a>
    </li>
    <li class=""><a href="#tab4Inspire"><i class="fa fa-shield fa fa-lg"></i> Download</a></li>
</ul>
<div class="tab-content">

<div id="analysis" class="tab-pane active">
    <div class="row column-seperation">
        <div class="col-md-6">
            <div class="grid simple">
                <div class="grid-title no-border">
                    <h4>Syntax <span class="semi-bold">Check</span></h4>

                    <div class="tools"> <a href="javascript:;" class="collapse"></a>
                        <a href="javascript:;" class="reload"></a>
                        <a href="javascript:;" class="remove"></a> </div>
                </div>
                <div class="grid-body no-border">
                    <div class="row-fluid">
                        <!--
                        <div class="scroller" data-height="620px" data-always-visible="1">
                        -->
                        <h4><span class="semi-bold">Analysis</span>, line-by-line</h4>
                        <p id="check_syntax">
                            PHP code checker service that will not execute your code.
                            It performs an analysis line-by-line for common mistakes and errors in your PHP syntax.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="grid simple">
                <div class="grid-title no-border">
                    <h4>Exclusion <span class="semi-bold">Area</span></h4>
                    <div class="tools"> <a href="javascript:;" class="collapse"></a><a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                </div>
                <div class="grid-body no-border">
                    <div class="row-fluid">

                        <h4><span class="semi-bold">exclude</span>, whatever <span class="semi-bold">you</span> <i>want</i> or just save the file</h4>

                        <div id="exclude_info">
                            <blockquote class="margin-top-20">
                                <p><i class="fa fa-quote-left fa fa-lg"></i>
                                    While it can be desirable to <i>obfuscate</i> names, it is sometimes necessary to prevent specific class, method and function names from being obfuscated. Such cases include elements in non-obfuscated code that are to be referenced from obfuscated code, elements in obfuscated scripts that are to be called by unencoded scripts, and functions in obfuscated code used as callbacks to builtin functions.
                                    <i class="fa  fa-quote-right fa fa-lg"></i>
                                </p>
                                <small>Hany alsamman</small>
                            </blockquote>
                        </div>

                        <form action="" id="magictree" method="post" class="well well-large" style="display: none">
                            @csrf
                        </form>

                        <div class="btn-group" data-toggle="buttons-radio" id="exclude_control_btn" style="display: none">
                            <button id="tree-expand" class="btn btn-primary btn-cons">Expand All</button>
                            <button id="tree-collapse" class="btn btn-cancel btn-cons">Collapse All</button>

                            <div class="btn-group">
                                <button id="tree-select-all" class="btn btn-primary btn-cons">Select all</button>
                                <button id="tree-deselect-all" class="btn btn-cancel btn-cons">Deselect all</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="settings" class="tab-pane">
<div class="row">
<div class="col-md-12">
<div class="grid simple transparent">
<div class="grid-title">
    <h4>Application <span class="semi-bold">Settings</span> <span class="number-page"></span></h4>

    <div class="tools"><a href="javascript:;" class="collapse"></a>
        <a href="#grid-config" data-toggle="modal" class="config"></a>
        <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>
    </div>
</div>
<div class="grid-body">
<div class="row">
<!-- FORM -->
<form id="project_encrypt" method="post" action="{{URL::route('bye')}}">
@csrf
<div id="rootwizard" class="col-md-12">
<div class="form-wizard-steps">
    <ul class="wizard-steps">
        <li class="" data-target="#step1"><a href="#tab1" data-toggle="tab">
                <span class="step">1</span><span class="title">General</span></a>
        </li>
        <li data-target="#step2" class=""><a href="#tab2" data-toggle="tab">
                <span class="step">2</span><span class="title">Exclusion</span></a>
        </li>
        <li data-target="#step3" class=""><a href="#tab3" data-toggle="tab">
                <span class="step">3</span><span class="title">Encoding and Obfuscation</span></a></li>
        <li data-target="#step4" class=""><a href="#tab4" data-toggle="tab">
                <span class="step">4</span><span class="title">Optimization and Lock</span></a></li>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="tab-content transparent">
<div class="tab-pane" id="tab1">

    <div class="grid simple">
        <div class="grid-title">
            <br><h4 class="semi-bold">Step 1 - Project <span class="light">Information</span></h4>
        </div>
        <div class="grid-body">
            <div class="row-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="controls">
                                    <span class="help">Project title</span>
                                    <input type="text" style="border: 1px solid #cecece" placeholder="Project title" name="project_title" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="controls">
                                    <span class="help">Creation date</span>
                                    <input type="text" disabled="disabled" class="form-control" placeholder="{{{date('Y-m-d')}}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">

                            <div class="row-fluid margin-top-20">
                                <div class="radio radio-default">
                                    <h4>PDF <span class="semi-bold">Report</span> <small><code>Bring a PDF report</code></small>
                                        <input id="checkbox1" name="PDF_Report" type="radio" value="1">
                                        <label for="checkbox1">Yes</label>

                                        <input id="checkbox2" name="PDF_Report" type="radio"  value="0">
                                        <label for="checkbox2">No</label>
                                    </h4>
                                </div>
                            </div>

                            <div class="row-fluid margin-top-20">
                                <div class="radio radio-default">
                                    <h4>Scan <span class="semi-bold">Sub Folders</span> <small><code>Recursive Scan</code></small>
                                        <input id="RecursiveScan1" name="RecursiveScan" type="radio" value="1">
                                        <label for="RecursiveScan1">Yes</label>

                                        <input id="RecursiveScan" name="RecursiveScan" type="radio"  value="0">
                                        <label for="RecursiveScan">No</label>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="tab-pane" id="tab2"><br>

    <div class="grid simple">
        <div class="grid-title">
            <h4 class="semi-bold">Step 2 - <span class="light">Exclusion</span></h4>
        </div>
        <div class="grid-body">
            <div class="row-fluid">
                <div class="row">
                    <div class="row col-md-12">
                        <div class="col-md-6" id="exclude_functions">
                                <div><p>Nothing to exclude</p></div>
                        </div>
                        <div class="col-md-6" id="exclude_vars">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="tab-pane" id="tab3"><br>

    <div class="grid simple">
        <div class="grid-title">
            <h4 class="semi-bold">Step 3 - <span class="light">Encoding and Obfuscation methods</span></h4>
        </div>
        <div class="grid-body">
            <div class="row-fluid">
                <div class="row">
                    <div class="row col-md-12">
                        <ul class="nav nav-pills" id="encoding">
                            <li class="active"><a href="#Obfuscation_tab">Obfuscation</a></li>
                            <li><a href="#Blowfish_tab">Blowfish Encryption</a></li>
                            <li><a href="#Ciphers_tab">Ciphers Encryption</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane" id="Blowfish_tab">

                                <div id='Blowfish' class="tabs-content white-bg">
                                    <div class="accordion open">
                                        <!-- Title -->
                                        <div class="accordion-header">
                                            <p>
                                                (<a target="_blank" href="http://pecl.php.net/package/BLENC">Blenc</a>) is an extension that permit to protect PHP source scripts with Blowfish Encription.<br>
                                            </p>
                                        </div>
                                        <!-- Text -->
                                        <div class="accordion-content">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h3>Blenc <span class="semi-bold">Encryption</span></h3>
                                                    <p>Compress the code of files</p>
                                                    <div class="row-fluid">
                                                        <div class="radio radio-default">
                                                            <input id="checkbox3" name="blenciT" type="radio" value="1">
                                                            <label for="checkbox3">Enable</label>

                                                            <input id="checkbox4" name="blenciT" type="radio"  value="0">
                                                            <label for="checkbox4">Disable</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <h3>Blenc <span class="semi-bold">Report</span></h3>
                                                    <p>Export PDF report</p>
                                                    <div class="row-fluid">
                                                        <div class="radio radio-default">
                                                            <input id="checkbox5" name="BLENC_Report" type="radio" value="1">
                                                            <label for="checkbox5">Yes</label>

                                                            <input id="checkbox6" name="BLENC_Report" type="radio"  value="0">
                                                            <label for="checkbox6">No</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <h3>Extra <span class="semi-bold">Copy</span></h3>
                                                    <p>Save encoded files in extra folder</p>
                                                    <div class="row-fluid">
                                                        <div class="radio radio-default">
                                                            <input id="extra_blenc1" name="extra_blenc" type="radio" disabled value="1" checked>
                                                            <label for="extra_blenc1">Yes</label>

                                                            <input id="extra_blenc2" name="extra_blenc" type="radio" disabled  value="0">
                                                            <label for="extra_blenc2">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="margin-top-20 col-md-10">
                                                    <p>Set your key (<b>unencrypt key</b>) or <a href="#" class="generate_key">Generate new one</a></p>
                                                    <input TYPE="text" style="border: 1px solid #cecece; width: 300px;" class="unencrypted_key" NAME="unencrypted_key"  VALUE="{{ md5(time()) }}">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="Ciphers_tab">

                                <div id='Ciphers' class="tabs-content white-bg">
                                    <div class="accordion open">
                                        <!-- Title -->
                                        <div class="accordion-header">
                                            <p>
                                                Ciphers Encryption (<a target="_blank" href="http://php.net/manual/en/mcrypt.ciphers.php">mcrypt</a>) , a cipher (or cypher) is an algorithm for performing encryption or decryption
                                            </p>
                                        </div>
                                        <!-- Text -->
                                        <div class="accordion-content">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h3>Framework <span class="semi-bold">(Laravel)</span></h3>
                                                    <p>Compress the code of files</p>
                                                    <div class="row-fluid">
                                                        <div class="radio radio-default">
                                                            <input id="ciphers1" name="ciphers" type="radio" value="fw">
                                                            <label for="ciphers1">Enable</label>

                                                            <input id="ciphers2" name="ciphers" type="radio"  value="0">
                                                            <label for="ciphers2">Disable</label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <h3>None Framework <span class="semi-bold">(Native PHP)</span></h3>
                                                    <p>Compress the code of files</p>
                                                    <div class="row-fluid">
                                                        <div class="radio radio-default">
                                                            <input id="ciphers3" name="ciphers" type="radio" value="none">
                                                            <label for="ciphers3">Enable</label>

                                                            <input id="ciphers4" name="ciphers" type="radio"  value="0">
                                                            <label for="ciphers4">Disable</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="margin-top-20 col-md-10">
                                                    <p>Set your key (<b>unencrypt key</b>) or <a href="#" class="generate_key">Generate new one</a></p>
                                                    <input TYPE="text" style="border: 1px solid #cecece; width: 300px;" class="cipher_key" NAME="cipher_key" VALUE="{{ md5(time()) }}">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane active" id="Obfuscation_tab">
                                <div class="row">
                                    <h3>Obfuscation (Scrambler) <span class="semi-bold">Types</span></h3>
                                    <br>
                                    <div class="row-fluid">
                                        <div class="checkbox check-danger checkbox-circle">
                                            <input id="checkbox7" name="ReplaceClasses" type="checkbox" value="1">
                                            <label for="checkbox7">Classes</label>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="checkbox check-success checkbox-circle">
                                            <input id="checkbox8" name="ReplaceFunctions" type="checkbox" value="1" >
                                            <label for="checkbox8">Functions</label>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="checkbox check-primary checkbox-circle" >
                                            <input id="checkbox9" name="ReplaceVariables" type="checkbox" value="1">
                                            <label for="checkbox9">Variables</label>
                                        </div>
                                    </div>

                                    <div class="row-fluid">
                                        <h4>Toady <span class="semi-bold">Note</span></h4>
                                        <ul class="bold">
                                            <li><span class="normal">excluding a function will also disable obfuscation of any local variables within that function.</span></li>
                                            <li><span class="normal">excluding a class name will exclude just the name of the class from being obfuscated and not any <i>contents</i> of the class such as methods.</span></li>
                                            <li><span class="normal">for security reasons, excluding a method name will exclude it from being obfuscated in all classes having a method of the same name, which avoids needing a reversible obfuscation technique.</span></li>
                                            <li><span class="normal">variable assignment (e.g. $$keyName = $value) may not work as expected if local variable obfuscation is used. Excluding the function from being obfuscated where such assignments are used will handle this case.</span></li>
                                        </ul>
                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
<div class="tab-pane" id="tab4"><br>
    <h4 class="semi-bold">Step 4 - Code <span class="light">Optimization and Lock</span></h4>
    <br>

    <ul class='nav nav-pills' id="optimization_lock">
        <li class="active"><a href='#Optimization'>Optimization</a></li>
        <li><a href='#Lock'>Lock Options</a></li>
        <li><a href='#Copyright'>Copyright</a></li>
    </ul>

    <div class="tab-content">

        <div id='Optimization' class="tab-pane white-bg active">
            <div class="accordion open">
                <!-- Title -->
                <div class="accordion-header">
                    <h4 class="semi-bold">Optimization <span class="light">options</span></h4>
                    <br>
                </div>
                <!-- Text -->
                <div class="accordion-content">
                    <div class="row opt_boxs">

                        <div class="col-sm-3">
                            <div class="checkbox check-primary">
                                <input id="RemoveComments" name="RemoveComments" type="checkbox" value="1">
                                <label for="RemoveComments">Comment removal</label>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="checkbox check-success">
                                <input id="RemoveIndents" name="RemoveIndents" type="checkbox" value="1">
                                <label for="RemoveIndents">Indents</label>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="checkbox check-info">
                                <input id="ConcatenateLines" name="ConcatenateLines" type="checkbox" value="1">
                                <label for="ConcatenateLines">Returns</label>
                            </div>
                        </div>
                    </div>

                    <div class="row margin-top-20">
                        <div class="col-sm-3">
                            <div class="checkbox check-info">
                                <input id="compact_code" name="compact_code" type="checkbox" value="1">
                                <label for="compact_code">Compact Code <code>BETA</code></label>
                                <p><small>Eliminating comments, white spaces and empty lines</small></p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox check-info">
                                <input id="RemoveWhite" name="RemoveWhite" type="checkbox" value="1">
                                <label for="RemoveWhite">WhiteSpaces <span class="semi-bold"></span></label>
                            </div>
                            <input class="form-control input-sm" value="" type="text" name="KeptCommentCount" placeholder="(Always preserve first two comments)">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id='Lock' class="tab-pane white-bg">
            <div class="accordion open">
                <!-- Title -->
                <div class="accordion-header">
                    <h4 class="semi-bold">Lock <span class="light">Options</span></h4>
                    <br>
                </div>
                <!-- Text -->
                <div class="accordion-content">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="checkbox check-info">
                                <input id="blenciT" name="blenciT" type="checkbox" value="1">
                                <label for="blenciT">Use <span class="semi-bold">Laravel</span> Framework Crypt</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox check-info">
                                <input id="gzip_encode" name="gzip_encode" type="checkbox" value="1">
                                <label for="gzip_encode">Stop <span class="semi-bold">non-programmers</span><code>base64_decode($code)</code></label><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id='Copyright' class="tab-pane white-bg">
            <div class="row">
                <div class="col-sm-10">
                    <div class="checkbox check-info">
                        <input id="CopyrightPHP" name="CopyrightPHP" type="checkbox" value="1">
                        <label for="CopyrightPHP">Copyright <span class="semi-bold">Comment</span><code>(to put on top of every processed file)</code></label><br>
                    </div>
                    <div class="row-fluid">
                        <textarea name="CopyrightText" class="input-large" style="width: 80%; height: 150px" placeholder="/** Your Comments */"></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<ul class=" wizard wizard-actions">
    <li class="previous pull-left"><a href="javascript:;" class="btn">&nbsp;&nbsp;Previous&nbsp;&nbsp;</a>
    </li>
    <li class="next pull-left"><a href="javascript:;" class="btn btn-primary">&nbsp;&nbsp;Next&nbsp;&nbsp;</a>
    </li>

    <li class="next last pull-right"><a href="javascript:;" class="btn btn-primary">&nbsp;&nbsp;Last&nbsp;&nbsp;</a>
    </li>
    <li class="previous first pull-right"><a href="javascript:;" class="btn">&nbsp;&nbsp;First&nbsp;&nbsp;</a>
    </li>

    <li class="finish"><a href="javascript:;" class="btn btn-success btn-cons ">
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
            <div class="display_result"></div>
        </div>
    </div>
</div>

</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="process_files" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">
                    <i class="fa fa-tachometer fa fa-2x"></i> <span class="semi-bold">Your Files </span> under <span class="semi-bold">processing</span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="progress progress-striped active progress-large">
                    <div id="process_value" data-percentage="0%" style="width: 50%;" class="progress-bar progress-bar-success"></div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" disabled="disabled" class="btn btn-cancel" data-dismiss="modal">Please wait...</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">
                    <i class="fa fa-upload fa fa-2x"></i> <span class="semi-bold">Upload </span> your <span class="semi-bold">files</span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12 single-colored-widget">
                    <div class="content-wrapper purple ">
                        <h3 class="text-white uploader_area">
                            <i class="fa fa-cloud-upload fa fa-2x custom-icon-space" id="icon-resize"></i> <span class="semi-bold">Upload </span> your <spanclass="semi-bold">files</span></h3>

                        <p>Support zip, php, js</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="heading">
                        <div class="pull-left">
                            <div class="pull-left">
                                <div id="fileuploader">Browse</div>
                            </div>
                            <div class="clearfix"></div>
                            <p></p>
                            <div class="pull-right">
                                <p>
                                    <a class="btn btn-primary" id="startUpload" href="">Start</a>
                                    <a class="btn btn-cancel" data-dismiss="modal" aria-hidden="true" href="">Close</a>
                                </p>
                            </div>
                        </div>
                        <div class="pull-right"><span class="small-text muted">v<span class="semi-bold">1.0.0</span></span></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.modal -->

<script src="{{asset('assets/admin/plugins/boostrap-form-wizard/js/jquery.bootstrap.wizard.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/form_validations.js')}}" type="text/javascript"></script>

<script>

    $(document).ready(function () {
        //$("body").toggleMenu();
        //$("body").condensMenu();
        $('#layout-condensed-toggle').trigger('click');

        $('.grid .tools a.reload').on('click', function () {
            $('#check_syntax').empty();
            var el = jQuery(this).parents(".grid");
            blockUI(el);
            window.setTimeout(function () {
                unblockUI(el);
            }, 1000);
        });

        $('#compact_code').on('change', function () {
            if($('#compact_code').is(':checked')){
                //var opt_boxs = $('#ConcatenateLines, #RemoveIndents, #RemoveComments, #RemoveWhite');
                $(".opt_boxs input[type=checkbox]").each(function(){
                    if($(this).attr('id') != 'compact_code'){
                        $("input[name="+$(this).attr('id')+"]").removeAttr("checked").addClass("disabled").attr("disabled","true");
                    }
                });
                $("input[name=RemoveWhite]").removeAttr("checked").addClass("disabled").attr("disabled","true");

            }else{
                $('#ConcatenateLines, #RemoveIndents, #RemoveComments, #RemoveWhite').removeClass('disabled').removeProp("disabled");
            }
        });

    });

    $(function() {
        $('ul.nav-pills li a').on('click', function (e) {
            //save the latest tab; use cookies if you like 'em better:
            $.cookie('lastTab',  $(e.target).attr('href'));
        });

        //go to the latest tab, if it exists:
        var lastTab = $.cookie('lastTab');

        if (lastTab) {
            $('a[href="'+lastTab+'"]').click();
        }
    });



</script>

@endsection
