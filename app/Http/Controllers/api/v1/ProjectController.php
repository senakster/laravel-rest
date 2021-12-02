<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json(ProjectResource::collection($projects), 200);
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
            'geolocation' => 'required|latlng',
            'description' => 'required'
        ];

        $messages = [
            'name.required' => 'A Name is Required',
            'municipality.required' => 'A Municipality is Required',
            'geolocation.required' => 'A Geolcation is required',
            'description.required' => 'A description is required',
        ];

        $requestData = $request->only(['name', 'municipality', 'geolocation', 'description', 'status']);

        $validator = Validator::make($requestData, $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $project = Project::create($requestData);

        return response()->json(new ProjectResource($project), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);

        if (is_null($project)) {
            $error = [
                'message' => 'Could not find Project'
            ];

            return response()->json($error, 400);
        }

        return response()->json(new ProjectResource($project), 200);
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
        $project = Project::find($id);

        if (is_null($project)) {
            $error = [
                'message' => 'Could not find Project'
            ];

            return response()->json($error, 400);
        }

        $rules = [
            'name' => 'required|unique:groups',
            'municipality' => 'required',
            'geolocation' => 'required|latlng',
            'description' => 'required'
        ];

        $messages = [
            'name.required' => 'A Name is Required',
            'municipality.required' => 'A Municipality is Required',
            'geolocation.required' => 'A Geolcation is required',
            'description.required' => 'A description is required',
        ];

        $requestData = $request->only(['name', 'municipality', 'geolocation', 'description', 'status']);

        $validator = Validator::make($requestData, $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $project->update($requestData);

        return response()->json(new ProjectResource($project), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if (is_null($project)) {
            $error = [
                'message' => 'Could not find Project'
            ];

            return response()->json($error, 400);
        }

        $project->delete();

        return response()->json(null, 204);
    }
}
