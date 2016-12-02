<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Publication;
use Illuminate\Http\Request;
use Validator;

class PublicationController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'year' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        $publication = Publication::create($request->all());

        if ($publication->save()) {
            return redirect("admin/member/{$publication->member_id}/edit")->with('message', trans('member.create_publication_success'));
        } else {
            return response('Server Error!', '500');
        }
    }

    public function update(Request $request, $id)
    {
        $publication = Publication::find($id);

        if (! $publication) return response('Bad Request!', 400);

        $publication->fill($request->all());

        if ($publication->save()) {
            return redirect("admin/member/{$publication->member_id}/edit")->with('message', trans('member.updated_publication_success'));
        } else {
            return response('Server Error!', '500');
        }
    }

    public function destroy($id)
    {
        $publication = Publication::find($id);

        if (! $publication) return response('Bad Request!', 400);

        $result = $publication->delete();

        return $result ? redirect()->back()->with('message', trans('member.delete_publication_success')) : response('Server Error!', '500');
    }
}