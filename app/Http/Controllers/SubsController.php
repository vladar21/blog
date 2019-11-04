<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Mail\SubscribeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SubsController extends Controller
{
    public function subscribe(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|unique:subscriptions'
        ]);
  
        $subs = Subscription::add($request->get('email'));
        $subs->generateToken();

        \Mail::to($subs)->send(new SubscribeEmail($subs));
      
        return redirect('/')->with('status', 'Проверьте вашу почту! Для завершения подписки кликните по ссылке в пришедшем письме.');
       
    }


    public function verify($token)
    {
        $subs = Subscription::where('token', $token)->firstOrFail();
        $subs->token = null;
        $subs->save();        

        return redirect()->back()->with('status', 'Ваша почта подтверждена!');
        
    }
}
