<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Mail;
use File;

class UserController extends Controller
{
    private $authUser = null;

    public function __construct()
    {
        $this->authUser = Auth::user();
    }

    public function index()
    {
        $users = User::where('level', '>=', $this->authUser->level)->orWhere('level', User::USER)->paginate(10);

        return view('admin.user.index', [
            'user' => $this->authUser,
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users'
        ]);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        $confirmation_code = str_random(30);
        $user = User::create($request->all());
        $user->password = bcrypt($request->input('password'));
        $user->confirmation_code = $confirmation_code;

        Mail::send('email.verify', ['confirmation_code' => $confirmation_code, 'email' => $user->email], function($message) use ($user) {
            $message->to($user->email, $user->name)->subject(trans('user.verify_email'));
        });

        if ($user->save()) {
            return redirect('admin/user')->with('message', trans('user.create_success'));
        } else {
            return response('Server Error!', '500');
        }
    }

    public function update(Request $request, $id)
    {
        if (! $this->authUser->level == User::ADMIN) return response('Bad Request!', 400);

        $user = User::find($id);

        if (! $user) return response('Bad Request!', 400);

        $data = $request->input('email') === $user->email ? $request->except('email') : $request->all();

        $validator = Validator::make($data, [
            'email' => 'email|unique:users'
        ]);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        if (! $user) return response(trans('user.not_exist'), 400);

        $user->fill($data);

        return $user->save() ? redirect()->back()->with('message', trans('user.update_success')) :
            response('Server Error!', '500');
    }

    public function destroy($id)
    {
        if (! $this->authUser->level == User::ADMIN) return response('Bad Request!', 400);

        $user = User::find($id);

        if (! $user) return response('Bad Request!', 400);

        $result = $user->delete();

        $posts = $user->posts();
        $comments = $user->comments();
        $news = $user->news();
        $path = public_path().'/storage/images/user';

        if ($result) {
            $posts->delete();
            $comments->delete();
            $news->delete();
        }

        if ($user->photo) File::delete("$path/$user->photo");

        return $result ? redirect()->back()->with('message', trans('user.delete_success')) : response('Server Error!', '500');
    }
}
