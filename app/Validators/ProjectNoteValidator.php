<?php
/**
 * Created by PhpStorm.
 * User: rogerio
 * Date: 26/08/16
 * Time: 19:52
 */

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{
    protected $rules = [
        'project_id'    => 'required',
        'title'         => 'required',
        'note'          => 'required',
    ];


}