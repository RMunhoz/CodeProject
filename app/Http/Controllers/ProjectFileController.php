<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectFileService;
use CodeProject\Services\ProjectService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Illuminate\Support\Facades\Validator;

class ProjectFileController extends Controller
{
    /**
     * @var ProjectFileRepository
     */
    private $fileRepository;
    /**
     * @var ProjectFileService
     */
    private $fileService;
    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectFileService
     */
    private $service;

    public function __construct(ProjectFileRepository $fileRepository, ProjectFileService $fileService,
                                ProjectRepository $repository, ProjectService $service)
    {

        $this->fileRepository = $fileRepository;
        $this->fileService = $fileService;
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index($id)
    {
        return $this->fileRepository->findWhere(['project_id' => $id]);
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

            return $this->fileService->createFile($data);

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

            if (!$this->fileService->checkProjectPermissions($id)){
                return ['error' => 'Access Forbidden'];
            }

            $group = $this->fileRepository->skipPresenter()->findWhere(['project_id' => $id, 'id' => $fileId]);

            if($group->isEmpty()){
                return [
                    'error' => true,
                    'message' => 'vazio'
                ];
            }else{
                $object = $group->first();
                if ($this->fileService->deleteFile($object->id.'.'.$object->extension)){
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
