<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;
use Mail;
use File;
use App\Traits\CaptchaTrait;
use Cloudinary;

class UserController extends Controller
{
    use CaptchaTrait;

    private $authUser = null;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['store']]);
        $this->authUser = Auth::user();
        Cloudinary::config([
            "cloud_name" => "dem4edcea", 
            "api_key" => "291114766414246", 
            "api_secret" => "s2kOM2JOVN-J7GP9vNXVWNqNIxI" 
        ]);
    }

    public function store(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|min:8|confirmed',
            'email' => 'required|email|unique:users',
            'g-recaptcha-response'  => 'required'
        ]);

        if ($validator->fails())
            return redirect('register')
                ->withErrors($validator)
                ->withInput();

        if($this->captchaCheck() == false)
        {
            return redirect()->back()
                ->withErrors(['Wrong Captcha'])
                ->withInput();
        }

        $confirmation_code = str_random(30);
        $user = User::create($request->all());
        $user->password = bcrypt($request->input('password'));
        $user->confirmation_code = $confirmation_code;
        $user->level = User::USER;
        $user->ip = $request->ip();

        Mail::send('email.verify', ['confirmation_code' => $confirmation_code, 'email' => $user->email], function($message) use ($user) {
            $message->to($user->email, $user->name)->subject(trans('user.verify_email'));
        });

        if ($user->save()) {
            return redirect("/login")->with('message', trans('user.reg_success'));
        } else {
            return response('Server Error!', '500');
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (! $user) return response(trans('user.not_exist'), 400);

        $validator = Validator::make($request->all(), [
            'email' => 'email|unique:users'
        ]);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        $authUser = $this->authUser;

        if ($authUser->id != $id && $authUser->level <= User::USER) return response('Bad Request!', 400);

        $user->fill($request->all());

        return $user->save() ? redirect('/profile')->with('message', trans('user.profile_updated')) :
            response('Server Error!', '500');
    }

    public function changePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'password' => 'required|min:8|different:oldPassword',
            'passwordConfirmation' => 'required|min:8|same:password'
        ]);

        if ($validator->fails())
            return redirect('profile')
                ->withErrors($validator)
                ->withInput();

        $user = User::find($id);

        if (! Hash::check($request->input('oldPassword'), $user->password))
            return redirect('/profile')->withErrors(trans('user.old_pwd_not_match'));

        $user->password = $request->input('password');

        return $user->save() ? redirect('/profile')->with('message', trans('user.pwd_update_success')) :
            response('Server Error!', '500');
    }

    public function upload(Request $request, $id)
    {
        $user = User::find($id);

        if (! $user) return response('Bad Request!', 400);

        $file = $request->file('image');
        $validator = Validator::make(['image' => $file], [
            'image' => 'required',
        ]);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        if(!$file->isValid()) return response('Server Error!', '500');

        $fileName = time() . "-{$id}";
        $deleteFile = $user->photo;
        $isUpload = Cloudinary\Uploader::upload($file->getRealPath(), [
            "public_id" => $fileName
        ]);

        if (!$isUpload) return response('Upload photo error!', '500');

        $user->photo = $fileName;

        if ($deleteFile) Cloudinary\Uploader::destroy($deleteFile);

        if ($user->save()) {
            return redirect("profile")->with('message', trans('user.update_photo_success'));
        } else {
            return response('Server Error!', '500');
        }

    }
}
