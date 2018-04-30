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

        View::share('h1', 'Знакомства для серьезных отношений и секса обсалютно бесплатно!');
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
        View::share('events', $events);
        View::share('messages_count', $user->getUnreadMessages());
    }

}
