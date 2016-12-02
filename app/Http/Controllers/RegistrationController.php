<?php

namespace App\Http\Controllers;

use App\User;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function confirm($confirmation_code)
    {
        if(! $confirmation_code) return response('Bad Request!', 400);

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if (! $user) return response('Bad Request!', 400);

        $user->confirmed = 1;
        $user->confirmation_code = null;

        if ($user->save()) {
            return redirect("/login")->with('message', trans('user.verify_success'));
        } else {
            return response('Server Error!', '500');
        }
    }
}
