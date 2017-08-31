<?php

namespace App\Http\Controllers;

use App\Project;
use App\Transformers\ProjectTransformer;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->input('archived') == 1) {
            $projects = Auth::user()->projects()->archived()->with('revisionHistory')->get();
        } else {
            $projects = Auth::user()->projects()->active()->with('revisionHistory')->get();
        }

        return $projects->map(function($project) {
            return (new ProjectTransformer)->transform($project);
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = Auth::user()->projects()->create($this->getProjectParametersFromRequest($request));

        return (new ProjectTransformer)->transform($project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Project $project
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Project $project)
    {
        if ($project->user != Auth::user()) {
            return abort(403);
        }

        $project->update($this->getProjectParametersFromRequest($request));

        return (new ProjectTransformer)->transform($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getProjectParametersFromRequest(Request $request)
    {
        return [
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'start_date' => !is_null($request->input('start_date')) ? Carbon::parse($request->input('start_date'))->toDateString() : null,
            'end_date' => !is_null($request->input('end_date')) ?Carbon::parse($request->input('end_date'))->toDateString() : null,
            'next_action' => $request->input('next_action'),
            'responsible_party' => $request->input('responsible_party'),
        ];
    }
}
