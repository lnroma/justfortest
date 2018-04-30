<?php

namespace App\Http\Controllers;

use App\Model\User\Attribute;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::addFilterAttribute('sex', $request->get('sex'))
        ->addFilterAttribute('city', $request->get('city'))
            ->orderBy('updated_at', 'desc')
        ->paginate(9);

        $filters = Attribute::where('show_in_filters', '=', 1)->get();
        return view('home')
            ->with('filters', $filters)
            ->with('users', $users);
    }
    
}
