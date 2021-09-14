<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class MasterController extends Controller
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

    public function store(Request $request)
    {

        $uid = Session::get('uid');

        $slave_id = data_get($request, 'slave' , null);
        $signal = data_get($request, 'signal' , null);
        $pause_message = data_get($request, 'pause' , null);


        $color = config('gnd_control.type')[$signal]['color'];


        $postData = [
            'colorCode' => $color,
            'masterID' => $uid,
            'msgType' => 'signal',
            'pauseMsg' => $pause_message,
            'slaveID' => $slave_id,
        ];

        $reference = 'sentSignals/'.$slave_id;

        app('firebase.database')->getReference($reference)->push($postData);

        return response()->json([
            'status' => 200
        ]);
    }

    public function storeAll(Request $request)
    {
        $signal = data_get($request, 'signal', null);
        $color = config('gnd_control.type')[strtolower($signal)]['color'];
        $pause_message = data_get($request, 'pause' , null);


        $uid = Session::get('uid');

        $user_slaves = app('firebase.database')
                            ->getReference('users')
                            ->orderByChild('accountType')
                            ->equalTo('slave'.$uid)
                            ->getSnapshot()
                            ->getValue();

        foreach($user_slaves as $key => $slave)
        {
            $postData = [
                'colorCode' => $color,
                'masterID' => $uid,
                'msgType' => 'signal',
                'pauseMsg' => $pause_message,
                'slaveID' => $key,
            ];
    
            $reference = 'sentSignals/'.$key;
    
            app('firebase.database')->getReference($reference)->push($postData);
        }

        return response()->json([
            'status' => 200
        ]);    
    }
}
