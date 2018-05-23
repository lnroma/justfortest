<?php

namespace App\Listeners;

use App\Model\User\Conversation;
use App\Model\User\Conversation\Message;
use App\User;
use Codemash\Socket\Events\Event;
use Codemash\Socket\Events\MessageReceived;
use Codemash\Socket\Events\ClientConnected;
use Codemash\Socket\Events\ClientDisconnected;
use Illuminate\Support\Facades\View;

//use Illuminate\View\View;


//use Conversation;

class MessageEventListener
{
    protected $users = [];
    protected $clients = [];

    protected function _pushUsersToConnected(Event $event)
    {
        foreach ($event->clients as $_client) {
            if ($_client->authed()) {
                $this->users[$_client->getUser()->id] = $_client->getUser();
                $this->clients[$_client->getUser()->id] = $_client;
            }
        }
        return $this->users;
    }

    public function __construct()
    {
        // send condition to users

//        while (true) {
//            foreach ($this->users as $userId => $user) {
//                $this->_updateUserCondition($this->clients[$userId], $user);
//                $this->_updateMessageConversation($this->clients[$userId], $user);
//            }
//        }
    }

    protected function _updateUserCondition($client, $user)
    {
        $result = [
            'command' => 'get_condition',
            'unread_messages' => $user->getUnreadMessages(),
            'unread_events' => $user->getEvent
        ];
        $client->send('newMessage', json_encode($result));
    }

    protected function _removeUsersFromConnected(Event $event)
    {
        //@todo remove clients from array if disconnected
    }

    public function onMessageReceived(MessageReceived $event)
    {
        $message = $event->message;
        // If the incomming command is 'sendMessageToOthers', forward the message to the others.
        // get auth users
        if ($message->command === 'getUserCondition') {
            $messageData = (array)$message->data;
            $user = User::find($messageData['user_id']);
            $this->_updateUserCondition(
                $this->clients[$messageData['user_id']],
                $user
            );
        } elseif ($message->command == 'renderMyMessage') {
            $messageData = (array)$message->data;
            $user = User::find($messageData['user_id']);
            $this->_updateMessageConversation(
                $this->clients[$messageData['user_id']],
                $user
            );
        } elseif ($message->command === 'getMessage') {
            // todo message
        } elseif ($message->command === 'sendMessageToUser') {
            // send message to conversation
            $this->_sendMessageToUser($message);
        } elseif ($message->command === 'checkUserMessage') {

        } elseif ($message->command === 'updateMessageConversation') {
            // check new message in conversation and update this conversation
//              $this->_updateMessageConversation($authClients, $message, $users);
        }

        if ($message->command === 'sendMessageToOthers') {
            // To get the client sending this message, use the $event->from property.
            // To get a list of all connected clients, use the $event->clients pointer.
            $others = $event->allOtherClients();
            foreach ($others as $client) {
                // The $message->data property holds the actual message
                $client->send('newMessage', $message->data);
            }
        }
    }

    public function onConnected(ClientConnected $event)
    {
        // если подконектился шлем
        $this->_pushUsersToConnected($event);
    }

    public function onDisonnected(ClientDisconnected $event)
    {
        $this->_removeUsersFromConnected($event);
    }

    /**
     * update message conversation if users lock this conversation
     *
     * @param $authClients
     * @param $message
     * @param $users User
     */
    protected function _updateMessageConversation($authClient, $user)
    {
        /** @var Conversation $conversation */
        $conversation = Conversation::getMyConversations($user);

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
     * @param $authClients
     * @param $message
     * @param $users User
     */
    protected function _checkUserMessage($authClients, $message, $users)
    {
        $getConversations = $users->getAllConversations();
        /** @var Conversation $_conversation */
        foreach ($getConversations as $_conversation) {
            $_conversation->getUnreadMessageCount();
//            $_conversation->getLastMessage();
//            $_conversation->getLastMessage();
        }
        $unreadMessages = $users->getUnreadMessages();
    }
    /**
     * send message by socket
     * @param $authClients
     * @param $message
     * @param $users
     */
    protected function _sendMessageToUser(\Codemash\Socket\Message $message)
    {
        $messageData = (array)$message->data;
        $user = User::find($messageData['user_id']);
        $conversation = Conversation::find($messageData['conversation_id']);
        $message = new Message();
        $message->conversation_id = $conversation->id;
        $message->user_from = $user->id;
        $message->user_to = $conversation->getInterlocutor($user)->id;
        $message->message = $messageData['msg'];
        $message->is_read = 0;
        $message->save();
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
            'Codemash\Socket\Events\MesstageReceived',
            'App\Listeners\MessageEventListener@onMessageReceived'
        );

        $events->listen(
            'Codemash\Socket\Events\ClientDisconnected',
            'App\Listeners\MessageEventListener@onDisconnected'
        );

    }
}