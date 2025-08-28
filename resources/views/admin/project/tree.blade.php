<?php
if(isset($content['classes']['NONE_OOP'])){
    $none_oop = $content['classes']['NONE_OOP'];
    unset ($content['classes']['NONE_OOP']);
}
//echo '<pre>' . print_r($content['classes']) .'</pre>';

?>

<ul class="checkbox-tree-{{$FileKey}} root">

    <li><label>
            <h3><i class="fa fa-file-code-o fa fa-lg"></i> File {{$FileID}}</h3>
            <a href="#" class="tree-select-{{$FileKey}}"><small class="btn btn-primary btn-mini">Check All</small></a>
            <a href="#" class="tree-deselect-{{$FileKey}}"><small class="btn btn-info btn-mini">De-Check All</small></a>
            <a href="#" class="tree-get-{{$FileKey}}"><small class="btn btn-info btn-mini">Save</small></a>
        </label></li>

@foreach($content['classes'] as $key => $val)

    <li><hr /></li>

<li>
    @if(!empty($content['classes_exists']) && in_array("$key", $content['classes_exists']))

</li><li>
        <div class="checkbox check-default">
            <input id="classes_{{$key}}_{{$FileKey}}" type="checkbox" name="classes[]" value="{{$FileID}}">
            <label for="classes_{{$key}}_{{$FileKey}}">
                <span class="badge badge-info">Class</span>
            </label>
        </div>
        <ul class="classes">
            <li>
                <div class="checkbox check-default">
                    <input id="classes_{{$key}}_{{$FileKey}}" type="checkbox" class="" name="classes[]" value="{{$key}}">
                    <label for="classes_{{$key}}_{{$FileKey}}">{{$key}}</label>
                    </span>
                </div>
            </li>
        </ul>
   @endif


    @if(is_array($val) && isset($val['vars']))

    </li><li>
    <div class="checkbox check-default">
        <input id="vars_{{$key}}_{{$FileKey}}" type="checkbox" name="vars[]" value="{{$FileID}}">
        <label for="vars_{{$key}}_{{$FileKey}}">
            <span class="badge badge-info">All Vars</span>
            <span class="badge badge-important">{{count($val['vars'])}}</span>
        </label>
    </div>
    <ul class="vars">
    @foreach($val['vars'] as $var)
        <li>
            <div class="checkbox check-default">
                <input id="vars_{{$var}}_{{$key}}_{{$FileKey}}" type="checkbox" class="" name="vars[]" value="{{$var}}">
                <label for="vars_{{$var}}_{{$key}}_{{$FileKey}}">{{$var}}
                @if(isset($val['existent_vars']) && in_array("$var", $val['existent_vars']))
                    <span class="badge badge-important">Public/Private</span>
                    <span class="badge badge-warning">InUse</span>
                @endif
                </label>
            </span>
            </div>
        </li>
    @endforeach
    </ul>
    @endif

    @if(is_array($val) && isset($val['functions']))

    </li><li>

    <div class="checkbox check-default">
        <input id="function_{{$key}}_{{$FileKey}}" type="checkbox" name="functions" value="{{$FileID}}"/>
        <label for="function_{{$key}}_{{$FileKey}}"><span class="badge badge-info">Functions</span> <span class="badge badge-important">{{count($val['functions'])}}</span></label>
    </div>
    <ul class="functions">
        @foreach($val['functions'] as $function)
        <li>
            <div class="checkbox check-default">
                <input id="function_{{$function}}_{{$key}}_{{$FileKey}}" type="checkbox" class="" name="functions[]" value="{{$function}}">

                <label for="function_{{$function}}_{{$key}}_{{$FileKey}}">{{$function}}
                @if(isset($none_oop) && in_array("$function", $none_oop['functions']))
                <span class="badge badge-important">None OOP</span>
                @endif
                </label>

            </div>
        </li>
        @endforeach
    </ul>
    @endif

</li>

@endforeach
</ul>

<script>

    $('.tree-select-{{$FileKey}}').click(function(){
        $('.checkbox-tree-{{$FileKey}}').tree('checkAll');
        return false;
    });

    $('.tree-deselect-{{$FileKey}}').click(function(){
        $('.checkbox-tree-{{$FileKey}}').tree('uncheckAll');
        return false;
    });

    $('.tree-get-{{$FileKey}}').click(function(){


        $('#myModal-{{$FileKey}}').clone().appendTo("body").modal();
        $('#myModal-{{$FileKey}}').remove();
        $('#myModal-{{$FileKey}}').find('.modal-footer .confirm').on('click', function(){

            var functions_arr = [];
            var classes_arr = [];
            var vars_arr = [];

            $('.checkbox-tree-{{$FileKey}} input[id^="classes_"]:checked').map(function () {

                if($.inArray(this.value, classes_arr) === -1){
                    classes_arr.push(this.value);
                }
                return classes_arr;
            }).get();


            $('.checkbox-tree-{{$FileKey}} input[id^="vars_"]:checked').map(function () {

                if($.inArray(this.value, vars_arr) === -1){
                    vars_arr.push(this.value);
                }
                return vars_arr;
            }).get();

            $('.checkbox-tree-{{$FileKey}} input[id^="function_"]:checked').map(function () {
                if($.inArray(this.value, functions_arr) === -1){
                    functions_arr.push(this.value);
                }
                return functions_arr;
            }).get();

            //full_classes['{{$FileKey}}'] = [];
            //full_classes['{{$FileKey}}']['classes'] = $.makeArray( classes_arr.slice(1));
            //full_classes['{{$FileKey}}']['functions'] = $.makeArray( functions_arr.slice(1));
            //full_classes['{{$FileKey}}']['vars'] =  $.makeArray( vars_arr.slice(1));


            if(functions_arr.length != false){
                $('#project_encrypt div[id="exclude_functions"]')
                    .append('<h4 class="semi-bold">Excluded Functions in <span class="light">'+functions_arr[0]+'</span></h4><input type="text" value="'+functions_arr.slice(1).join(',')+'" class="exclude_fun_'+functions_arr[0]+'" placeholder="" />');

                //$('#project_encrypt input[id^="exclude_fun"]').tagsinput('removeAll');
                $('#project_encrypt input[class="exclude_fun_'+functions_arr[0]+'"]').tagsinput({
                    tagClass: function(item) {
                        return 'badge badge-success'
                    },
                    //typeahead: {
                    //    source: $.merge(
                    //        $('.checkbox-tree-{{$FileKey}} input[id^="function_"]:not(:checked)').map(function () {return this.value;}).get(),
                    //        functions_arr.slice(1)
                    //    ),
                    freeInput: false
                    //}
                });
            }

            if(vars_arr.length != false){
                $('#project_encrypt div[id="exclude_vars"]')
                    .append('<h4 class="semi-bold">Excluded Variables (without $) in <span class="light">'+vars_arr[0]+'</span></h4><input type="text" value="'+vars_arr.slice(1).join(',')+'" data-target="'+vars_arr[0]+'" class="exclude_var_'+vars_arr[0]+'" placeholder="" />');

                //$('#project_encrypt input[id^="exclude_fun"]').tagsinput('removeAll');
                $('#project_encrypt input[class="exclude_var_'+vars_arr[0]+'"]').tagsinput({
                    tagClass: function(item) {
                        return 'badge badge-success'
                    },
                    //typeahead: {
                    //    source: $.merge(
                    //        $('.checkbox-tree-{{$FileKey}} input[id^="vars_"]:not(:checked)').map(function () {return this.value;}).get(),
                    //        vars_arr.slice(1)
                    //    ),
                    freeInput: false
                    //}
                });
            }

            $('input[class^="exclude_"]').on('itemRemoved', function(event) {
                // event.item: contains the item
                alert('cannot change excluded items, this feature still under development');
                $(this).tagsinput('add', event.item);
                return false;
            });

            ExcludeProcess(
                '{{$FileID}}',
                $.makeArray( classes_arr.slice(1)),
                $.makeArray( functions_arr.slice(1)),
                $.makeArray( vars_arr.slice(1))
            );

           // console.log(classes_arr);
           // console.log(vars_arr);
           // console.log(functions_arr);

            var mylabel = $('.checkbox-tree-{{$FileKey}} label h3').clone();

            $('.checkbox-tree-{{$FileKey}}').empty();

            $('.checkbox-tree-{{$FileKey}}').append('<li><label><h3>'+mylabel.html()+'</h3></label></li>');

            $('.checkbox-tree-{{$FileKey}} h3').append(' <span class="badge badge-success"><i class="fa fa-check"></i> Selected items was excluded</span>');

            $('.checkbox-tree-{{$FileKey}}').addClass('ready');

            //close modal
            $('#myModal-{{$FileKey}}').modal('toggle');

            var msg = false;
            var total = $("#magictree ul.root").length;
            var ready = $("#magictree ul.ready").length;

            if($("#magictree ul:has([ready])")){

                msg = $('<div class="alert alert-info"><button data-dismiss="alert" class="close"></button>You have <span class="label label-info">'+ready+'</span> of <span class="label label-info">'+total+'</span> files ready. </div>');
                msg.insertBefore('#magictree').fadeIn('slow');
            }

            if($("#magictree ul").length == $("#magictree ul.ready").length) {
                //All li elements have class selected
                $('#exclude_control_btn').hide();

                $('#settings_popup').removeClass('hide');
                $('#settings_popup').addClass('animated fadeIn');

                $('#tab-4 li:eq(1)').removeClass('disabled');

                msg = $('<div class="alert alert-info"><button data-dismiss="alert" class="close"></button>Total: <a class="link" href="#">'+total+'</a> files ready. </div>');
                msg.insertBefore('#magictree');

                setTimeout(function () {
                    $('#settings_popup').addClass('hide');
                    $('#settings_popup').removeClass('animated fadeIn');
                    $('#settings_popup').addClass('animated fadeOut');
                }, 5000);
            }

        });

        return false;
    });

    $('#tree-save-all').click(function(){

        var mylabel = $('.checkbox-tree-{{$FileKey}} label h3').clone();

        $('[class^="checkbox-tree-"]').empty();
        $('[class^="checkbox-tree-"]').append('<li><label><h3>'+mylabel.html()+'</h3></label></li>');
        $('[class^="checkbox-tree-"] h3').append(' <span class="badge badge-success"><i class="fa fa-check"></i> Selected items was excluded</span>');

        return false;
    });

    function ExcludeProcess(FileID, classes,functions,vars){

        var arrProducts = [];
        var prod = {};
        prod['FileID'] = FileID;
        prod['classes'] = false;
        prod['vars'] = false;
        prod['functions'] = false;

        if($.isArray(classes) && classes.length > 0) prod['classes'] = classes.join(',');
        if($.isArray(vars) && vars.length > 0) prod['vars'] = vars.join(',');
        if($.isArray(functions) && functions.length > 0) prod['functions'] = functions.join(',');

        var excluded = arrProducts.push(prod); //add the product to thearray of products

        $.post( "exclude_process", { excluded: JSON.stringify(arrProducts), FileID: FileID});

        //var data = JSON.stringify(arrProducts);
        //$('#project_encrypt').append('<input type="hidden" name="'+FileID+'" value="'+vars.join(',')+'">');
    }

</script>

<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="myModal-{{$FileKey}}" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">
                    <i class="fa fa-save fa fa-2x"></i> <span class="semi-bold">Save </span> your <span class="semi-bold">settings</span>
                </h4>
            </div>
            <div class="modal-body">
                    Are you sure you want to save your settings for <div class="badge badge-info">{{$FileID}}</div> file ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary confirm">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.modal -->