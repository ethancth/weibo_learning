<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
            'only'=>['create']
        ]);
    }

    //
    public function create()
    {
        return view('sessions.create');
    }
    public function store(Request $request)
    {
        $credentials=$this->validate($request,[
           'email'=>'required|email|max:255',
           'password'=>'required'
        ]);
        if(Auth::attempt($credentials,$request->has('remember'))){
            if(Auth::user()->activated) {
            session()->flash('success','Welcome');
            $fallback=route('users.show',Auth::user());
            return redirect()->intended($fallback);
            } else {
                Auth::logout();
                session()->flash('warning', '你的账号未激活，请检查邮箱中的注册邮件进行激活。');
                return redirect('/');
            }
        }else{
            session()->flash('danger','Incorrect Credential');
            return redirect()->back()->withInput();
        }

        return;
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', 'Logout Successful');
        return redirect('login');
    }
}
