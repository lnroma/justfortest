<?php

namespace App\Listeners;

use App\Model\User\Conversation;
use App\Model\User\Conversation\Message;
use App\User;
use Codemash\Socket\Events\MessageReceived;
use Codemash\Socket\Events\ClientConnected;
use Codemash\Socket\Events\ClientDisconnected;
use Illuminate\Support\Facades\View;

//use Illuminate\View\View;


//use Conversation;

class MessageEventListener
{

    public function onMessageReceived(MessageReceived $event)
    {
        $message = $event->message;
        // If the incomming command is 'sendMessageToOthers', forward the message to the others.
        // get auth user
        $user = null;
        $authClient = null;
        foreach ($event->clients as $_client) {
            if ($_client->authed()) {
                $user = $_client->getUser();
                $authClient = $_client;
            }
        }

        if ($message->command === 'getCondition') {
            /** @var User $user */
            $result = [
                'command' => 'get_condition',
                'unread_messages' => $user->getUnreadMessages(),
                'unread_events' => $user->getEvent
            ];

            $authClient->send('newMessage', json_encode($result));
        } elseif ($message->command === 'getMessage') {
            // todo message
        } elseif ($message->command === 'sendMessageToUser') {
            // send message to conversation
            $this->_sendMessageToUser($authClient, $message, $user);
        } elseif ($message->command === 'checkUserMessage') {

        } elseif ($message->command === 'updateMessageConversation') {
            // check new message in conversation and update this conversation
            $this->_updateMessageConversation($authClient, $message, $user);
        }

        if ($message->command === 'sendMessageToOthers') {
            // To get the client sending this message, use the $event->from property.
            // To get a list of all connected clients, use the $event->clients pointer.
            $others = $event->allOtherClients();
            foreach ($others as $client) {
                // The $message->data property holds the actual message
//                var_dump($message->data);
                $client->send('newMessage', $message->data);
            }
        }
    }

    public function onConnected(ClientConnected $event)
    {
        // Not used in this example.
    }

    public function onDisonnected(ClientDisconnected $event)
    {
        // Not used in this example.
    }

    /**
     *
     * update message conversation if user lock this conversation
     *
     * @param $authClient
     * @param $message
     * @param $user User
     */
    protected function _updateMessageConversation($authClient, $message, $user)
    {
        $messageData = (array)$message->data;
        /** @var Conversation $conversation */
        $conversation = Conversation::find($messageData['conversation_id']);

        $isNeedUpdate = $conversation->getUnreadMessageCount($user) > 0;

        $htmlConversation = View::make('messages/conversation')
            ->with('conversation', $conversation)
            ->with('authUser', $user)
            ->renderSections();

        $result = [
            'command' => 'update_message',
            'need_update' => $isNeedUpdate,
            'html' => $htmlConversation['message']
        ];

        $conversation = null;
        $authClient->send('newMessage', json_encode($result));
    }

    /**
     * @param $authClient
     * @param $message
     * @param $user User
     */
    protected function _checkUserMessage($authClient, $message, $user)
    {
        $getConversations = $user->getAllConversations();
        /** @var Conversation $_conversation */
        foreach ($getConversations as $_conversation) {
            $_conversation->getUnreadMessageCount();
//            $_conversation->getLastMessage();
//            $_conversation->getLastMessage();
        }
        $unreadMessages = $user->getUnreadMessages();
    }
    /**
     * send message by socket
     * @param $authClient
     * @param $message
     * @param $user
     */
    protected function _sendMessageToUser($authClient, $message, $user)
    {
        $messageData = (array)$message->data;
        $conversation = Conversation::find($messageData['conversation_id']);
        $message = new Message();
        $message->conversation_id = $conversation->id;
        $message->user_from = $user->id;
        $message->user_to = $conversation->getInterlocutor($user)->id;
        $message->message = $messageData['msg'];
        $message->is_read = 0;
        $message->save();

        $htmlConversation = View::make('messages/conversation')
            ->with('conversation', $conversation)
            ->with('authUser', $user)
            ->renderSections();

        $result = [
            'command' => 'update_message',
            'need_update' => true,
            'html' => $htmlConversation['message']
        ];

        $authClient->send('newMessage', json_encode($result));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Codemash\Socket\Events\ClientConnected',
            'App\Listeners\MessageEventListener@onConnected'
        );

        $events->listen(
            'Codemash\Socket\Events\MessageReceived',
            'App\Listeners\MessageEventListener@onMessageReceived'
        );

        $events->listen(
            'Codemash\Socket\Events\ClientDisconnected',
            'App\Listeners\MessageEventListener@onDisconnected'
        );

    }
}