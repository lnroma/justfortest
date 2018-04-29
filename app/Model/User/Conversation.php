<?php

namespace App\Model\User;

use App\Model\User\Conversation\Message;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{

    protected $table = 'user_conversation';

    public function messages()
    {
        return $this->hasMany(
            Message::class,
            'conversation_id',
            'id'
        );
    }

    /**
     * get unread message count
     * @return mixed
     */
    public function getUnreadMessageCount($myUser = null)
    {
        if(!$myUser) {
            $myUser = Auth::user();
        }

        $conversationMessage = Message::where('conversation_id', $this->id)
            ->where('is_read', 0)
            ->where('user_to', $myUser->id)
        ;

        return $conversationMessage->count();
    }

    public function getLastMessage()
    {
        return Message::where('conversation_id', $this->id)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    /**
     * get interlocutor
     * @return mixed
     */
    public function getInterlocutor($myUser = null)
    {
        if(!$myUser) {
            $myUser = Auth::user();
        }

        if($this->one_user == $myUser->id) {
            return User::find($this->two_user);
        } else {
            return User::find($this->one_user);
        }
    }

    public static function loadConversation($userOne, $userTwo)
    {
        $conversation = static::where('one_user', $userOne)->where('two_user', $userTwo);

        // if conversation not find try find another
        if($conversation->count() == 0) {
            $conversation = static::where('one_user', $userTwo)->where('two_user', $userOne);
        }

        // if not find then create conversation
        if($conversation->count() == 0) {
            $newConversation = new self();
            $newConversation->one_user = $userOne;
            $newConversation->two_user = $userTwo;
            $newConversation->save();
            return $newConversation;
        } else {
            /** @var Builder $conversation */
            $conversation = $conversation->first();
            return $conversation;
        }
    }

    /**
     * get my conversations
     * @param User $user
     * @return mixed
     */
    public static function getMyConversations(User $user)
    {
        $conversations = static::where('one_user', $user->id)
            ->orWhere('two_user', $user->id)
            ->orderBy('updated_at', 'desc')
        ;
        return $conversations->get();
    }

}
