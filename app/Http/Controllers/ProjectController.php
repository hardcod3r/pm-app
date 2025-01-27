<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Abstract\Controllers\ResourceController;
use App\Actions\Api\Project\GetProjectListAction;
use App\Actions\Api\Project\StoreProjectAction;
use App\Actions\Api\Project\ShowProjectAction;
use App\Actions\Api\Project\UpdateProjectAction;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\ShowProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Requests\Project\DestroyProjectRequest;
use App\Http\Requests\Project\AssignProjectToCompanyRequest;
use App\Models\Company;

class ProjectController extends ResourceController
{


    public function __construct(
        private readonly GetProjectListAction $projectListAction,
        private readonly StoreProjectAction $storeProjectAction,
        private readonly ShowProjectAction $showProjectAction,
        private readonly UpdateProjectAction $updateProjectAction
    ) {
        //
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->projectListAction->run();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $action = $this->storeProjectAction->run($request->validated());
        return $this->success($action, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, ShowProjectRequest $request)
    {
        return $this->showProjectAction->run($project, $request->query('include', ''));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $action = $this->updateProjectAction->run($request->validated(), $project->id);
        return $this->success($action, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, DestroyProjectRequest $request)
    {
        try {
            //we proceed to delete the project
            if ($project->delete()) {
                return $this->success('', 204);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    //assign a project to a company

    public function associateProjectToCompany(Project $project, Company $company,  AssignProjectToCompanyRequest $request)
    {
        try{
            $project->company()->associate($company);
            $project->save();

        return response()->json(['success' => true, 'message' => 'Project assigned to company successfully'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

}
