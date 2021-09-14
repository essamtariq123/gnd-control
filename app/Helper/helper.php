<?php

use Illuminate\Support\Facades\Session;

if(!function_exists('user_type'))
{
    function user_type()
    {
        $user_type = null;

        $uid = Session::get('uid');

        if($uid)
        {

            $user = app('firebase.auth')->getUser($uid);

            $user_value = app('firebase.database')
                            ->getReference('users')
                            ->orderByChild('email')
                            ->equalTo($user->email)
                            ->getSnapshot()
                            ->getValue();

            $user_type = $user_value[$user->uid]['accountType'];
            
        }

        return $user_type;

    }
}

if(!function_exists('user_id'))
{
    function user_id()
    {
        $user_id = null;

        $uid = Session::get('uid');

        if($uid)
        {

            $user_id = app('firebase.auth')->getUser($uid)->uid;

        }

        return $user_id;

    }
}