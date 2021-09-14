<?php

use App\Http\Controllers\MasterController;
use App\Http\Controllers\SlaveController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/test', function () {

    $uid = Session::get('uid');
    $user = app('firebase.auth')->getUser($uid);

    if($user)
    {

        // current user slaves
        $user_slaves = app('firebase.database')
                            ->getReference('users')
                            ->orderByChild('accountType')
                            ->equalTo('slave'.$uid)
                            ->getSnapshot();


        // list of slavrs that are free
        $slaves_free = app('firebase.database')
                            ->getReference('users')
                            ->orderByChild('accountType')
                            ->equalTo('slave')
                            ->getSnapshot();

        // Asign a user to the free slave

        $slave_id = 'JjAIxRXQVAggjJZI95nxnwzxSDA2';
        $updates = [
            'users/'.$slave_id.'/accountType' => 'slave'.$uid,
        ];

        app('firebase.database')->getReference() // this is the root reference
        ->update($updates);

        
        dd('');
    
        $user_slaves_referance = app('firebase.database')->getReference('user_slaves')->getSnapshot();
    
    
        // foreach($user_slaves_referance as $slave)
        // {
        //     dd($slave);
        // }
    
        dd($users_referance);
        foreach($users_referance as $user)
        {
            dd($user);
        }
    
    
    }

   
});

Auth::routes();

Route::get('/', function () {
    return redirect()->route('home');
});

Route::middleware(['user','fireauth'])->group(function () {
   
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/slaves', [MasterController::class , 'index'])->name('master.index');
    Route::post('/send/signal', [MasterController::class , 'store'])->name('master.store');
    Route::post('/send/all/signal', [MasterController::class , 'storeAll'])->name('master.store.all');

});


// Route::get('/home/customer', [App\Http\Controllers\HomeController::class, 'customer'])->middleware('user','fireauth');

//Route::get('/email/verify', [App\Http\Controllers\Auth\ResetController::class, 'verify_email'])->name('verify')->middleware('fireauth');

Route::post('login/{provider}/callback', 'Auth\LoginController@handleCallback');

//Route::resource('/home/profile', App\Http\Controllers\Auth\ProfileController::class)->middleware('user','fireauth');

//Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);
