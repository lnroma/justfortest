<?php

namespace App\Model\User\Conversation;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @package App\Model\User\Conversation
 *
 * @property integer $conversation_id
 * @property integer $user_from
 * @property integer $user_to
 * @property integer $is_read
 * @property string $message
 */
class Message extends Model
{

    protected $table = 'user_conversation_messages';

}
