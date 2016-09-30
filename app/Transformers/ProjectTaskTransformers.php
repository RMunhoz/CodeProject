<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 29/09/16
 * Time: 22:35
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformers extends TransformerAbstract
{
    public function transform(ProjectTask $task)
    {
        return [
            'id' => $task->id,
            'name' => $task->name,
            'project_id' => $task->project_id,
            'start_date' => $task->start_date,
            'due_date' => $task->due_date,
            'status' => $task->status,
        ];
    }

}