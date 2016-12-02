<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    protected $redirectPath = '/profile';

    public function getEmail()
    {
        return view('password.email');
    }

    public function postEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $response = Password::broker()->sendResetLink($request->only('email'), function (Message $message) {
            $message->subject(trans('user.pwd_reset_subject'));
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('status', trans($response));

            case Password::INVALID_USER:
            default:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    public function getReset(Request $request, $token = null)
    {
        if (is_null($token)) {
            return $this->getEmail();
        }

        $email = $request->input('email');

        return view('password.reset')->with(compact('token', 'email'));
    }

    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::broker()->reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
            Auth::guard($this->getGuard())->login($user);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return redirect($this->redirectPath)->with('status', trans($response));

            default:
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
        }
    }

    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}
