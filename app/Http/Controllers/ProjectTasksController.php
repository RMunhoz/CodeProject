<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Services\ProjectTaskService;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CodeProject\Http\Requests\ProjectTaskCreateRequest;
use CodeProject\Http\Requests\ProjectTaskUpdateRequest;
use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Validators\ProjectTaskValidator;


class ProjectTasksController extends Controller
{

    /**
     * @var ProjectTaskService
     * @var ProjectTaskRepository
     */
    protected $service;
    protected $repository;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->repository = $repository;
        $this->service  = $service;
    }

    public function index($id)
    {
        return $this->repository->findWhere(['project_id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $taskId)
    {
        return $this->repository->findWhere(['project_id'=>$id, 'id'=>$taskId]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $taskId)
    {
        return $this->service->update($request->all(), $taskId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $taskId)
    {
        try{
            $this->repository->find($taskId)->delete();
            return response()->json(['Task deletado com sucesso']);
        }catch (\Exception $e) {
            return response()->json(['Task não encontrado']);
        }
    }
}
