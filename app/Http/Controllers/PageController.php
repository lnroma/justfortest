<?php

namespace App\Http\Controllers;

use App\Model\User\Attribute;
use App\User;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function register()
    {
        $userAttribute = Attribute::where('show_in_registration', 1)->get();
        return view('auth.register')->with('user_attribute', $userAttribute );
    }

}
