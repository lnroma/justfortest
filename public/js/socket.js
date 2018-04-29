
var socket = window.appSocket;

function sendMessageToUser(idElement) {
    socket.send('sendMessageToUser', $(idElement).value);
}

function checkCondition() {
    socket.send('getUserCondition', '');
}

function checkMessage() {
    var conversationId = $('#conversation_id').val();
    socket.send(
        'updateMessageConversation',
        {
            conversation_id: conversationId
        }
    );
}

$('#send-message').on('click', function (event) {
    event.preventDefault();
    var msg = $('#message').val();
    var conversationId = $('#conversation_id').val();

    socket.send('sendMessageToUser', {
        msg: msg,
        conversation_id: conversationId
    });

    $('#message').val('');
});

setInterval(function run() {
    checkCondition();
    checkMessage();
}, 1000);

socket.on('newMessage', function (newMessage) {
    var data = JSON.parse(newMessage);

    if(data.command == 'condition_information') {
        $('.js-message-count').text(data.result);
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