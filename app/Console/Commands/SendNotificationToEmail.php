<?php

namespace App\Console\Commands;

use App\Mail\NewMessage;
use App\Model\User\Conversation;
use App\User;
use function foo\func;
use Illuminate\Console\Command;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class SendNotificationToEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:unread_message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification about new message';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $conversation = Conversation\Message::where('is_read', '0')
            ->distinct('user_to')
            ->select('user_to')
            ->get()
        ;

        foreach ($conversation as $_conv) {
            $user = User::find($_conv->user_to);
            if($user && !$user->isOnline()) {
                Mail::to('family_89@mail.ru')->send(new NewMessage($user));
                break;
            }
        }
    }
}
