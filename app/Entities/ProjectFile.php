<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectFile extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'project_id',
        'extension',
        'description',
        'name',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
