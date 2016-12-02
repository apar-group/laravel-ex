<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Member;
use App\User;
use Illuminate\Http\Request;
use Validator;
use File;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('year', 'desc')->paginate(10);
        return view('admin.member.index', ['members' => $members]);
    }

    public function create()
    {
        $users = User::all();
        return view('admin.member.create',['users' => $users]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:members',
            'user_id' => 'unique:members',
        ]);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        $member = Member::create($request->all());
        $member->photo = "no-image.png";
        $request->input('hobbies') && $member->hobbies = json_encode($request->input('hobbies'));
        $request->input('expertise') && $member->expertise = json_encode($request->input('expertise'));
        $request->input('qualifications') && $member->qualifications = json_encode($request->input('qualifications'));
        $request->input('education') && $member->education = json_encode($request->input('education'));

        if ($member->save()) {
            return redirect('admin/member')->with('message', trans('member.create_success'));
        } else {
            return response('Server Error!', '500');
        }
    }

    public function edit($id)
    {
        $member = Member::find($id);

        if (! $member) return response('Bad Request!', 400);

        $users = User::all();

        return view('admin.member.edit', [
            'member' => $member,
            'users' => $users
        ]);
    }

    public function update(Request $request, $id)
    {
        $member = Member::find($id);

        if (! $member) return response('Bad Request!', 400);

        $member->fill($request->all());
        $request->input('hobbies') && $member->hobbies = json_encode($request->input('hobbies'));
        $request->input('expertise') && $member->expertise = json_encode($request->input('expertise'));
        $request->input('qualifications') && $member->qualifications = json_encode($request->input('qualifications'));
        $request->input('education') && $member->education = json_encode($request->input('education'));

        if ($member->save()) {
            return redirect("admin/member/{$member->id}/edit")->with('message', trans('member.updated_success'));
        } else {
            return response('Server Error!', '500');
        }
    }

    public function destroy($id)
    {
        $member = Member::find($id);
        $path = public_path().'/storage/images/member';

        if (! $member) return response('Bad Request!', 400);

        $result = $member->delete();

        if ($member->photo && $member->photo !== 'no-image.png') File::delete("$path/$member->photo");

        return $result ? redirect()->back()->with('message', trans('member.delete_success')) : response('Server Error!', '500');
    }

    public function upload(Request $request, $id)
    {
        $member = Member::find($id);

        if (! $member) return response('Bad Request!', 400);

        $file = $request->file('image');
        $validator = Validator::make(['image' => $file], [
            'image' => 'required',
        ]);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        if ($file->isValid()) {
            $path = public_path().'/storage/images/member';
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . "-{$id}.{$extension}";
            $deleteFile = $member->photo;
            $file->move($path, $fileName);
            $member->photo = $fileName;
        } else {
            return response('Server Error!', '500');
        }

        if ($deleteFile && $deleteFile !== 'no-image.png') File::delete("$path/$deleteFile");

        if ($member->save()) {
            return redirect("admin/member/{$member->id}/edit")->with('message', trans('member.update_photo_success'));
        } else {
            return response('Server Error!', '500');
        }

    }
}
