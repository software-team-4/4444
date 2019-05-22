<?php

namespace App\Http\Controllers;

use App\model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //
    function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => ['required', "same:password"],
            'type' => 'required'
        ];
        $this->validate($request, $rules);
        $data = Input::all();

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->type = $data['type'];
        $user->password = bcrypt($data['password']);
        $user->phone = $data['phone'] ? $data['phone'] : '';
        if ($user->save()) {
            return redirect('login');
        }
    }

    function login(Request $request)
    {
      //  dd($request->all());
        $email = $request->get('email');
        $password = $request->get('password');

        if (Auth::guard('user')->attempt(['email' => $email, 'password' => $password], $request->get('online'))) {
            return redirect('/');
        } else {
            return redirect('login')->withErrors(['loginError' => 'Incorrect user name or password']);
        }
    }

    function logout()
    {
        Auth::guard('user')->logout();
        return redirect('login');
    }

    function update(Request $request)
    {
        $data = Input::all();
        $user = User::find(Auth::guard('user')->user()->id);

        $this->validate($request, ['name' => 'required']);
        if ($request->get('password') != '') {
            $this->validate($request, ['password' => 'required', 'password_confirmation' => ['required', "same:password"]]);
            $user->password = bcrypt($data['password']);
        }
        $user->name = $data['name'];
        $user->phone = $data['phone'];
        if ($user->save()) {
            Auth::guard('user')->logout();
            return redirect('login');
        }
    }

    function retrievePassword(Request $request)
    {
        $this->validate($request, ['password' => 'required', 'password_confirmation' => ['required', "same:password"]]);
        $user = new User();
        $res = $user->where('email', '=', $request->get('email'))->update(['password' => bcrypt($request->get('password'))]);
        if ($res) {
            return redirect('login');
        }
        return redirect('retrievepassword')->withErrors(['error' => 'Retrieve password error']);
    }

    function sedEmailretrievePassword()
    {
        if (count(User::where('email', '=', Input::get('email'))->get())) {
            $to = Input::get('email');
            $url=config('app')['url'];
            Mail::raw("Click $url/retrievepassword?email=$to to reset password", function ($message) use ($to) {
                $message->to($to)->subject('SoftwareTeam4 Reset Password');
            });
            $err = Mail::failures();
            if (!count($err)) {
                return redirect('login')->withErrors(['msg' => 'Please check email']);
            } else {
                return redirect('login')->withErrors($err);
            }

        }else{
            return redirect('sigin')->withErrors(['msg' => 'Please register first']);
        }
    }
}
