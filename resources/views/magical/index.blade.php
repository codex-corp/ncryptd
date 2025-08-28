@extends('index')
{{-- Web site Title --}}
@section('title')
{{{ Lang::get('site.contact_us') }}}
@parent
@stop

{{-- Content --}}
@section('content')

<style>
    .editable-area {
        background: none repeat scroll 0 0 #EEEEEE;
        border: 3px dashed #AAAAAA;
        clear: both;
        margin: 0px 0px 20px 0;
        padding: 12px;
    }
</style>
<script type="text/javascript">
$( document ).ready(function() {


/**
        $.notification(
            {
                content: "Click on me to try the <strong>callback</strong> function",
                img: "http://store.c4d.dk/n/static/demo/thumb.png",
                icon: "c",
                click:
                    function() {
                        $.notification(
                            {
                                content: 'This notification was just created.',
                                title: 'Callback!',
                                icon: 'http://store.c4d.dk/n/static/demo/thumb.png'
                            }
                        );
                    }
            }
        );
*/

var settings = $("#fileuploader").uploadFile({
    url: "{{ URL::route('upload') }}",
    method: "POST",
    allowedTypes:"zip,php,js",
    fileName: "myfile",
    autoSubmit:false,
    formData: {"_token":"{{ csrf_token() }}"},
    showStatusAfterSuccess:true,
    maxFileCount:44,
    dragdropWidth: 350,
    statusBarWidth:350,
    onSubmit:function(files)
    {
        //$('<div class="alert amber">This is an AMBER warning.<span title="Close" class="close"></span></div>').insertBefore('.contact-form');
    },
    onSuccess:function(files,data,xhr)
    {
        var obj = jQuery.parseJSON(data);

        $.each(obj, function (index, value) {

            $('<div class="editable-area">file added to queue: '+files+'</div>').insertBefore($("#uploader_area"));

            $("#project_encrypt").append( $('<input>').attr({
                type: 'hidden',
                id: 'project_folder',
                name: 'project_folder[]',
                value: index
            }) );

        });

        $("#uploader_area").remove();

        //$("#buttonsmsg").remove();

        //$("#wizard").find("ul[aria-label]").removeAttr("style");
    },
    onError: function(files,status,errMsg)
    {
        alert("Error for: "+JSON.stringify(files));
    }
});

    $("#startUpload").click(function(e)
    {
        e.preventDefault();

        settings.startUpload();
    });

    $("#cleanupload").click(function(e)
    {
        e.preventDefault();

        $(".ajax-file-upload-statusbar").remove();

    });


    $("#wizard").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        //stepsOrientation: "vertical",

        titleTemplate: '<span class="number">#index#.</span> #title#',
        loadingTemplate: '<span class="spinner"></span> #text#',
        /* Labels */
        labels: {
            current: "current step:",
            finish: "Finish",
            next: "Next",
            previous: "Previous",
            loading: "Loading ..."
        },
        onStepChanging: function (event, currentIndex, newIndex) {

            //alert(currentIndex);
            return true;
        },
        onFinished: function (event, currentIndex)
        {

            /**
                var has_file = $(".ajax-file-upload-statusbar").length //check if there files need upload

                if(has_file != false){

                    settings.startUpload();

                        $(document).ajaxStop(function () {
                        $("#comment-form").submit();
                    });
                    //$("#comment-form").submit();
                }
             */

            $("#project_encrypt").submit();

        }
    });

    $(".generate_key").click(function(e){
        e.preventDefault();

        $.generateRandomKey = function(limit) {
            limit = limit || 8;
            var key = '';
            var chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var list = chars.split('');
            var len = list.length, i = 0;
            do {
                i++;
                var index = Math.floor(Math.random() * len);
                key += list[index];

            } while(i < limit);
            return key;
        };

        var number = $.generateRandomKey(32);

        $(".unencrypted_key").attr('value',number);

    });

    //$('<div id="buttonsmsg" class="action-box main"><div class="action-box-text"><h3>Note: buttons will appears after upload an file</h3></div>').insertAfter( $( "ul[aria-label]" ) );

    //$("#wizard").find("ul[aria-label]").css("display","none");


});
</script>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Page Title -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<h1>Start !</h1>

<div id="Mensajes"></div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Title -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Intro -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Intro -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Spacer x 2 -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="spacer"></div>
<div class="spacer"></div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Spacer x 2 -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Left Aligned Icons & Text (Vertically centered) -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="column-container">

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- One Third -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="column-one-third">
        <div class="icons-column vertical-center">
            <!-- Icon Backing -->
            <div class="icon-backing">
                <!-- Icon -->
                <i class="fa">1</i>
            </div>
        </div>
        <div class="content-column vertical-center">
            <!-- Title -->
            <h3 class="no-margin">Obfuscator Settings</h3>
            <!-- Text -->
            <p>Tick what you want to obfuscate it and exclude some of !</p>
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END One Third -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- One Third -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="column-one-third">
        <div class="icons-column vertical-center">
            <!-- Icon Backing -->
            <div class="icon-backing">
                <!-- Icon -->
                <i class="fa">2</i>
            </div>
        </div>
        <div class="content-column vertical-center">
            <!-- Title -->
            <h3 class="no-margin">Encoder Settings</h3>
            <!-- Text -->
            <p>Maybe if we encode it will be more difficult :)</p>
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END One Third -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- One Third -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="column-one-third">
        <div class="icons-column vertical-center">
            <!-- Icon Backing -->
            <div class="icon-backing">
                <!-- Icon -->
                <i class="fa">3</i>
            </div>
        </div>
        <div class="content-column vertical-center">
            <!-- Title -->
            <h3 class="no-margin">Lock and Optimizations</h3>
            <!-- Text -->
            <p>do some optimization and lock your code !</p>
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END One Third -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Left Aligned Icons & Text -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Spacer x 3 -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="spacer"></div>
<div class="spacer"></div>
<div class="spacer"></div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Spacer x 3 -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Contact Form -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="contact-form">

        <div style="width: 35%; float: right">

            <h1>Upload your files</h1>
            <p>Support zip, php, js</p>

            <div style="float: right" id="uploader_area">
                <div id="fileuploader">Upload</div>
                <div class="spacer"></div>
                <a style="float: right" class="button green" id="startUpload" href="">Upload</a>
                <a style="float: right" class="button yellow" id="cleanupload" href="">Clean</a>
                <div class="spacer"></div>
            </div>

        </div>

<form id="project_encrypt" method="post" action="bye" />

<div id="wizard" style="width: 60%; float: left">
    <h2>Obfuscation</h2>
    <!-- <section data-mode="async" data-url="http://www.jquery-steps.com/Examples/AsyncContent"> -->
    <section>

        <h3>Obfuscation</h3>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting.</p>

        <div class="accordion open">
            <!-- Title -->
            <div class="accordion-header">
                Obfuscation (Scrambler) options
            </div>
            <!-- Text -->
            <div class="accordion-content">

                <div style="float: left">
                    <p><input type="checkbox" name="ReplaceClasses" value="1" checked> Classes</p>
                    <p><input type="checkbox" name="ReplaceFunctions" value="1" checked> Functions</p>
                </div>
                <div style="float: left; margin-left: 40px">
                    <p><input type="checkbox" name="ReplaceVariables" value="1" checked> Variables</p>
                    <p><input disabled="disabled" type="checkbox" name="ReplaceConstants" value="0"> Constants soon !</p>
                </div>

                <div style="float: left"><p><input type="checkbox" name="ReplaceRoutes">Routes</p></div>

            </div>
        </div>

        <div class="accordion open">
            <!-- Title -->
            <div class="accordion-header">
                Strong Encoding
            </div>
            <!-- Text -->
            <div class="accordion-content">
                <div style="float: left">
                    <p><input type="checkbox" name="var_encode"> Variables Encoding</p>
                </div>
            </div>
        </div>

        <!-- Textbox
        <input type="text" name="SourceDir" value="" placeholder="Source Directory" />

        <input type="text" name="TargetDir" value="" placeholder="Target Directory" />
        -->

    </section>

    <h2>Exclusion</h2>
    <section>
        <h3>Exclusion</h3>

        <div style="float: left; width: 500px">

            <div>
                <b>Exclude Functions</b>
                <textarea name="CopyrightText" rows="1" cols="1" placeholder="Example: __autoload, __clone" style="width: 100%; height: 50px; font-family: sans-serif"></textarea>
            </div>

            <div>
                <b>Exclude Functions returning objects</b>
                <textarea name="CopyrightText" rows="1" cols="1" placeholder="Example: mysql_query, mysql_result" style="width: 100%; height: 50px; font-family: sans-serif"></textarea>
            </div>

            <div>
                <b>Exclude Variables (without $)</b>
                <textarea name="CopyrightText" rows="1" cols="1" placeholder="Example: config, db" style="width: 100%; height: 50px; font-family: sans-serif"></textarea>
            </div>

            <div>
                <b>Exclude Files</b>
                <textarea name="CopyrightText" rows="1" cols="1" placeholder="Example: header.php, configs.php" style="width: 100%; height: 50px; font-family: sans-serif"></textarea>
            </div>
        </div>

    </section>

    <h2>Encryption</h2>
    <section>

        <h3>Encryption Options</h3>
        <p>aaaaaaaaa</p>

        <ul class='tabs'>
            <li><a href='#Blowfish'>Blowfish Encryption</a></li>
            <li><a href='#Ciphers'>Ciphers Encryption</a></li>
        </ul>

        <div id='Blowfish' class="tabs-content white-bg" >
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
                        <p><input type="checkbox" name="PDF_Report">Blenc Report (PDF)</p>
                    </div>
                    <p>Set your key (<b>unencrypt key</b>) or <a href="#" class="generate_key">Generate new one</a></p>
                    <INPUT TYPE="text" style="width: 300px;" class="unencrypted_key" NAME="unencrypted_key" VALUE="{{ md5(time()); }}">
                </div>
            </div>
        </div>

        <div id='Ciphers' class="tabs-content white-bg" >
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
                        <p><input type="radio" name="ciphers" value="none">None <b>Framework</b> </p>
                    </div>
                    <p>Set your key (<b>unencrypt key</b>) or <a href="#" class="generate_key">Generate new one</a></p>
                    <INPUT TYPE="text" style="width: 300px;" class="cipher_key" NAME="cipher_key" VALUE="{{ md5(time()); }}">
                </div>
            </div>
        </div>

    </section>

    <h2>Lock Code</h2>
    <section>

        <ul class='tabs'>
            <li><a href='#Optimization'>Optimization</a></li>
            <li><a href='#Lock'>Lock</a></li>
            <li><a href='#Copyright'>Copyright</a></li>
        </ul>

        <div id='Lock' class="tabs-content white-bg" >
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
                        <p><input type="checkbox" name="blenciT">Stop non-programmers <b>gzuncompress</b>(<b>base64_decode</b>($code))</p>
                    </div>
                </div>
            </div>
        </div>

        <div id='Optimization' class="tabs-content white-bg" >
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
                        (Always preserve first <INPUT TYPE="text" style="width: 50px;" NAME="KeptCommentCount" VALUE="0"> comments)

                        <p><input type="checkbox" name="RemoveWhite" value="1" checked>WhiteSpaces</p>
                    </div>
                </div>
            </div>
        </div>

        <div id='Copyright' class="tabs-content white-bg" >
            <!-- Message Box -->
            <INPUT TYPE=CHECKBOX NAME="CopyrightPHP" value=1><b>Copyright Text</b> (to put on top of every processed file)<br>
            <textarea name="CopyrightText" placeholder="Message *"></textarea>
        </div>

    </section>

    </div>

    </form>
</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Contact Form -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

@stop
