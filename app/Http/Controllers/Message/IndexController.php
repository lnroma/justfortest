<?php

namespace App\Http\Controllers\Message;

use App\Model\User\Conversation;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    /**
     * check auntification
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // conversations
    }

    public function messages($userId)
    {
        /** @var User $user */
        $user = Auth::user();
        $conversation = Conversation::loadConversation($user->id, $userId);
        return view('messages/conversation')
            ->with('conversations', Conversation::getMyConversations(Auth::user()))
            ->with('conversation', $conversation)
            ->with('authUser', Auth::user());
    }

    /**
     * conversations list
     * @return $this
     */
    public function conversations()
    {
        return view('messages/conversation/list')
            ->with('conversations', Conversation::getMyConversations(Auth::user()));
    }

    public function send($userId, Request $request)
    {
        $user = Auth::user();

        if($user->id == $userId) {
            return redirect()->back()->with('error', 'Вы не можете отправить сообщения сами себе!');
        }
        $conversation = Conversation::loadConversation($user->id, $userId);

        // update conversation
        $conversation->setUpdatedAt(new Carbon());
        $conversation->save();

        $message = new Conversation\Message();
        $message->conversation_id = $conversation->id;
        $message->user_from = $user->id;
        $message->user_to = $userId;
        $message->message = $request->get('message');
        $message->is_read = 0; // unread message
        $message->save();

        return redirect()->back();
    }

}
