<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Experience;
use Illuminate\Http\Request;
use Validator;

class ExperienceController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'company' => 'required',
            'title' => 'required',
            'start' => 'required',
        ]);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        $experience = Experience::create($request->all());

        if ($experience->save()) {
            return redirect("admin/member/{$experience->member_id}/edit")->with('message', trans('member.create_experience_success'));
        } else {
            return response('Server Error!', '500');
        }
    }

    public function update(Request $request, $id)
    {
        $experience = Experience::find($id);

        if (! $experience) return response('Bad Request!', 400);

        $experience->fill($request->all());

        if ($experience->save()) {
            return redirect("admin/member/{$experience->member_id}/edit")->with('message', trans('member.updated_experience_success'));
        } else {
            return response('Server Error!', '500');
        }
    }

    public function destroy($id)
    {
        $experience = Experience::find($id);

        if (! $experience) return response('Bad Request!', 400);

        $result = $experience->delete();

        return $result ? redirect()->back()->with('message', trans('member.delete_experience_success')) : response('Server Error!', '500');
    }
}
