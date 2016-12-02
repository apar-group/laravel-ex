<?php

namespace App\Http\Controllers;

use App\Member;
use Auth;
use Illuminate\Http\Request;
use Validator;
use File;

class MemberController extends Controller
{
    public function index()
    {
        $teacher = Member::where('year', 0)->first();
        $students = Member::where('year', '>', 0)->orderBy('year')->get();
        return view('member.index', [
            'teacher' => $teacher,
            'students' => $students
        ]);
    }

    public function show($id)
    {
        $member = Member::find($id);

        if (! $member) return response('Bad Request!', 400);

        return view('member.show', [
            'member' => $member
        ]);
    }

    public function edit($id)
    {
        if (! $user = Auth::user()) return response('Bad Request!', 400);

        $member = Member::find($id);

        if (! $member) return response('Bad Request!', 400);
        if (! $member->user) return response('Bad Request!', 400);
        if (! $user->id == $member->user->id) return response('Bad Request!', 400);

        return view('member.edit', ['member' => $member]);
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
            return redirect("member/{$member->id}/edit")->with('message', trans('member.updated_success'));
        } else {
            return response('Server Error!', '500');
        }
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
            return redirect("member/{$member->id}/edit")->with('message', trans('member.update_photo_success'));
        } else {
            return response('Server Error!', '500');
        }

    }
}
