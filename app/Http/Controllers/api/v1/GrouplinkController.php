<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\GrouplinkResource;
use App\Models\Grouplink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrouplinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grouplinks = Grouplink::with('group')->get();
        return response()->json(GrouplinkResource::collection($grouplinks), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:groups',
            'group_id' => 'required',
            'url' => 'required|url'
        ];

        $messages = [
            'name.required' => 'A Name is Required',
            'group_id.required' => 'A Group_id is Required',
            'url.required' => 'A URL is required',
            'url.url' => 'URL must be valid'
        ];

        $requestData = $request->only(['name', 'group_id', 'url', 'description']);

        $validator = Validator::make($requestData, $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $grouplink = Grouplink::create($requestData);

        return response()->json(new GrouplinkResource($grouplink), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grouplink = Grouplink::with('group')->find($id);
        if (is_null($grouplink)) {
            $error = ['message' => 'Could not find Grouplink'];
            return response()->json($error, 400);
        }

        return response()->json(new GrouplinkResource($grouplink), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Grouplink::find($id);

        if (is_null($group)) {
            $error = [
                'message' => 'Could not find Grouplink'
            ];

            return response()->json($error, 400);
        }

        $rules = [
            'name' => 'required|unique:groups',
            'group_id' => 'required',
            'url' => 'required|url'
        ];

        $messages = [
            'name.required' => 'A Name is Required',
            'group_id.required' => 'A Group_id is Required',
            'url.required' => 'A URL is required',
            'url.url' => 'URL must be valid'
        ];

        $requestData = $request->only(['name', 'group_id', 'url', 'description']);

        $validator = Validator::make($requestData, $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $group->update($requestData);

        return response()->json(new GrouplinkResource($group), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grouplink = Grouplink::find($id);

        if (is_null($grouplink)) {
            $error = [
                'message' => 'Could not find Group'
            ];

            return response()->json($error, 400);
        }

        $grouplink->delete();

        return response()->json(null, 204);
    }
}
