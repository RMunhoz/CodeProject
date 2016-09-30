<?php

namespace CodeProject\Repositories;

use CodeProject\Presenters\ProjectPresenters;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Entities\Project;
use CodeProject\Validators\ProjectValidator;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    public function isOwner($projectId, $userId)
    {
        if (count($this->findWhere(['id'=>$projectId, 'owner_id'=>$userId]))){
            return true;
        }
        return false;
    }

    public function hasMember($projectId, $memberId)
    {
        $project = $this->find($projectId);
        foreach ($project->members as $member){
            if ($member->id == $memberId){
                return true;
            }
        }
        return false;
    }

    public function presenter()
    {
        return ProjectPresenters::class;
    }

    public function checkProjectMember($id)
    {
        $memberId = userId();
        return $this->hasMember($id,$memberId);
    }

    public function checkProjectOwner($id)
    {
        $ownerId = userId();
        return $this->isOwner($id,$ownerId);
    }

    public function checkProjectPermissions($id)
    {
        return $this->checkProjectOwner($id) || $this->checkProjectMember($id);
    }

    public function findWithOwnerAndMember($userId)
    {
        return $this->scopeQuery(function($query) use($userId){
            return $query->select('projects.*')
                ->leftJoin('project_members', 'project_members.project_id', '=','projects.id')
                ->where('project_members.user_id', '=', $userId)
                ->union($this->model->query()->getQuery()->where('owner_id','=',$userId));
        })->all();
    }
}
