<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 29/09/16
 * Time: 22:24
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformers extends TransformerAbstract
{
    public function transform(ProjectNote $note)
    {
        return [
            'id' => $note->id,
            'project_id' => $note->project_id,
            'title' => $note->title,
            'note' => $note->note,
        ];
    }

}