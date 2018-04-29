<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 13.02.18
 * Time: 23:48
 */
namespace  App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Model\User\Attribute;
use App\User;
use Illuminate\Http\Request;
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
        $myProfile = Auth::user();
        return view('profile/index')
            ->with('profile', $myProfile)
            ;
    }

    public function view($id)
    {
        $profile = User::find($id);
        return view('profile/view')
            ->with('profile', $profile);
    }

    public function edit()
    {
        $attributes = Attribute::where('show_in_anketa', '=', 1)->get();
        return view('profile/edit')
            ->with('attributes', $attributes)
            ->with('profile', Auth::user());
    }

    public function saveProfile(Request $request)
    {
        $user = Auth::user();

        $attributes = Attribute::where('show_in_anketa', '=', 1)->get();
        $user->setName($request->get('name'));

        foreach ($attributes as $_attribute) {
            $user->setData($_attribute->key, $request->get($_attribute->key));
        }

        if($request->get('birth_day') || $request->get('birth_month') || $request->get('birth_year')) {
            $user->setBirthDay($request->get('birth_day') . '-' . $request->get('birth_month') . '-' . $request->get('birth_year'));
        }

        $user->save();
        return redirect()->back();
    }

}