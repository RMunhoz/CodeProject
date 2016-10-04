<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Services\ProjectFileService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectFileController extends Controller
{
    /**
     * @var ProjectFileRepository
     */
    private $repository;
    /**
     * @var ProjectFileService
     */
    private $service;

    public function __construct(ProjectFileRepository $repository, ProjectFileService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'file'=> 'required'
            ]);

            if($validator->fails()) {
                return [
                    'error' => true,
                    'message' => 'Unselected file'
                ];
            }

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();

            $data['file'] = $file;
            $data['extension'] = $extension;
            $data['name'] = $request->name;
            $data['project_id'] = $request->project_id;
            $data['description'] = $request->description;

            return $this->service->createFile($data);

        } catch(ModelNotFoundException $ex) {
            return [
                'error' => true,
                'message' => 'Error store file'
            ];
        }
    }

    public function destroy($id, $fileId)
    {
        try {

            if (!$this->service->checkProjectPermissions($id)){
                return ['error' => 'Access Forbidden'];
            }

            $group = $this->repository->skipPresenter()->findWhere(['project_id' => $id, 'id' => $fileId]);

            if($group->isEmpty()){
                return [
                    'error' => true,
                    'message' => 'vazio'
                ];
            }else{
                $object = $group->first();
                if ($this->service->deleteFile($object->id.'.'.$object->extension)){
                    $object->delete();
                    return [
                        'deleted success'
                    ];
                } else {
                    return [
                        'not delete'
                    ];
                }
            }

        } catch (Exception $e) {
            return [
                'error' => true,
                'message' => 'Store file error'
            ];
        }
    }
}
