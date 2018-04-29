<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SeoVariables
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        View::share('h1', 'Это просто переменная');
        // set counts badge
        $this->_badgeGenerator();
        return $next($request);
    }

    protected function _badgeGenerator()
    {
        $events = null;
        $messages = null;

        if(Auth::guest()) {
            View::share('events', $events);
            View::share('messages_count', $messages);
            return;
        }

        /** @var User $user */
        $user = Auth::user();
//        var_dump($user->getUnreadMessages());die;
        View::share('events', $events);
        View::share('messages_count', $user->getUnreadMessages());
    }

}
