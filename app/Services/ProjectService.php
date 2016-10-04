<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 26/08/16
 * Time: 19:52
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjectService
{
    /**
     * @var ProjectRepository
     * @var ProjectValidator
     * @var Filesystem
     * @var Storage
     */
    protected $repository;
    protected $validator;
    private $filesystem;
    private $storage;

    public function __construct(ProjectRepository $repository, ProjectValidator $validator,
                                Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }

    public function create(array $data)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function showMembers($id)
    {
        try{
            return response()->json($this->repository->find($id)->members->all());
        }catch (ModelNotFoundException $ex){
            return[
                'error' => true,
                'message'   => 'ID not found'
            ];
        }
    }

//    public function showTasks($id)
//    {
//        try{
//            return response()->json($this->repository->find($id)->tasks->all());
//        }catch (ModelNotFoundException $ex){
//            return[
//                'error' => true,
//                'message'   => 'ID not found'
//            ];
//        }
//    }

    public function addMember($id, $memberId)
    {
        try{
            $this->repository->find($id)->members()->attach($memberId);
            return response()->json([
                'error' =>  false,
                'message'   =>  [
                    'addMember' =>  "Member ID {$memberId} added"
                ]
            ]);
        }catch (ModelNotFoundException $ex){
            return[
                'error' => true,
                'message'   => 'ID not found'
            ];
        }
    }

    public function removeMember($id, $memberId)
    {
        try{
            $this->repository->find($id)->members()->detach($memberId);
            return response()->json([
                'error' =>  false,
                'message'   =>  [
                    'removeMember' =>  "Member ID {$memberId} added"
                ]
            ]);
        }catch (ModelNotFoundException $ex){
            return[
                'error' => true,
                'message'   => 'ID not found'
            ];
        }
    }

    public function isMember($id, $memberId)
    {
        try{
            $member = $this->repository->find($id)->members()->find($memberId);
            if (!$member){
                return reponse()->json([
                    'error' =>  true,
                    'message'   =>[
                        'isMember'  =>  "Member ID {$memberId} is not a member in his project"
                    ]
                ]);
            }
            return reponse()->json([
                'error' => false,
                'message' => [
                    'isMember' => "{$member->name} is a member in this project"
                ]
            ]);
        }catch (ModelNotFoundException $ex){
            return[
                'error' => true,
                'message'   => 'ID not found'
            ];
        }
    }

}