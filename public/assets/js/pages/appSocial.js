/*
 *  Document   : appSocial.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Social Net page
 */

var AppSocial = function() {

    /*
     * Chat Widget Functionality
     */
    var authUser  = $.parseJSON($('meta[name="auth-user"]').attr('content'));
    var receptorUser = '';
    var chatTalk  = $('.chatui-talk');
    var chatForm  = $('.chatui-form');
    var chatInput = $('#chat-message');
    var chatMsg   = '';

    var newElementChat = function(user){
        return "<li id='li-chat-user-" + user.id + "' >"+
                "<a href='javascript:void(0)' id='chat-user-" + user.id + "' class='chat-user' data-user-messages='[]' data-user='" + JSON.stringify(user) + "'>" +
                    "<img src='" + user.image + "' alt='image' class='nav-users-avatar'>" +
                    "<span class='label label-success nav-users-indicator'></span>" +
                    "<span class='nav-users-heading'>" + user.name + "</span>" +
                    "<span class='text-muted'>" + user.type_name + "</span>" +
                "</a>" + 
            "</li>";
    };

    var newMessageHtml = function(chatMsg, time, avatar){
        return '<li class="chatui-talk-msg chatui-talk-msg animation-expandUp">'
        + '<img src="' + avatar + '" alt="Avatar" class="img-circle chatui-talk-msg-avatar">'
        + $('<div />').text(chatMsg).html()
        + '<span class="text-info h6"> - ' + time + '</span>'
        + '</li>';
    };

    var newMyMessageHtml = function(chatMsg){
        return '<li class="chatui-talk-msg chatui-talk-msg-right animation-expandUp">'
        + '<img src="' + authUser.image + '" alt="Avatar" class="img-circle chatui-talk-msg-avatar">'
        + $('<div />').text(chatMsg).html()
        + '</li>';
    };

    var chatMessagesHtml = function(messages) {
        htmlMessages = '';

        $.each(messages, function( index, message ) {
            time = strftime('%H:%M %P', new Date(message.created_at));

            if(message.author_id == authUser.id){
                htmlMessages += newMyMessageHtml(message.text);  
            }
            else{
                htmlMessages += newMessageHtml(message.text, time, receptorUser.image);  
            }
        });

        return htmlMessages;
    }

    // Handle the send button being clicked
    var sendMessage = function(chatMsg) {

        // Build POST data and make AJAX request
        var data = {text: chatMsg, receptor_id: receptorUser.id};
        $.post('/message', data).success(sendMessageSuccess(chatMsg));

        // Ensure the normal browser event doesn't take place
        return false;
    };

    function refreshDataChats (chatMsg, author_id, receptorUserGraficId, created_at) {
        newMessage = {text: chatMsg, author_id: author_id, created_at: created_at};
        collectionMessages = $("#chat-user-" + receptorUserGraficId).data('user-messages');
        collectionMessages.push(newMessage);
        $("#chat-user-" + receptorUserGraficId).data('user-messages', collectionMessages);
    }

    // Handle the success callback
    function sendMessageSuccess(chatMsg) {
        addMyMessage(chatMsg);
        refreshDataChats (chatMsg, authUser.id, receptorUser.id);

        chatInput.val('');
        console.log('message sent successfully');
    }

    // Listener Event Pusher
    var addMessage = function(data){

        if(data.author_id != authUser.id) {
            time = strftime('%H:%M %P', new Date(data.created_at));
            
            if(data.author_id == receptorUser.id){
                chatTalk
                    .find('ul')
                    .append(newMessageHtml(data.text, time, data.author.image));    
            }
            else {
                var indicator = $("#chat-user-" + data.author_id + " .nav-users-indicator").text();
                
                if(!indicator.trim()) {
                    indicator = 0;
                }
                else {
                    indicator = parseInt(indicator);
                }

                $("#chat-user-" + data.author_id + " .nav-users-indicator").text(indicator + 1);
            }

            refreshDataChats (data.text, data.author.id, data.author.id, data.created_at);

            // Scroll the message list to the bottom
            chatTalk
                .animate({
                    scrollTop: chatTalk[0].scrollHeight
                }, 200);

            // Reset the chat input
            chatInput.val('');
        }
    };

    // Listener Event Pusher
    var addMyMessage = function(text){
        chatTalk
            .find('ul')
            .append(newMyMessageHtml(text));

        // Scroll the message list to the bottom
        chatTalk
            .animate({
                scrollTop: chatTalk[0].scrollHeight
            }, 200);

        // Reset the chat input
        chatInput.val('');
    };

    var initEventSideBarChat = function(){
        // Open Chat window
        $('.chat-user').on('click', function(){
            receptorUser = $(this).data('user');
            messages     = $(this).data('user-messages');

            $('.chat-user-name').html(receptorUser.name);
            $('#chat-content').html(chatMessagesHtml(messages));
            $('.chatui').removeClass('chatui-window-close');

            $("#chat-user-" + receptorUser.id + " .nav-users-indicator").text('');

            // Scroll the message list to the bottom
            chatTalk
                .animate({
                    scrollTop: chatTalk[0].scrollHeight
                }, 0);

            // Focus chat input
            chatInput.focus();
        });
    };

    return {
        init: function() {
            
            // Add a message to the chat
            chatForm
                .find('form')
                .submit(function(e){
                    // Get text from chat input
                    chatMsg = chatInput.val();

                    // If the user typed a message
                    if (chatMsg) {
                        sendMessage(chatMsg);    
                    }

                    // Don't submit the message form
                    e.preventDefault();
                });

            // Open Chat window
            $('.chatui-action-open').on('click', function(){
                if($(this).data('user')){
                    $(this)
                        .parents('.chatui')
                        .removeClass('chatui-window-close');

                    // Scroll the message list to the bottom
                    chatTalk
                        .animate({
                            scrollTop: chatTalk[0].scrollHeight
                        }, 0);

                    // Focus chat input
                    chatInput.focus();    
                }
            });

            // Close Chat window
            $('.chatui-action-close').on('click', function(){
                $(this)
                    .parents('.chatui')
                    .addClass('chatui-window-close');
            });

            initEventSideBarChat();

        },
        addMessage: function(data){
            addMessage(data);    
        },
        newLogin: function(user){
            if(authUser.id != user.id){
                elementChat = $("#li-chat-user-" + user.id);    
                if(elementChat.length != 0){
                    elementChat.prependTo('.nav-users-online');
                }
                else{
                    elementChat = newElementChat(user);
                    $('.nav-users-online').prepend($(elementChat));
                    initEventSideBarChat();
                }
            }
            
        },
        newLogout: function(user){
            if(authUser.id != user.id){
                elementChat = $("#li-chat-user-" + user.id);    
                if(elementChat){
                    elementChat.prependTo('.nav-users-offline');
                }
            }
        }
    };
}();