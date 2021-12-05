<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * apply middleware auth:api jwt
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::with('grouplinks')->get();
        return response()->json(GroupResource::collection($groups), 200);
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
            'municipality' => 'required',
        ];

        $messages = [
            'name.required' => 'A Name is Required',
            'municipality.required' => 'A Municipality is Required',
        ];

        $requestData = $request->only(['name', 'municipality', 'grouptype','description','status']);

        $validator = Validator::make($requestData, $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $group = Group::create($requestData);

        return response()->json(new GroupResource($group), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::with('grouplinks')->find($id);

        if (is_null($group)) {
            $error = [
                'message' => 'Could not find Group'
            ];

            return response()->json($error, 400);
        }

        return response()->json(new GroupResource($group), 200);
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
        $group = Group::find($id);

        if (is_null($group)) {
            $error = [
                'message' => 'Could not find Group'
            ];

            return response()->json($error, 400);
        }

        $rules = [
            'name' => 'required|unique:groups',
            'municipality' => 'required',
        ];

        $messages = [
            'name.required' => 'A Name is Required',
            'municipality.required' => 'A Municipality is Required',
        ];

        $requestData = $request->only(['name', 'municipality', 'grouptype', 'description', 'status']);

        $validator = Validator::make($requestData, $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $group->update($requestData);

        return response()->json(new GroupResource($group), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);

        if (is_null($group)) {
            $error = [
                'message' => 'Could not find Group'
            ];

            return response()->json($error, 400);
        }

        $group->delete();

        return response()->json(null, 204);
    }
}
