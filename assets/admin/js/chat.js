$(document).ready(function () {

    var myUserID = $('#user_id').val();
    var chat_users = $('#chat-users');
    var chat_messages = $('.chat-messages');
    var chat_input = $('.chat-message-input');
    var main_chat = $('#main-chat-wrapper');


    $('.user-details-wrapper').click(function () {

        chat_input.autosize();

        chat_input.css('height', '30px');
        var chat_user_id = $(this).attr('data-chat-user');
        set_user_details($(this).attr('data-user-name'), $(this).attr('data-chat-status'));
        $('[id^="messages-"]').attr('id', 'messages-' + chat_user_id);
        chat_messages.empty();
        $('#messages-' + chat_user_id).addClass('animated');
        $('#messages-' + chat_user_id).show();
        chat_users.removeClass('animated');
        chat_users.hide();
        $('.chat-input-wrapper').show();

        getUserConversation(chat_user_id, 6);

    });

    $('.chat-back').click(function () {

        var chat_user_id = $(this).closest('[id^="messages-"]').attr('id');
        //$('#'+chat_user_id+' .chat-messages-header .status').removeClass('online');
        //$('#'+chat_user_id+' .chat-messages-header .status').removeClass('busy');
        $('#' + chat_user_id).hide();
        $('#' + chat_user_id).removeClass('animated');
        chat_users.addClass('animated');
        chat_users.show();
        $('.chat-input-wrapper').hide();

    });

    chat_input.keypress(function (e) {

        var chat_user_id = $('[id^="messages-"]').not(':hidden').attr('id');
        //var post = $.trim($(this).val());

        if (e.keyCode == 13) {
            send_message(chat_user_id, $(this).val());

            $(this).val('').trigger('autosize.resize');
            //$(this).trigger('autosize.destroy');
            $(this).blur();
            $(this).focus();
        }

        main_chat.slimScroll({
            resize: true,
            size: '8px',
            scrollTo: $('[id^="messages-"]').not(':hidden').height() + 'px'
        });

    });

    $(window).setBreakpoints({
        distinct: true,
        breakpoints: [
            320,
            480,
            768,
            1024
        ]
    });
    var eleHeight = window.screen.height;
    eleHeight = eleHeight;

    $(window).setBreakpoints({
        distinct: true,
        breakpoints: [
            320,
            480,
            768,
            1024
        ]
    });
    //Break point entry
    $(window).bind('enterBreakpoint320', function () {
        eleHeight = eleHeight - 20;
    });

    $(window).bind('enterBreakpoint480', function () {
        eleHeight = eleHeight - 20;
    });

    function initChatScroll() {
        var eleHeight = window.innerHeight;
        //console.log(eleHeight);
        main_chat.slimScroll({
            color: '#a1b2bd',
            size: '8px',
            height: eleHeight,
            alwaysVisible: true,
            allowPageScroll: true
        });
    }

    $(window).resize(function () {
        main_chat.slimScroll({resize: true, size: '8px'});
    });
    initChatScroll();


    function set_user_details(username, status) {
        $('.chat-messages-header .status').addClass(status);
        $('.chat-messages-header span').text(username);
    }

    function getUserConversation(id, limit) {

        var user_id = id.replace(/[^\d.]/g, '');

        $.post("/ncryptd/admin/chat/getUserConversation", {user_id: user_id, limit: limit},function (data) {
            var result = jQuery.parseJSON(data);

            chat_messages.prepend($('<div style="cursor: pointer" class="sent_time load_old_msg">Load Earlier Messages</div>'));

            //{"msgID":1,"content":"sfsdf\n","created_at":"2014-05-21 18:32:22","userId":1,"first_name":"hany","avatar":"0"}
            $.each(result, function (index, msg) {

                if(msg == 'empty' || msg.length <= 1){
                    chat_messages.empty();
                    chat_messages.append('<div style="cursor: pointer" class="sent_time">This User isn\'t on Chat right now</div>');
                    return false;
                }

                if (msg.avatar == '0') {
                    msg.avatar = '/ncryptd/assets/admin/img/profiles/avatar_small.jpg';
                }
                if (msg.userId == myUserID) {
                    build_conversation(msg.content, 1, msg.avatar, msg.avatar, msg.created_at);
                } else {
                    build_conversation(msg.content, 0, msg.avatar, msg.avatar, msg.created_at);
                }
            });

        }).done(function () {

            var chat_body_height = $('#messages-' + user_id).height();
            main_chat.slimScroll({
                resize: true,
                size: '8px',
                scrollTo: chat_body_height + 'px'
            });

            $('.bubble').on('click', function () {
                $(this).parent().parent('.user-details-wrapper').children('.sent_time').slideToggle();
            });

            $('.load_old_msg').on('click', function () {
                chat_messages.empty();
                getUserConversation(id, 100);
            });


            var myDate = $(".chat-messages .user-details-wrapper").last().find('.sent_time').clone(true, true).show();
            var getDate = myDate.html().split(' '); //2014-05-24
            $(".chat-messages").append('<div class="sent_time">' + jQuery.timeago('' + getDate[0] + '') + '</div>').css('padding-bottom', '30px');

            main_chat.slimScroll({
                resize: true,
                size: '8px',
                scrollTo: $('[id^="messages-"]').not(':hidden').height() + 'px'
            });

            //$( ".chat-messages .user-details-wrapper" ).last().css('padding-top','10px','padding-bottom','30px');
        });
    }

    function build_conversation(msg, isOpponent, img, retina, date) {
        if (isOpponent == 1) {
            chat_messages.append('<div class="user-details-wrapper">' +
                '<div class="user-details">' +
                '<div class="bubble old sender">' +
                msg +
                '</div>' +
                '</div>' +
                '<div class="user-profile pull-right">' +
                '<img src="' + img + '"  alt="" data-src="' + img + '" data-src-retina="' + retina + '" width="35" height="35">' +
                '</div>' +
                '<div class="clearfix"></div>' +
                '<div class="sent_time off">' + date + '</div>' +
                '</div>');
        }
        else {

            chat_messages.append('<div class="user-details-wrapper">' +
                '<div class="user-profile">' +
                '<img src="' + img + '"  alt="" data-src="' + img + '" data-src-retina="' + retina + '" width="35" height="35">' +
                '</div>' +
                '<div class="user-details">' +
                '<div class="bubble">' +
                msg +
                '</div>' +
                '</div>' +
                '<div class="clearfix"></div>' +
                '<div class="sent_time off">' + date + '</div>' +
                '</div>');

        }
    }

    function send_message(id, msg) {

        var send_to = id.replace(/[^\d.]/g, '');

        msg = linkify(msg);

        $.post("/ncryptd/admin/chat/addMessageToConversation", {user_id: send_to, msg: msg },function (data) {

        }).done(function (data) {

            var img = $(".profile-pic").clone();
            // var img = $('[data-chat-user*='+myUserID+']').attr('data-chat-user-pic');

            $('#' + id + ' .chat-messages').append('<div class="user-details-wrapper animated fadeIn">' +
                '<div class="user-details">' +
                '<div class="bubble old sender">' +
                msg +
                '</div>' +
                '</div>' +
                '<div class="user-profile pull-right">' +
                img.html() +
                '</div>' +
                '<div class="clearfix"></div>' +
                '<div class="sent_time off">' + $.now() + '</div>' +
                '</div>');

            //$( ".chat-messages .user-details-wrapper" ).last().css('padding-bottom','30px');

            chat_input.autosize().show().val('').trigger('autosize.resize');

            main_chat.slimScroll({
                resize: true,
                size: '8px',
                scrollTo: $('[id^="messages-"]').not(':hidden').height() + 'px'
            });


        }).fail(function () {

            $('#' + id + ' .chat-messages').append('<div class="user-details-wrapper animated fadeIn">' +
                '<div class="user-details">' +
                '<div class="bubble old sender">Message not sent :(' +
                '</div>' +
                '</div>' +
                '<div class="clearfix"></div>' +
                '</div>');
        });

    }

    function linkify(inputText) {
        var replacedText, replacePattern1, replacePattern2, replacePattern3;

        //URLs starting with http://, https://, or ftp://
        replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
        replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

        //URLs starting with "www." (without // before it, or it'd re-link the ones done above).
        replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
        replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

        //Change email addresses to mailto:: links.
        replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
        replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

        return replacedText;
    }

    function updateOnline(){
        $.post("/ncryptd/admin/chat/getOnline", function (data) {
            $('#sidr .side-widget-content').html(data);
        });
    }

});

