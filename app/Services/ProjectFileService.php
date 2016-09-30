<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 26/08/16
 * Time: 19:52
 */

namespace CodeProject\Services;

use CodeProject\Entities\ProjectFileRepository;
use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectFileValidator;
use CodeProject\Validators\ProjectNoteValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectFileService
{
    /**
     * @var ProjectNoteRepository
     * @var ProjectNoteValidator
     */
    protected $repository;
    protected $validator;

    public function __construct(ProjectFileRepository $repository, ProjectFileValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
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


}