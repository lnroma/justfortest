<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 01.02.18
 * Time: 21:10
 */

namespace App\Model\User\Conversation;

use App\Model\User\Conversation as ConversationModel;

trait Conversation {

    /**
     * get all user conversations
     * @return mixed
     */
    public function getAllConversations()
    {
        return ConversationModel::getMyConversations($this);
    }

    /**
     * get unread messages count
     * @return int|mixed
     */
    public function getUnreadMessages()
    {
        $conversations = ConversationModel::getMyConversations($this);
        /** @var Conversation $_conversation */
        $messagesCount = 0;
        foreach ($conversations as $_conversation) {
            $messagesCount += $_conversation->getUnreadMessageCount($this);
        }
        return $messagesCount;
    }

}