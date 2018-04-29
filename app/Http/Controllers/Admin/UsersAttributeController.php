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
        die('123');
        $attributes = Attribute::paginate(15);
        dd($attributes);die;
        return view('admin/attribute/index')->with('attributes', $attributes);
    }

    public function create(Request $request)
    {
        return view('admin/attribute/create');
    }

    public function edit($id)
    {
        $usersAttribute = Attribute::findOrFail($id);
        /** @var Collection $selectValues */
        $selectValues = Attribute\Select\Values::where('attribute_key', $usersAttribute->key)->get();

        $selectValueString = null;

        if ($selectValues->count() > 0) {
            foreach ($selectValues as $_selectValue) {
                $selectValueString .= $_selectValue->key . ':' . $_selectValue->value . PHP_EOL;
            }
        }

        return view('admin/attribute/edit')
            ->with('attributes', $usersAttribute)
            ->with('select_value_string', $selectValueString)
            ;
    }

    public function post(Request $request)
    {
        $post = $request->post();
        if(isset($post['select_values'])) {
            // todo add values to value
            $options = explode(PHP_EOL, $post['select_values']);
            $options = array_map(function ($e) {
                $e = trim($e);
                $e = explode(':', $e);
                $result[$e[0]] = $e[1];
                return $result;
            }, $options);

            foreach ($options as $_option) {
                $optionsValues = new Attribute\Select\Values();
                $optionsValues->attribute_key = $request->get('key');
                $optionsValues->key = key($_option);
                $optionsValues->value = current($_option);
                $optionsValues->save();
            }
        }

        // unset select values and _token
        unset($post['select_values']);
        unset($post['_token']);

        $attributes = new Attribute();
        foreach ($post as $_key => $_post) {
            $attributes->$_key = $_post;
        }
        $attributes->save();

        return redirect('admin/users_attribute')->with('flash_message', 'Create attribute!');
    }

    public function update($id, Request $request)
    {
        $post = $request->post();
        if(isset($post['select_values'])) {
            // delete all values before save
            /** @var Collection $selectValues */
            $selectValues = Attribute\Select\Values::where('attribute_key', $request->get('key'))->get();
            /** @var Attribute\Select\Values $_value */
            foreach ($selectValues as $_value) {
                $_value->delete();
            }

            $options = explode(PHP_EOL, $post['select_values']);
            $options = array_map(function ($e) {
                $e = trim($e);
                $e = explode(':', $e);
                $result[$e[0]] = $e[1];
                return $result;
            }, $options);

            foreach ($options as $_option) {
                $optionsValues = new Attribute\Select\Values();
                $optionsValues->attribute_key = $request->get('key');
                $optionsValues->key = key($_option);
                $optionsValues->value = current($_option);
                $optionsValues->save();
            }
        }

        // unset select values and _token
        unset($post['select_values']);
        unset($post['_token']);

        $attributes = Attribute::findOrFail($id);
        foreach ($post as $_key => $_post) {
            $attributes->$_key = $_post;
        }
        $attributes->save();

        return redirect('admin/users_attribute')->with('flash_message', 'Create attribute!');
    }

    public function fakelogin($userId)
    {
        $user = User::findOrFail($userId);
        Auth::login($user);
//        dd($userId);
    }

    public function test(Request $request)
    {
        die('test controller');
    }

}
