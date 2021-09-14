<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SlaveController extends Controller
{
    public function index()
    {

        $uid = Session::get('uid');

        $user_slaves = app('firebase.database')
                        ->getReference('users')
                        ->orderByChild('accountType')
                        ->equalTo('slave'.$uid)
                        ->getSnapshot()
                        ->getValue();

        return response()->json([
            'slaves' => $user_slaves,
            'status' => 200
        ]);
    }
}
