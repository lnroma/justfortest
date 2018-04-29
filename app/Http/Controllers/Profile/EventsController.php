<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 13.02.18
 * Time: 23:48
 */
namespace  App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Notifications\UserInvoice;
use App\User;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
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
        $myProfile = Auth::user();
//        $myProfile->notify(new UserInvoice([
//                'type' => UserInvoice::TYPE_ADD_BLOG,
//                'data' => ['test' => 'testing', 'message' => 'message']
//            ]
//        ));
        /** @var DatabaseNotification $notify */
//        foreach ($myProfile->notifications as $notify) {
//            dd($notify->getAttribute('data')['type']);
//        }
//        var_dump($myProfile->notifications->count());die;
        return view('profile/events')
            ->with('profile', $myProfile)
            ;
    }

}