<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;

/**
 * Class ProjectTransformer
 * @package namespace CodeProject\Transformers;
 */
class ProjectFileTransformers extends TransformerAbstract
{
    
    public function transform(ProjectFile $projectFile)
    {
        return [
            'file_id' => $projectFile->id,
            'name' => $projectFile->name,
            'extension' => $projectFile->extension,
            'description' => $projectFile->description,
            'project_id' => $projectFile->project_id,
            'created_at' => date_format($projectFile->created_at, "Y-m-d h:m:s"),
            'updated_at' => date_format($projectFile->created_at, "Y-m-d h:m:s"),
        ];
    }

}
