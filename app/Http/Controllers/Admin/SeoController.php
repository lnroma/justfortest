<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\User\Attribute;
use App\Role;
use App\User;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UsersAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
//        $attributes = Attribute::paginate(15);
//        return view('admin/attribute/index')->with('attributes', $attributes);
        return view('admin/seo/index')->with('seo', []);
    }

}
