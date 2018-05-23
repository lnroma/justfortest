var socket = window.appSocket;

function sendMessageToUser(idElement) {
    socket.send('sendMessageToUser', $(idElement).value);
}

function checkCondition() {
    socket.send('getUserCondition', '');
}

function checkMessage() {
    var conversationId = $('#conversation_id').val();

    if(conversationId == undefined) {
        return;
    }

    socket.send(
        'updateMessageConversation',
        {
            user_id:$('#user_id').valid(),
            conversation_id: conversationId
        }
    );
}

$(document).ready(function () {
    $('.js-send-message').on('click', function (event) {
        event.preventDefault();
        var msg = $('#message').val();
        var user_id = $('#user_id').val();
        var conversationId = $('#conversation_id').val();
        socket.send('sendMessageToUser', {
            msg: msg,
            user_id: user_id,
            conversation_id: conversationId
        });
        $('#message').val('');
    });
});

setInterval(function run() {
    checkCondition();
    checkMessage();
}, 1000);

socket.on('newMessage', function (newMessage) {
    var data = JSON.parse(newMessage);

    if(data.command == 'get_condition') {
        $('.js-message-count').text(data.unread_messages);
    }

    if(data.command == 'update_message') {
        if($('#messages')) {
            if(data.need_update == true) {
                $('#messages').html(data.html);
            }
        }
    }
});


socket.connect(function () {
    // The socket is connected.
});